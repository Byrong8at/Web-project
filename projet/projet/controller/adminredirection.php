<?php
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
?>