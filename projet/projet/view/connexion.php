<?php
require_once(dirname(__FILE__) .'/../controller/controller.php');
session_start();

$error_message = "";

if (isset($_POST['envoi'])) {
    if (!empty($_POST['identifiant']) AND !empty($_POST['password'])) {
        $identifiant = $_POST['identifiant'];
        $mot_de_passe = hash("sha256", $_POST["password"]);

        try {
            if ($data = login($identifiant, $mot_de_passe, $conn)) {
                $_SESSION['user'] = $data;
                header('Location: acceuil.php');
                exit();
            } else {
                $error_message = "Votre identifiant ou mot de passe ne correspond pas";
            }
        } catch (PDOException $e) {
            $error_message = "Échec de la connexion à la base de données : " . $e->getMessage();
        }
    }else{
        $error_message = "Veuillez completez tout les champs";
    }}

function login($identifiant, $mot_de_passe, $conn) {
    try {
        $sqllog = "SELECT * FROM utilisateur WHERE Login = ? and Mot_de_passe=?";
        $quezy = $conn->prepare($sqllog);
        $quezy->execute([$identifiant, $mot_de_passe]);
        $user = $quezy->fetch(PDO::FETCH_ASSOC);
        print_r($user);
        print_r($mot_de_passe);

        if ($user !== false ) {
            return $user;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        $error_message= "Échec de la requête : " . $e->getMessage();
        return false;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="manifest" href="manifest.json">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Page de conenxion">
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

            <?php
                echo '<p name="error-message" style="color: red;">' . $error_message . '</p>';
            ?>

            <h4 class="info_connexion">Identifiant</h4>
            <input type="text" name="identifiant" class="info_button" aria-label="Search">
            <h4 class="info_connexion">Mot de passe</h4>
            <input type="password" name="password" class="info_button" aria-label="Search">
            <br>
            <button type="submit" class="cesi" name="envoi"> Se connecter</button>
            <br>
            <button class="cesi"><img src="src/cesi.png" alt="logo de cesi" id="logo_button"> Connection avec L'ent Cesi</button>
            <p></p>
            <i>problème de connexion</i>
        </form>
    </main> 
</body>
</html>
