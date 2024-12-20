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
        $error_message= "Échec de la requête : " . $e->getMessage();
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
    <link rel="stylesheet" href="style/offre_gerer.css">
    
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
    <?php
            echo '<p name="error-message">' . $error_message . '</p>';
        ?>
    <form method="post" enctype="multipart/form-data" class="">
        <input type="hidden" name="id_user" id="id_user" value="">

            <section title="formulaire creation" class="">
                <section class="r">
                    
                    <img src="src/user.png" id="img" class="w-44">
                </section>
                <section title="input" class="">
                    <legend class="text-left ">Statut</legend>
                    <select id="statut" name="statut" class=" text-black">
                            <?php if ($_SESSION['user']['Statut'] == 0){?>
                                <option value="1" name="Etudiant">Etudiant</option>
                            <?php }else{?>
                                <option value="1" name="Etudiant">Etudiant</option>
                                <option value="0" name="tuteur">Tuteur</option>
                            <?php }?>
                    </select>
                        <legend >Nom</legend>
                        <input type="text" name="nom" id="nom" class="text-black">
                        <legend >Prenom</legend>
                        <input type="text" name="prenom" id="prenom" class="text-black">
                    
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
                </section>
            </section>
            <section title="button part" >
                <button type="submit" name="envoi" class=" finish bg-red-800 text-white text-lg rounded-full  w-32 h-14 mx-10 hover:bg-red-900">Supprimer</button>
                
            </section>
        </form>
    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="script/script.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</body>
</html>
