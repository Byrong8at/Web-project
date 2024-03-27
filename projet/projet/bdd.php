<?php
$host = 'localhost';
$dbname = 'phpmyadmin';
$user = 'root';
$password = '';
$charset = 'utf8mb4';
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=$charset", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    
} catch(PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}


