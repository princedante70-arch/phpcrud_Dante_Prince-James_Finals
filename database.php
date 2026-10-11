<?php

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'phpcrud_dante_prince';

$conn = mysqli_connect($host, $username, $password, $database);

if ($conn === false) {
    die('Database connection failed: ' . mysqli_connect_error());
}

mysqli_set_charset($conn, 'utf8mb4');
