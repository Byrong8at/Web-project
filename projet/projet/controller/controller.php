<?php
require_once(dirname(__FILE__) .'/../modele/m_entreprise.php');
require_once(dirname(__FILE__) .'/../modele/m_offre.php');
require_once(dirname(__FILE__) .'/../modele/m_user.php');
require_once(dirname(__FILE__) .'/../modele/m_search.php');

if (isset($_POST['function']) && $_POST['function'] == 'search') {
    $search_term = $_POST['search'];
    search($search_term);
}

function get_all($id,$name){
    global $conn;
    if ($name == "entreprise"){
        $classentreprise = new entreprise();
        $data_entreprise = $classentreprise->get_all($conn, $id);
        return $data_entreprise;
    }else if ($name == "utilisateur"){
        $classuser = new user();
        $data_user = $classuser->get_all($conn, $id);
        return $data_user;
    }else if ($name == "offre"){
        $classoffre = new entreprise();
        $data_offre = $classoffre->get_all($conn, $id);
        return $data_offre;
    }
}

function get_entrepriseOffres($id){
    global $conn;
    $class = new entreprise();
    $data = $class->get_offres($conn, $id);
    return $data;
}

function get_adressesEntreprise($id){
    global $conn;
    $class = new entreprise();
    $data = $class->get_adresses($conn, $id);
    return $data;
}

function page_offre($id){
    global $conn;
    $classoffre = new offre();
    $data_offre = $classoffre->get_all($conn, $id);
    $data_offre[0]['entreprise_Nom'] = $classoffre->get_nomEntreprise($conn, $id);
    $adresses = $classoffre->get_adressesEntreprise($conn, $id);
    $data_offre[0]['entreprise_Adresse'] = $adresses[0]['Adresse'];
    $data_offre[0]['entreprise_Adresse2'] = $adresses[0]['Adresse_2'];
    $data_offre[0]['entreprise_Adresse3'] = $adresses[0]['Adresse_3'];
    return $data_offre;
}

function adminredirection(){
    if (!isset($_SESSION)) {
        session_start();
    }
    if (!isset($_SESSION['user'])) {
        header('Location: connexion.php');
        exit();
    } else if ($_SESSION['user']['Statut'] != 0) {
        header('Location: error.html');
        exit();
    }
}

function redirection(){
    if (!isset($_SESSION)) {
        session_start();
    }
    
    
    if (!isset($_SESSION['user'])) {
        header('Location: connexion.php');
        exit();
    }
}


function search($search_term){
    $dtb = initbdd();
    $classsearch = new search();
    $data = $classsearch->getall($search_term, $dtb);
    foreach ($data as $row) {
        switch ($row['category']) {
            case 'entreprise':
                echo '<a href="entreprise.php?ID_entreprise=' . $row['ID'] . '"><p class="all-item" data-id="' . $row['ID'] . '" style="background-color: transparent; cursor: pointer;" onmouseover="this.style.backgroundColor=\'blue\'" onmouseout="this.style.backgroundColor=\'transparent\'">' . $row['Nom'] . '</p></a>';
                break;
            case 'offre':
                echo '<a href="offre.php?ID_offre=' . $row['ID'] . '"><p class="all-item" data-id="' . $row['ID'] . '" style="background-color: transparent; cursor: pointer;" onmouseover="this.style.backgroundColor=\'blue\'" onmouseout="this.style.backgroundColor=\'transparent\'">' . $row['Nom'] . '</p></a>';
                break;
            case 'utilisateur':
                echo '<a href="utilisateur.php?ID_utilisateur=' . $row['ID'] . '"><p class="all-item" data-id="' . $row['ID'] . '" style="background-color: transparent; cursor: pointer;" onmouseover="this.style.backgroundColor=\'blue\'" onmouseout="this.style.backgroundColor=\'transparent\'">' . $row['Nom'] ." ". $row['Prénom'] . '</p></a>';
                break;
        }
    }
    
}

function initbdd(){
    $host = 'localhost';
    $dbname = 'phpmyadmin';
    $user = 'root';
    $password = '';
    $charset = 'utf8mb4';

    if (!isset($conn)) {
        try {
            $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=$charset", $user, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $databaseInitialized = true;
        } catch(PDOException $e) {
            echo "Erreur de connexion : " . $e->getMessage();
        }
    }else {
        // Connexion déjà faite
    }
    return $conn;
}
global $conn;
$conn = initbdd();
?>