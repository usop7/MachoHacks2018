<?php

include_once "connectDB.php";
//Data you want to store in blockchain
$data = "";
$previous_md5 = "";
$previous_data = "";
$timestamp = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = $_POST["data"];
}

$sql = "SELECT * FROM `blockchain` ORDER BY id DESC LIMIT 1 ";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($stmt->rowCount() == 1) {
    $previous_md5 = $row["md5"];
    $previous_data = $row["data"];
    $timestamp = $row["timestamp"];
}

$md5 = md5($previous_md5 . $previous_data . $data . $timestamp);

$sql = "INSERT INTO blockchain (md5, data) VALUES (:md5, :data)";
if ($stmt = $pdo->prepare($sql)) {
    // Bind variables to the prepared statement as parameters
    $stmt->bindParam(':md5', $md5, PDO::PARAM_STR);
    $stmt->bindParam(':data', $data, PDO::PARAM_STR);
    $stmt->execute();
}

