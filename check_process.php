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

  echo "<h1>BCIT Transcript Verification</h1>";

  function multiexplode($delims, $string) {
    $insert = str_replace($delims, ",", $string);
    $output = explode(",", $insert);
    return $output;
  }
  
  for($i = 0; $i < count($keyArr); $i++ ) {
    $sql = "SELECT * FROM transcript WHERE randKey = '{$keyArr[$i]}'";

    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

    $data = multiexplode(array(",",":"), $row['data']);

    echo "<p>Name: {$row['name']}<br>
    Term: {$row['term']}</p>";

    echo "<table><tr><th>Course</th><th>Grade</th>
          <tr><th>{$data[0]}</th><th>{$data[1]}</th></tr>
          <tr><th>{$data[2]}</th><th>{$data[3]}</th></tr></table>";

    echo "<hr>";

  }







?>