<?php
session_start();
$servername = "mysql-server";
$username = "root";
$password = "secret";

try {
  $conn = new PDO("mysql:host=$servername;dbname=Blog", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //  echo "Connected successfully";
} catch (PDOException $e) {
  echo "Connectiono failed: " . $e->getMessage();
}
