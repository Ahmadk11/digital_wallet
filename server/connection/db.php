<?php
$host = 'localhost';
$dbname = 'digital_wallet';
$username = 'root';
$password = '';


$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully!";
?>