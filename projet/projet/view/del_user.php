<?php
require_once(dirname(__FILE__) .'/../controller/controller.php');
adminredirection();
$error_message = "";
$req = array();

if (isset($_POST['envoi'])) {
    $Id_user=$_POST['id_user'];
    
    
        try {
            if (supprimer($Id_user, $conn)) {
                $error_message ='valider';
                
            } else {
                $error_message = "Une erreur à eu lieu";
            }
        } catch (PDOException $e) {
            $error_message = "Échec de la connexion à la base de données : " . $e->getMessage();
        }
    }
function supprimer($Id_user, $conn){
    try {
        //ordre attention pour user, offre et ent
        $sql = "DELETE FROM integrer
                WHERE ID_user=:Id_user";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':Id_user', $Id_user);
        $stmt->execute();

        $del = "DELETE FROM candidature
                WHERE ID_user=:Id_user";
        $stmt = $conn->prepare($del);
        $stmt->bindParam(':Id_user', $Id_user);
        $stmt->execute();

        $del = "DELETE FROM wishlist
                WHERE ID_user=:Id_user";
        $stmt = $conn->prepare($del);
        $stmt->bindParam(':Id_user', $Id_user);
        $stmt->execute();

        $sqllog = "DELETE FROM utilisateur  WHERE ID_user = :id_user";
        $quezy = $conn->prepare($sqllog);
        $quezy->bindParam(':id_user', $Id_user);
        $quezy->execute();
        

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
    <title>Supprimer</title>
    <link href="style/compte.css" rel="stylesheet">
    
</head>
<body>
    <?php require_once(dirname(__FILE__) .'/entete.php');?>
        <div class="flex justify-center items-center my-10" title="recherche">
            <div class="flex flex-col items-center">
                <input type="text" id="search" data-searchtype="user" placeholder="Rechercher..." class="w-64 border-2 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" onkeyup="searchData(this.value)">
                <div id="result" class="mt-4"></div>
            </div>
        </div>

    <main>
    <form method="post" class="flex flex-col md:flex-row justify-center items-center text-white">
        <input type="hidden" name="id_user" id="id_user" value="">

            <section title="formulaire creation" class="flex flex-row justify-center items-center bg-custom-green px-10 py-10 my-10">
                <section class="flex flex-col justify-center items-center">
                    <img src="src/user.png" class="w-44">
                    <button class="bg-custom-purple text-white text-lg w-24 h-14 rounded-full">Supprimer</button>
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
                <button type="submit" name="envoi" class=" finish bg-red-800 text-white text-lg rounded-full w-32 h-14 mx-10 hover:bg-red-900">Supprimer</button>
            </section>
        </form>
    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="script/script.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</body>
</html>
