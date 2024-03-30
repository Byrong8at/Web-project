<?php
require_once(dirname(__FILE__) .'/bdd.php');
session_start();

if(isset($_GET['userId'])) {
    $userId = $_GET['userId'];
    
    $sql = "SELECT * FROM utilisateur WHERE ID_user = :userId";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
    $stmt->execute();

    $userinfo = $stmt->fetch(PDO::FETCH_ASSOC);
    $sqllog = "SELECT Id_Promo FROM integrer WHERE ID_user = :userId";
    $stmt = $conn->prepare($sqllog);
    $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
    $stmt->execute();

    $userpromo = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $userDetails = array_merge($userinfo, $userpromo);
    echo json_encode($userDetails);
}
