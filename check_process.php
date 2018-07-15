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

  for($i = 0; $i < count($keyArr); $i++ ) {
    $sql = "SELECT * FROM transcript WHERE randKey = '{$keyArr[$i]}'";

    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $data = explode(",", $row['data']);

    echo "<p>Name: {$row['name']}<br>
    Term: {$row['term']}</p>";

    $data1 = explode(":", $data[0]);

    $data2 = explode(":", $data[1]);


    echo "<table><tr><th>Course</th><th>Grade</th>
          <tr><th>{$data1[0]}</th><th>{$data1[1]}</th></tr>
          <tr><th>{$data2[0]}</th><th>{$data2[1]}</th></tr></table>";

    echo "<hr>";

  }







?>