<?php
require_once(dirname(__FILE__) .'/bdd.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $identifiant = $_POST['identifiant'];
    $mot_de_passe = $_POST['mot_de_passe'];
    login($identifiant, $mot_de_passe, $conn);
}

function login($identifiant, $mot_de_passe, $conn) {
    $sqllog = "SELECT * FROM utilisateur WHERE Login = ? AND Mot_de_passe = ?";
    $quezy = $conn->prepare($sqllog);
    $quezy->execute([$identifiant, $mot_de_passe]);
    $user = $quezy->fetch(PDO::FETCH_ASSOC);
    if ($user) {
        header('Location: acceuil.html');
    } else {
        echo "Votre identifiant ou mot de passe ne correspond pas";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="style/styleco.css">
</head>
<body>
    <main>
        <header>
        <div class="image-container">
            <img src="src/entretien.jpeg" alt="image entretien" id="image_deco">
            <div class="text-overlay">
                <h2 id="site_name">CESI TON EMPLOI <img src="src/logo.png" alt="logo CTE" id="site_logo"></h2>
            </div>
        </div>
        </header>
        <form method="post" action="" id="Connexion_form">
            <title>Connexion</title>
            <h3>connexion</h3>

            <p></p>

            <h4 class="info_connexion">Identifiant</h4>
            <input type="text" name="identifiant" class="info_button">
            <h4 class="info_connexion">Mot de passe</h4>
            <input type="password" name="mot_de_passe" class="info_button">
            <br>
            <button class="cesi"><img src="src/cesi.png" alt="logo de cesi" id="logo_button"> Connection avec L'ent Cesi</button>
            <br>
            <button type="submit" class="cesi"> Se connecter</button>
            <p></p>
            <i>problème de connexion</i>
        </form>
    </main>
</body>
</html>
