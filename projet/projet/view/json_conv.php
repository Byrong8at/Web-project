<?php
require_once(dirname(__FILE__) .'/../controller/controller.php');
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

if(isset($_GET['entId'])) {
    $entId = $_GET['entId'];
    
    $sql = "SELECT * FROM entreprise WHERE ID_entreprise = :entId";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':entId', $entId, PDO::PARAM_INT);
    $stmt->execute();

    $entinfo = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($entinfo);
}

if(isset($_GET['offreId'])) {
    $offreId = $_GET['offreId'];
    
    $sql = "SELECT * FROM offre WHERE ID_offre = :offreId";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':offreId', $offreId, PDO::PARAM_INT);
    $stmt->execute();

    $offreinfo = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($offreinfo);
}


