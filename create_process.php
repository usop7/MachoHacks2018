<?php
$config = array(
    "host" => "localhost",
    "dbuser" => "root",
    "dbpw" => "121212",
    "dbname" => "machohacks2018"
  );

  $conn = mysqli_connect($config["host"], $config["dbuser"], $config["dbpw"], $config["dbname"]);

  $number = $_POST['number'];
  $name = $_POST['name'];
  $term = $_POST['term'];
  $grade = $_POST['grade'];

  // Insert data into School database
  date_default_timezone_set("America/Los_Angeles");
  $time = date("Y/m/d/H/i/s");
  $rand = substr(md5(microtime()),rand(0,26), 5);

  $sql = "
      INSERT INTO transcript
      (number, name, term, data, randKey)
      VALUES(
        '$number',
        '$name',
        '$term',
        '$grade',
        '$rand'
        )
        ";
  $result = mysqli_query($conn, $sql);

  // Insert code into blockchain
  $str = $number . $name . $term . $grade;
  $data = md5($str);
  $hash = md5($data . $time);

  $sql_chain = "
    INSERT INTO blockchain
    (Hash, data, timestamp) VALUES
    ('$hash','$data','$time')
      ";
  $result = mysqli_query($conn, $sql_chain);

  echo $data;


?>