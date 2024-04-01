<?php


require_once(dirname(__FILE__) .'/../controller/controller.php');

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
        case 'all':
            echo getall($search_term, $conn);
            break;
        case 'candidature':
            echo getcandidature($search_term, $conn);
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
    $sql = "SELECT * FROM offre WHERE Nom LIKE :search_term";

    $stmt = $conn->prepare($sql);
    $search_term_like = '%' . $search_term . '%';
    $stmt->bindParam(':search_term', $search_term_like, PDO::PARAM_STR);
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<p class="offre-item" data-id="' . $row['ID_offre'] . ' style="background-color: transparent; cursor: pointer;" onmouseover="this.style.backgroundColor=\'blue\'" onmouseout="this.style.backgroundColor=\'transparent\'">' . $row['Nom'] . '</p>';
    }
}
function getcandidature($search_term, $conn){
    $sql = "SELECT offre.*,entreprise.Nom as entreprise_nom FROM offre 
            INNER JOIN entreprise ON offre.ID_entreprise = entreprise.ID_entreprise
            WHERE offre.Nom LIKE :search_term AND offre.Voir = 1 AND entreprise.Voir = 1";

    $stmt = $conn->prepare($sql);
    $search_term_like = '%' . $search_term . '%';
    $stmt->bindParam(':search_term', $search_term_like, PDO::PARAM_STR);
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<p class="offre-item" data-id="' . $row['ID_offre'] . ' style="background-color: transparent; cursor: pointer;" onmouseover="this.style.backgroundColor=\'blue\'" onmouseout="this.style.backgroundColor=\'transparent\'">' . $row['Nom'] . '</p>';
    }
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

function getall($search_term, $conn){
    $results = array();

    $sql = "SELECT ID_entreprise, Nom
            FROM entreprise
            WHERE Nom LIKE :search_term AND Voir=1
            LIMIT 3";
    $stmt = $conn->prepare($sql);
    $search_term_like = '%' . $search_term . '%';
    $stmt->bindParam(':search_term', $search_term_like, PDO::PARAM_STR);
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $row['category'] = 'entreprise';
        $results[] = $row;
    }

    $sqllog = "SELECT ID_offre , Nom,Voir
            FROM offre
            WHERE Nom LIKE :search_term AND Voir=1
            LIMIT 3";
    $stmt = $conn->prepare($sqllog);
    $stmt->bindParam(':search_term', $search_term_like, PDO::PARAM_STR);
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $row['category'] = 'offre';
        $results[] = $row;
    }

    $sqlp = "SELECT ID_user,Prénom,Nom
            FROM utilisateur
            WHERE Nom LIKE :search_term OR Prénom LIKE :search_term
            LIMIT 3";
    $stmt = $conn->prepare($sqlp);
    $stmt->bindParam(':search_term', $search_term_like, PDO::PARAM_STR);
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $row['category'] = 'utilisateur';
        $results[] = $row;
    }

    foreach ($results as $row) {
        switch ($row['category']) {
            case 'entreprise':
                echo '<p class="all-item" data-id="' . $row['ID_entreprise'] . '" style="background-color: transparent; cursor: pointer;" onmouseover="this.style.backgroundColor=\'blue\'" onmouseout="this.style.backgroundColor=\'transparent\'">' . $row['Nom'] . '</p>';
                break;
            case 'offre':
                echo '<p class="all-item" data-id="' . $row['ID_offre'] . '" style="background-color: transparent; cursor: pointer;" onmouseover="this.style.backgroundColor=\'blue\'" onmouseout="this.style.backgroundColor=\'transparent\'">' . $row['Nom'] . '</p>';
                break;
            case 'utilisateur':
                echo '<p class="all-item" data-id="' . $row['ID_user'] . '" style="background-color: transparent; cursor: pointer;" onmouseover="this.style.backgroundColor=\'blue\'" onmouseout="this.style.backgroundColor=\'transparent\'">' . $row['Nom'] ." ". $row['Prénom'] . '</p>';
                break;
        }
    }
}