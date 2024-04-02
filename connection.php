<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cinema";

// Create connection
$cinema = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($cinema->connect_error) {
  die("Connection failed: " . $cinema->connect_error);
}