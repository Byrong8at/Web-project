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

if(isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];
    
    $sql = "SELECT candidature.*, utilisateur.Nom, utilisateur.Prénom, utilisateur.Centre, integrer.Id_Promo, promotion.Nom_promo
            FROM candidature
            JOIN utilisateur ON candidature.ID_user = utilisateur.ID_user
            JOIN integrer ON utilisateur.ID_user = integrer.ID_user
            JOIN promotion ON integrer.Id_Promo = promotion.Id_Promo
            WHERE ID_offre = :post_id
            AND candidature.ID_Candi NOT IN (
            SELECT stage.ID_candi
            FROM stage
            )";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '
            <div class="bg-custom-green shadow-md rounded-lg p-4 mx-4 my-2 flex items-center">
                <div class="w-full h-full border-2 border-gray-300 p-4 flex flex-col justify-center items-center">
                    <div class="flex flex row">
                        <p class="text-lg font-semibold">' . $row['Nom'] . ' ' . $row['Prénom'] . '</p>
                        <img src="src/valider.png" data-id="'.$row['ID_Candi'].'" alt="valider" class="ml-8 w-8 h-8 valide">
                    </div>
                    <p class="">Promotion ' . $row['Nom_promo'] . '</p>
                    <p class="">Centre ' . $row['Centre'] . '</p>
                    
                </div>
            </div>
        ';
}
}

if(isset($_GET['candi_id'])) {
    $candi_id = $_GET['candi_id'];
    $sql = "SELECT * FROM candidature WHERE ID_Candi=:candi_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':candi_id', $candi_id, PDO::PARAM_INT);
    $stmt->execute();
    $user=$stmt->fetch(PDO::FETCH_ASSOC);

    $user_id = $user['ID_user'];
    $countQuery = "SELECT COUNT(*) FROM stage WHERE ID_Candi=:candi_id AND ID_user=:FAV_user";
    $countStmt = $conn->prepare($countQuery);
    $countStmt->bindParam(':candi_id', $candi_id, PDO::PARAM_INT);
    $countStmt->bindParam(':FAV_user', $user_id, PDO::PARAM_INT);
    $countStmt->execute();
    $count = $countStmt->fetchColumn();

    

    if ($count > 0) {
        echo "Déjà inscrit";
    } else {
        stage_valide($candi_id,$user_id, $conn);
    }
    
}

function stage_valide($candi_id,$user_id, $conn) {
    $sql = "INSERT INTO stage(ID_Candi,ID_user) VALUES (:candi_id,:FAV_user)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':candi_id', $candi_id, PDO::PARAM_INT);
    $stmt->bindParam(':FAV_user', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $stmt->fetch(PDO::FETCH_ASSOC);
    

    $sql_place="UPDATE offre
                SET place = place - 1
                WHERE ID_offre IN (
                SELECT offre.ID_offre
                FROM offre
                LEFT JOIN candidature ON offre.ID_offre = candidature.ID_offre
                WHERE candidature.ID_candi = :candi 
                ) ";
    $stmt_place = $conn->prepare($sql_place);
    $stmt_place->bindParam(':candi', $candi_id, PDO::PARAM_INT);
    $stmt_place->execute();
    $stmt_place->fetch(PDO::FETCH_ASSOC);

    

    echo "RECRUTEMENT VALIDER";
};
       