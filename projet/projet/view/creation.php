<?php

require_once(dirname(__FILE__) .'/tele.php');
require_once(dirname(__FILE__) .'/../controller/controller.php');
adminredirection();

$error_message = "";

if (isset($_POST['envoi'])) {
        //rajouter empty
        $statut = $_POST['statut'];
        $nom= $_POST['nom'];
        $prenom=$_POST['prenom'];
        $Centre= $_POST['Centre'];
        $promo=$_POST['promo'];
        $identifiant = $_POST['Login'];
        $mot_de_passe = hash("sha256", $_POST["pass"]);
        if(empty($_FILES['image']['name'])){
            $img=null;
        }
        else{
        $img = 'src/profil/' . basename($identifiant) . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        traitement( $img);
        }
        
        try {
            if (creation($statut,$nom,$prenom,$Centre,$promo,$identifiant, $mot_de_passe,$img, $conn)) {
                $error_message ='valider';
                
            } else {
                $error_message = "Une erreur à eu lieu";
            }
        } catch (PDOException $e) {
            $error_message = "Échec de la connexion à la base de données : " . $e->getMessage();
        }
    }


function creation($statut,$nom,$prenom,$Centre,$promo,$identifiant, $mot_de_passe,$img, $conn){
    try {
        $sqllog = "INSERT INTO utilisateur(statut, Nom, Prénom, Centre, Login, Mot_de_passe,logo) VALUES (:statut, :nom, :prenom, :Centre, :identifiant, :mot_de_passe, :logo)";
        $quezy = $conn->prepare($sqllog);
        $quezy->bindParam(':statut', $statut);
        $quezy->bindParam(':nom', $nom);
        $quezy->bindParam(':prenom', $prenom);
        $quezy->bindParam(':Centre', $Centre);
        $quezy->bindParam(':identifiant', $identifiant);
        $quezy->bindParam(':mot_de_passe',$mot_de_passe);
        $quezy->bindParam(':logo', $img);
        $quezy->execute();
        $sql = "INSERT INTO integrer (ID_user, Id_Promo)
            VALUES (
                (SELECT ID_user FROM utilisateur WHERE Login = :identifiant LIMIT 1),
                (SELECT Id_Promo FROM promotion WHERE Id_Promo = :promo LIMIT 1)
            )";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':identifiant', $identifiant);
        $stmt->bindParam(':promo', $promo);

        
        $stmt->execute();

        return true;
    } catch (PDOException $e) {
        $error_message= "Échec de la requête : " . $e->getMessage();
        return false;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creation">
    <meta name="theme-color" content="#567BB2">
    <link rel="stylesheet" href="style/user_cre.css">
    <link rel="stylesheet" href="style/offre_gerer.css">
    <title>Creation utilisateur</title>
</head>
<body> 
    <?php require_once(dirname(__FILE__) .'/entete.php');?>
    
    <body>
    <main>
    <?php
            echo '<p name="error-message">' . $error_message . '</p>';
        ?>
        <form method="post" enctype="multipart/form-data">
            <section title="formulaire creation">
                <section>
                    <img src="src/user.png" class="w-44" alt="image user">
                    <input type="file" name="image" accept="image/*">
                </section>
                <section title="input">
                    <legend>Statut</legend>
                    <select name="statut">
                        <?php if ($_SESSION['user']['Statut'] == 0){?>
                            <option value="1" name="Etudiant">Etudiant</option>
                        <?php }else{?>
                            <option value="1" name="Etudiant">Etudiant</option>
                            <option value="0" name="tuteur">Tuteur</option>
                        <?php }?>
                    </select>
                    <div>
                        <legend>Nom</legend>
                        <input type="text" name="nom">
                        <legend>Prenom</legend>
                        <input type="text" name="prenom">
                    </div>
                    <legend>Centre</legend>
                    <input type="text" name="Centre">
                    <p>Promotion</p>
                    <select name="promo">
                        <option  value="1">X1_i1</option>
                        <option value="2">X1_i2</option>
                        <option  value="3">X1_i3</option>
                        <option  value="4">X1_i4</option>
                        <option  value="5">X1_i5</option>
                    </select>
                    <p>Login</p>
                    <input type="text" name="Login">
                    <p>Mot de passe</p>
                    <input type="password" name="pass">
                </section>
            </section>
            <section title="button part">
                <button type="submit" name="envoi" class="finish bg-blue-800 text-white text-lg rounded-full w-32 h-14 mx-10 hover:bg-blue-900 ">Valider</button>
                <button class="reinitialiser bg-blue-800 text-white text-lg rounded-full w-32 h-14 mx-10 hover:bg-blue-900 " onclick="restart()">Reinitialiser</button>
            </section>
        </form>
    </main>
    <script src="script/creation.js"></script>
</body>
</html>