<?php
$config = array(
    "host" => "localhost",
    "dbuser" => "root",
    "dbpw" => "",
    "dbname" => "machohacks"
  );

  $conn = mysqli_connect($config["host"], $config["dbuser"], $config["dbpw"], $config["dbname"]);

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
    $result_chain = mysqli_query($conn, $sql_chain);

    // rendering data
    $sql = "SELECT * FROM transcript WHERE randKey = '{$keyArr[$i]}'";

    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

    $num_rows = mysqli_num_rows($result);

    $data = multiexplode(array(",",":"), $row['data']);

    if($num_rows == 0) {
      echo "<h3 style='color:#f00;'>Code does not exist</h3>
      <img src='https://media.giphy.com/media/jWexOOlYe241y/giphy.gif'>";
      } else {

<<<<<<< HEAD
    echo "<table><tr><th>Course</th><th>Grade</th></tr>";
    for ($t = 0; $t < count($data); $t = $t + 2) {
      echo "<tr><td>{$data[$t]}</td><td>{$data[$t+1]}</td></tr>";
    }
    echo "</table>";
=======
      echo "<p>Name: {$row['name']}<br>
      Term: {$row['term']}</p>";
>>>>>>> 63bf074b932dcc9d7b5c2d7e150daddfccea11da

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
  }


?>