<?php
require_once(dirname(__FILE__) .'/../modele/m_entreprise.php');
require_once(dirname(__FILE__) .'/../modele/m_offre.php');
require_once(dirname(__FILE__) .'/../modele/m_user.php');

function get_all($id,$name){
    global $conn;
    if ($name = "entreprise"){
        $classentreprise = new entreprise();
        $data_entreprise = $classentreprise->get_all($conn, $id);
        return $data_entreprise;
    }else if ($name = "user"){
        $classuser = new user();
        $data_user = $classuser->get_all($conn, $id);
        return $data_user;
    }else if ($name = "offre"){
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