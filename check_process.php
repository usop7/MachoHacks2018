<?php
$config = array(
    "host" => "localhost",
    "dbuser" => "root",
    "dbpw" => "121212",
    "dbname" => "MachoHacks2018"
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
    echo "<p>{$data[0]}</p>";
    echo "<p>{$data[1]}</p>";
    echo "<hr>";

  }







?>