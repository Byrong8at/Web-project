<?php
require_once(dirname(__FILE__) .'/../controller/controller.php');
adminredirection();


$error_message = "";
$req = array();

if (isset($_POST['envoi'])) {
    
        try {
            if (update_off($nom, $competences, $detail, $promo, $duree, $dates, $salaire, $place, $visible, $tele,$ent, $offre, $conn)) {
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
    
function valider_stage($nom, $competences, $detail, $promo, $duree, $dates, $salaire, $place, $visible, $tele,$ent, $offre, $conn){
    try {
        $sqllog = "UPDATE offre SET  Nom = :nom, competences = :competences, detail = :detail, promo = :promo,durée_du_stage = :duree,Rémunération=:salaire ,date_de_l_offre = :dates,place=:place,Voir=:visible,Teletravail=:tele,ID_entreprise=:ent WHERE ID_offre = :id_offre";
        $quezy = $conn->prepare($sqllog);
        $quezy->bindParam(':nom', $nom);
        $quezy->bindParam(':competences', $competences);
        $quezy->bindParam(':detail', $detail);
        $quezy->bindParam(':promo', $promo);
        $quezy->bindParam(':duree', $duree);
        $quezy->bindParam(':salaire', $salaire);
        $quezy->bindParam(':dates', $dates);
        $quezy->bindParam(':place', $place);
        $quezy->bindParam(':visible', $visible);
        $quezy->bindParam(':tele', $tele);
        $quezy->bindParam(':ent', $ent);
        $quezy->bindParam(':id_offre', $offre);
        $quezy->execute();
        

        return true;
    } catch (PDOException $e) {
        echo "Échec de la requête : " . $e->getMessage();
        return false;
    }
}

function entreprise($conn){
    try {
        $sql = "SELECT * FROM entreprise";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Erreur ent" . $e->getMessage();
    }
}

$name_ent=entreprise($conn);
?>

<!DOCTYPE html>
<html lang="Fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Modification">
    <meta name="theme-color" content="#567BB2">
    <title>Modifier offre</title>
    <link href="style/compte.css" rel="stylesheet">
    
</head>
<body>
    <?php require_once(dirname(__FILE__) .'/entete.php');?>
        <div class="flex justify-center items-center my-10" title="recherche">
            <div class="flex flex-col items-center">
                <input type="text" id="search" data-searchtype="candidature" placeholder="Rechercher..." class="w-64 border-2 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" onkeyup="searchData(this.value)">
                <div id="result" class="mt-4"></div>
            </div>
        </div>

    <main>

        <section title="affichage" class="flex flex-col justify-center items-center text-white px-10 py-10 my-10">
            <div id="candi" class="mt-4 grid grid-cols-3 gap-4"></div>
                    
        <section>    
    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="script/postuler.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</body>
</html>