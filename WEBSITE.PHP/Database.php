<?php
$host = "localhost"; // Change this to your database host if needed
$username = "root";  // Change this to your MySQL username
$password = "";      // Change this to your MySQL password
$database = "blog_db"; // Name of the database

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//echo "Connected successfully"; // Uncomment to check if the connection works
?> 
