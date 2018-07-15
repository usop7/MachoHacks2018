<?php
$config = array(
    "host" => "localhost",
    "dbuser" => "root",
    "dbpw" => "121212",
    "dbname" => "MachoHacks2018"
  );

  $conn = mysqli_connect($config["host"], $config["dbuser"], $config["dbpw"], $config["dbname"]);

  $code = $_POST['code'];

  $sql = "SELECT * FROM transcript WHERE code = {$code}";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($result);




?>