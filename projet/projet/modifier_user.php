<?php
require_once(dirname(__FILE__) .'/bdd.php');
require_once(dirname(__FILE__) .'/tele.php');

session_start();
$error_message = "";
$req = array();

if (isset($_POST['envoi'])) {
    $statut = $_POST['statut'];
    $nom= $_POST['nom'];
    $prenom=$_POST['prenom'];
    $Centre= $_POST['Centre'];
    $promo=$_POST['promo'];
    $identifiant = $_POST['Login'];
    $mot_de_passe = $_POST['password'];
    $Id_user=$_POST['id_user'];
    if (!empty($_FILES['image']['name'])) {
        $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $img = 'src/profil/' . basename($identifiant) . '.' . $extension;
        traitement($img);
    } else {
        $sql = "SELECT logo FROM utilisateur WHERE ID_user = :Id_user";
        $quezy = $conn->prepare($sql);
        $quezy->bindParam(':Id_user', $Id_user);
        $quezy->execute();
        $ancien_chemin_image = $quezy->fetchColumn();
        $ancienne_extension = pathinfo($ancien_chemin_image, PATHINFO_EXTENSION);
        $img = 'src/profil/' . basename($identifiant) . '.' . $ancienne_extension;
        rename($ancien_chemin_image, $img);
    }
    
        try {
            if (update($statut,$nom,$prenom,$Centre,$promo,$identifiant, $mot_de_passe,$Id_user,$img, $conn)) {
                $error_message ='valider';
                
            } else {
                $error_message = "Une erreur à eu lieu";
            }
        } catch (PDOException $e) {
            $error_message = "Échec de la connexion à la base de données : " . $e->getMessage();
        }
    }
function update($statut,$nom,$prenom,$Centre,$promo,$identifiant, $mot_de_passe,$Id_user,$img, $conn){
    try {
        $sqllog = "UPDATE utilisateur SET  Nom = :nom, Prénom = :prenom, Login = :identifiant, Mot_de_passe = :mot_de_passe,Centre = :Centre, statut = :statut,logo=:logo WHERE ID_user = :id_user";
        $quezy = $conn->prepare($sqllog);
        $quezy->bindParam(':nom', $nom);
        $quezy->bindParam(':prenom', $prenom);
        $quezy->bindParam(':identifiant', $identifiant);
        $quezy->bindParam(':mot_de_passe', $mot_de_passe);
        $quezy->bindParam(':statut', $statut);
        $quezy->bindParam(':Centre', $Centre);
        $quezy->bindParam(':id_user', $Id_user);
        $quezy->bindParam(':logo', $img);
        $quezy->execute();
        $sql = "UPDATE integrer
                SET Id_Promo = :promo 
                WHERE ID_user=:Id_user";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':Id_user', $Id_user);
        $stmt->bindParam(':promo', $promo);

        
        $stmt->execute();

        return true;
    } catch (PDOException $e) {
        echo "Échec de la requête : " . $e->getMessage();
        return false;
    }
}


?>

<!DOCTYPE html>
<html lang="Fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Modification">
    <meta name="theme-color" content="#567BB2">
    <title>Modifier</title>
    <link href="style/compte.css" rel="stylesheet">
    
</head>
<body>
        <header class="bg-blue-900 text-white flex justify-between items-center  py-2 ">
                <a href="acceuil.html">
                <img src="src/logo.png" alt="logo du site" class="w-24 h-auto mr-0" ></a>
                <div class="flex items-center space-x-4 flex-grow"> 
                    <input type="text" class="w-full sm:w-48 md:w-200 lg:w-80 xl:w-200 h-10 px-4 rounded-full border border-gray-300 text-black" placeholder="Search">
                </div>
                <p class="hidden sm:inline ml-4">Nos offres </p> 
                <!-- faire que si on clique dessus un menu déroulant s'affiche en dessous -->
                &nbsp;&nbsp;&nbsp;&nbsp;<img src="src/user.svg" alt="profile picture" class="w-10 h-auto">&nbsp;&nbsp;  
        </header>
        <div class="flex justify-center items-center my-10" title="recherche">
            <div class="flex flex-col items-center">
                <input type="text" id="search" data-searchtype="user" placeholder="Rechercher..." class="w-64 border-2 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" onkeyup="searchData(this.value)">
                <div id="result" class="mt-4"></div>
            </div>
        </div>

    <main>
    <form method="post" enctype="multipart/form-data" class="flex flex-col md:flex-row justify-center items-center text-white">
        <input type="hidden" name="id_user" id="id_user" value="">

            <section title="formulaire creation" class="flex flex-row justify-center items-center bg-custom-green px-10 py-10 my-10">
                <section class="flex flex-col justify-center items-center">
                    <img src="src/user.png" id="img" class="w-44">
                    <input type="file" name="image" class="bg-custom-purple text-white text-lg w-24 h-14 rounded-full" accept="image/*" text="Parcourir">
                </section>
                <section title="input" class="flex flex-col justify-center items-center ">
                    <legend class="text-right ">Statut</legend>
                    <select id="statut" name="statut" class="w-96 mb-4 text-black">
                            <option value="1" name="Etudiant">Etudiant</option>
                            <option value="0" name="tuteur">Tuteur</option>
                    </select>
                    <div class="flex flex-row">
                        <legend class="flex-none">Nom</legend>
                        <input type="text" name="nom" id="nom" class="text-black">
                        <legend class="flex-none">Prenom</legend>
                        <input type="text" name="prenom" id="prenom" class="text-black">
                    </div>
                    
                    <legend>Centre</legend>
                    <input type="text" name="Centre" id="Centre" class="text-black">
                    <p>Promotion</p>
                    <select id="promo" name="promo"  class="text-black bg-white">
                            <option  value="1">X1_i1</option>
                            <option value="2">X1_i2</option>
                            <option  value="3">X1_i3</option>
                            <option  value="4">X1_i4</option>
                            <option  value="5">X1_i5</option>
                    </select>
                    <p>Login</p>
                    <input type="text" id="Login" name="Login" class="text-black">
                    <p>Mot de passe</p>
                    <input type="password" id="password" name="password" class="text-black">
                </section>
            </section>
            <section title="button part" >
                <button type="submit" name="envoi" class=" finish bg-blue-800 text-white text-lg rounded-full w-32 h-14 mx-10 hover:bg-blue-900">Valider</button>
            </section>
        </form>
    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="script/script.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</body>
</html>
