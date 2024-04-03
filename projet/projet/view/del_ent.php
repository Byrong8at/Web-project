<?php
require_once(dirname(__FILE__) .'/tele.php');
require_once(dirname(__FILE__) .'/../controller/controller.php');
adminredirection();
$error_message = "";
$req = array();

if (isset($_POST['envoi'])) {
    if(!empty($_POST['nom'])AND !empty($_POST['secteur']) AND !empty($_POST['adr_1'])){
        $id_ent=$_POST['id_user'];
        
        }
        try {
            if (delete_ent($id_ent, $conn)) {
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
    
function delete_ent($id_ent, $conn){
    try {
        $sql = "DELETE FROM offre
                WHERE ID_entreprise=:id_ent";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_ent', $id_ent);
        $stmt->execute();
        delete_img($conn,$id_ent);
        $del = "DELETE FROM entreprise
                WHERE ID_entreprise=:id_ent";
        $stmt = $conn->prepare($del);
        $stmt->bindParam(':id_ent', $id_ent);
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
    <title>Supprimer entreprise</title>
    <link href="style/compte.css" rel="stylesheet">
    <link rel="stylesheet" href="style/offre_gerer.css">
    
</head>
<body>
    <?php require_once(dirname(__FILE__) .'/entete.php');?>
        <div class="flex justify-center items-center my-10" title="recherche">
            <div class="flex flex-col items-center">
                <input type="text" id="search" data-searchtype="entreprise" placeholder="Rechercher..." class="w-64 border-2 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" onkeyup="searchData(this.value)">
                <div id="result" class="mt-4"></div>
            </div>
        </div>

    <main>
    <form method="post" enctype="multipart/form-data" class="">
        <input type="hidden" name="id_user" id="id_user" value="">
        <section title="formulaire creation" class="">
                <section class="">
                    <img src="src/user.png" id="img" class="w-44">
                </section>
                <section title="input" class="flex flex-col justify-center items-center ">
                        <legend class="flex-none">Nom</legend>
                        <input type="text" id="nom" name="nom" class="text-black">
                        <legend class="flex-none">Secteur d'activité</legend>
                        <input type="text" id="secteur" name="secteur" class="text-black">
                    
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
                <button type="submit" name="envoi" class=" finish bg-red-600 text-white text-lg rounded-full w-32 h-14 mx-10 hover:bg-red-900">Supprimer</button>
            </section>
        </form>
    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="script/script.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</body>
</html>
