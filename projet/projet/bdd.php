<?php
$host = 'localhost';
$dbname = 'phpmyadmin';
$user = 'root';
$password = '';
$charset = 'utf8mb4';
$conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "<a href=C:\Users\lefhu\OneDrive\Documents\GitHub\projec-web\projet\projet\index.html";
}