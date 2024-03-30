<?php
require_once(dirname(__FILE__) .'/bdd.php');
session_start();

// Check if userId is provided in the request
if(isset($_GET['userId'])) {
    $userId = $_GET['userId'];
    
    // Prepare and execute SQL query to fetch user details
    $sql = "SELECT * FROM utilisateur WHERE ID_user = :userId";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
    $stmt->execute();

    $userDetails = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $sqllog = "SELECT * FROM promo WHERE ID_user = :userId";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
    $stmt->execute();

    $userpromo = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $userDetails = array_merge($userDetails, $userpromo);

    echo json_encode($userDetails);
}
