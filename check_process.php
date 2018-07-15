<?php
$config = array(
    "host" => "localhost",
    "dbuser" => "root",
    "dbpw" => "121212",
    "dbname" => "machohacks2018"
  );

  $config_chain = array(
    "host" => "hackathon.haoyang.space",
    "dbuser" => "hackathon",
    "dbpw" => "hackathon",
    "dbname" => "hackathon"
  );

  $conn = mysqli_connect($config["host"], $config["dbuser"], $config["dbpw"], $config["dbname"]);

  $conn_chain = mysqli_connect($config_chain["host"], $config_chain["dbuser"], $config_chain["dbpw"], $config_chain["dbname"]);

  $code = $_POST['code'];

  $keyArr = explode("+", $code);

  echo "<link rel='stylesheet' href='style.css?v=0.1'>";
  echo "<h1>BCIT Transcript Verification</h1>";

  function multiexplode($delims, $string) {
    $insert = str_replace($delims, ",", $string);
    $output = explode(",", $insert);
    return $output;
  }
  
  for($i = 0; $i < count($keyArr); $i++ ) {
    $valid = false;
    // validating from the blockchain
    $sql_chain = "SELECT data FROM blockchain";
    $result_chain = mysqli_query($conn_chain, $sql_chain);

    // rendering data
    $sql = "SELECT * FROM transcript WHERE randKey = '{$keyArr[$i]}'";

    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

    $data = multiexplode(array(",",":"), $row['data']);

    echo "<p>Name: {$row['name']}<br>
    Term: {$row['term']}</p>";

    echo "<table><tr><th>Course</th><th>Grade</th>
          <tr><td>{$data[0]}</td><td>{$data[1]}</td></tr>
          <tr><td>{$data[2]}</td><td>{$data[3]}</td></tr></table>";

    $str = $row['number'] . $row['name'] . $row['term'] . $row['data'];
    $hash = md5($str);
    echo "<small><i>$hash</i></small><br>";

    while($row_chain = mysqli_fetch_array($result_chain)) {
      if ($row_chain['data'] == $hash) {
        $valid = true;
      }
    }

    if ($valid) {
      echo "<span class='green'><b>Valid!</b></span>";
    } else {
      echo "<span class='red'><b>Not Valid!</b></span>";
    }

    echo "<hr>";

  }


?>