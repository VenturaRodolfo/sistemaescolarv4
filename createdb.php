<?php


$host='localhost';
$user = 'root';
$pass = 'VenturaR01';
// Create connection
$conn = new mysqli($host, $user, $pass);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE escuelav3";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully
            <br><br>";
} else {
    echo "Error creating database: " . $conn->error;
}

$conn->close();
?>