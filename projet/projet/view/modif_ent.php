<?php
require_once(dirname(__FILE__) . '/../Modele/bdd.php');
require_once(dirname(__FILE__) .'/tele.php');

session_start();
$error_message = "";
$req = array();

if (isset($_POST['envoi'])) {
    if(!empty($_POST['nom'])AND !empty($_POST['secteur']) AND !empty($_POST['adr_1'])){
        $nom= $_POST['nom'];
        $secteur=$_POST['secteur'];
        $adr_1= $_POST['adr_1'];
        $adr_2=$_POST['adr_2'];
        $adr_3 = $_POST['adr_3'];
        $visible = isset($_POST['visible']) ? (int) $_POST['visible'] : 0;
        $id_ent=$_POST['id_user'];
        if (!empty($_FILES['image']['name'])) {
            $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $img = 'src/logo/' . basename($nom) . '.' . $extension;
            traitement($img);
        } else {
            $sql = "SELECT logo FROM entreprise WHERE ID_entreprise = :id_ent";
            $quezy = $conn->prepare($sql);
            $quezy->bindParam(':id_ent', $id_ent);
            $quezy->execute();
            $ancien_chemin_image = $quezy->fetchColumn();
            $ancienne_extension = pathinfo($ancien_chemin_image, PATHINFO_EXTENSION);
            $img = 'src/logo/' . basename($nom) . '.' . $ancienne_extension;
            rename($ancien_chemin_image, $img);
        }
        try {
            if (update_ent($nom,$secteur,$adr_1,$adr_2,$adr_3, $visible,$img,$id_ent, $conn)) {
                $error_message ='';
                
            } else {
                $error_message = "Une erreur à eu lieu";
            }
        } catch (PDOException $e) {
            $error_message = "Échec de la connexion à la base de données : " . $e->getMessage();
        }}
        else{
            $error_message="Veuillez completez les champs obligatoires";
        }
    }
function update_ent($nom,$secteur,$adr_1,$adr_2,$adr_3, $visible,$img,$id_ent, $conn){
    try {
        $sqllog = "UPDATE entreprise SET  Nom = :nom, secteur_d_activité = :secteur, Adresse = :adr_1, Adresse_2 = :adr_2,Adresse_3 = :adr_3, Voir = :visible,logo=:img WHERE ID_entreprise = :id_ent";
        $quezy = $conn->prepare($sqllog);
        $quezy->bindParam(':nom', $nom);
        $quezy->bindParam(':secteur', $secteur);
        $quezy->bindParam(':adr_1', $adr_1);
        $quezy->bindParam(':adr_2', $adr_2);
        $quezy->bindParam(':adr_3', $adr_3);
        $quezy->bindParam(':visible', $visible);
        $quezy->bindParam(':img', $img);
        $quezy->bindParam(':id_ent', $id_ent);
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
    <title>Modifier entreprise</title>
    <link href="style/compte.css" rel="stylesheet">
    
</head>
<body>
    <?php require_once(dirname(__FILE__) .'/../controller/adminredirection.php');?>   
    <?php require_once(dirname(__FILE__) .'/entete.php');?>
        <div class="flex justify-center items-center my-10" title="recherche">
            <div class="flex flex-col items-center">
                <input type="text" id="search" data-searchtype="entreprise" placeholder="Rechercher..." class="w-64 border-2 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" onkeyup="searchData(this.value)">
                <div id="result" class="mt-4"></div>
            </div>
        </div>

    <main>
    <form method="post" enctype="multipart/form-data" class="flex flex-col md:flex-row justify-center items-center text-white">
        <input type="hidden" name="id_user" id="id_user" value="">
        <section title="formulaire creation" class="flex flex-row justify-center items-center bg-custom-green px-10 py-10 my-10">
                <section class="flex flex-col justify-center items-center">
                    <img src="src/user.png" id="img" class="w-44">
                    <input type="file" id="image" value="" name="image" class="bg-custom-purple text-white text-lg w-24 h-14 rounded-full" accept="image/*">Parcourir</button>
                </section>
                <section title="input" class="flex flex-col justify-center items-center ">
                    <div class="flex flex-row">
                        <legend class="flex-none">Nom</legend>
                        <input type="text" id="nom" name="nom" class="text-black">
                        <legend class="flex-none">Secteur d'activité</legend>
                        <input type="text" id="secteur" name="secteur" class="text-black">
                    </div>
                    
                    <legend>Adresse</legend>
                    <input type="text" id="adr_1" name="adr_1" class="text-black" required>
                    <legend>Adresse 2</legend>
                    <input type="text" id="adr_2" name="adr_2" class="text-black">
                    <legend>Adresse 3</legend>
                    <input type="text" id="adr_3" name="adr_3" class="text-black">
                    
                    <p>Rendre visible?</p>
                    <input type="checkbox" id="visible" name="visible" value="1">                    
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
