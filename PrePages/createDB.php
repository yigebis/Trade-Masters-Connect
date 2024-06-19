<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE `trade masters connect`;";
if ($conn->query($sql) === TRUE) {
    echo "Database 'trade_masters_connect' created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}

// Close connection
$conn->close();
?>
