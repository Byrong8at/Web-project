<?php
require_once(dirname(__FILE__) . '/../controller/controller.php');
session_start();

if (isset($_GET['favID']) ) {
    $favID = $_GET['favID'];
    
    try {

        $countQuery = "SELECT COUNT(*) FROM wishlist WHERE ID_offre=:favID AND ID_user=:FAV_user";
        $countStmt = $conn->prepare($countQuery);
        $countStmt->bindParam(':favID', $favID, PDO::PARAM_INT);
        $countStmt->bindParam(':FAV_user', $_SESSION['user']['ID_user'], PDO::PARAM_INT);
        $countStmt->execute();
        $count = $countStmt->fetchColumn();

        if ($count > 0) {
            enlever($favID, $conn);
        } else {
            ajout($favID, $conn);
        }

    } catch (PDOException $e) {
        $conn->rollBack();
        echo "Une erreur s'est produite : " . $e->getMessage();
    }
} else {
    echo "ID de favori invalide.";
}

function ajout($favID, $conn)
{   
    try{
    $insertQuery = "INSERT INTO wishlist(ID_offre,ID_user) VALUES (:favID,:FAV_user)";
    $insertStmt = $conn->prepare($insertQuery);
    $insertStmt->bindParam(':favID', $favID, PDO::PARAM_INT);
    $insertStmt->bindParam(':FAV_user', $_SESSION['user']['ID_user'], PDO::PARAM_INT);
    $insertStmt->execute();
    } catch (PDOException $e) {
        echo ''. $e->getMessage();
    }
}

function enlever($favID, $conn)
{
    try{
        $deleteQuery = "DELETE FROM wishlist WHERE ID_offre=:favID AND ID_user=:FAV_user";
        $deleteStmt = $conn->prepare($deleteQuery);
        $deleteStmt->bindParam(':favID', $favID, PDO::PARAM_INT);
        $deleteStmt->bindParam(':FAV_user', $_SESSION['user']['ID_user'], PDO::PARAM_INT);
        $deleteStmt->execute();
    } catch (PDOException $e) {
        echo ''. $e->getMessage();
    }
}
