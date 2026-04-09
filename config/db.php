<?php

// Database connection
$dbname = "sc";
$conn = mysqli_connect('localhost', 'root', '', $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Start the session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}