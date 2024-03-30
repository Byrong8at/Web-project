<?php


require_once(dirname(__FILE__) . '/../modele/bdd.php');
session_start();

if (!empty($_POST['search'])) {
    $search_term = $_POST['search'];
    $search_type = $_POST['type'];

    switch ($search_type) {
        case 'user':
            echo get_user($search_term, $conn);
            break;
        case 'entreprise':
            echo get_entreprise($search_term, $conn);
            break;
        case 'offre':
            echo getoffre($search_term, $conn);
            break;
        default:
            echo "Type de recherche invalide";
            break;
    }
}
function get_user($search_term, $conn){
    $sql = "SELECT * FROM utilisateur WHERE Nom LIKE :search_term OR Prénom LIKE :search_term";

    $stmt = $conn->prepare($sql);
    $search_term_like = '%' . $search_term . '%';
    $stmt->bindParam(':search_term', $search_term_like, PDO::PARAM_STR);
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<p class="user-item" data-id="' . $row['ID_user'] . ' style="background-color: transparent; cursor: pointer;" onmouseover="this.style.backgroundColor=\'blue\'" onmouseout="this.style.backgroundColor=\'transparent\'">' . $row['Prénom'] ." ". $row['Nom'] . '</p>';

    }
};

function getoffre($search_term, $conn){

}

function get_entreprise($search_term, $conn){
    $sql = "SELECT * FROM entreprise WHERE Nom LIKE :search_term";

    $stmt = $conn->prepare($sql);
    $search_term_like = '%' . $search_term . '%';
    $stmt->bindParam(':search_term', $search_term_like, PDO::PARAM_STR);
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<p class="ent-item" data-id="' . $row['ID_entreprise'] . ' style="background-color: transparent; cursor: pointer;" onmouseover="this.style.backgroundColor=\'blue\'" onmouseout="this.style.backgroundColor=\'transparent\'">' . $row['Nom'] . '</p>';

    }
};