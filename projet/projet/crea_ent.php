<?php
require_once(dirname(__FILE__) .'/bdd.php');
session_start();

$error_message = "";

if (isset($_POST['envoi'])) {
    if(!empty($_POST['nom'])AND !empty($_POST['secteur']) AND !empty($_POST['adr_1'])){
        $nom= $_POST['nom'];
        $secteur=$_POST['secteur'];
        $adr_1= $_POST['adr_1'];
        $adr_2=$_POST['adr_2'];
        $adr_3 = $_POST['adr_3'];
        $visible = isset($_POST['visible']) ? (int) $_POST['visible'] : 0;
        $note=0.0;
        $avis=0;
        $img = "src/logo/".$nom;
        traitement($nom,$img);
        //"src/logo/".$nom
        try {
            if (creation($nom,$secteur,$adr_1,$adr_2,$adr_3, $visible,$avis,$note,$img, $conn)) {
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


function traitement($nom,$img) {
    if (!empty($_FILES['image']['name'])) {
        $targetDir = 'src/logo/';
        $targetFile = $targetDir . basename($nom) . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

        $check = getimagesize($_FILES['image']['tmp_name']);
        if ($check !== false) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                $img = $targetFile;
            } else {
                $error_message = "Une erreur est survenue lors du téléchargement de l'image.";
            }
        } else {
            $error_message = "Le fichier n'est pas une image valide.";
        }
    
}
return $img;
}
function creation($nom, $secteur, $adr_1, $adr_2, $adr_3, $visible, $avis, $note, $img, $conn) {
    try {
        $sql = "SELECT COUNT(*) FROM entreprise WHERE Nom = :nom";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nom', $nom);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            $error_message = "l'entreprise existe déjà";
            return false;
        }

        $sqllog = "INSERT INTO entreprise(Nom, secteur_d_activité, Adresse, Adresse_2, Adresse_3, Note_avis, Stat_postule, Voir, logo) VALUES (:nom, :secteur, :adr_1, :adr_2, :adr_3, :note, :stat, :visible, :img)";
        $quezy = $conn->prepare($sqllog);
        $quezy->bindParam(':nom', $nom);
        $quezy->bindParam(':secteur', $secteur);
        $quezy->bindParam(':adr_1', $adr_1);
        $quezy->bindParam(':adr_2', $adr_2);
        $quezy->bindParam(':adr_3', $adr_3);
        $quezy->bindParam(':note', $note);
        $quezy->bindParam(':stat', $avis);
        $quezy->bindParam(':visible', $visible);
        $quezy->bindParam(':img', $img);
        $quezy->execute();
    } catch (PDOException $e) {
        echo "Échec de la requête : " . $e->getMessage();
        return false;
    }
    return true;
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Modification">
    <meta name="theme-color" content="#567BB2">
    <link rel="stylesheet" href="style/user_cre.css">
    <title>Creation entreprise</title>
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
    
    <main>
        <header class="flex justify-center items-center text-black text-4xl my-10 font-bold">
            <p>Creation d'une entreprise</p>
            
        </header>
        <?php
            echo '<p name="error-message" style="color: red;">' . $error_message . '</p>';
        ?>
        <form method="post" enctype="multipart/form-data" class="flex flex-col md:flex-row justify-center items-center text-white">
            <section title="formulaire creation" class="flex flex-row justify-center items-center bg-custom-green px-10 py-10 my-10">
                <section class="flex flex-col justify-center items-center">
                    <img src="src/user.png" class="w-44">
                    <input type="file" name="image" class="bg-custom-purple text-white text-lg w-24 h-14 rounded-full" accept="image/*">Parcourir</button>
                </section>
                <section title="input" class="flex flex-col justify-center items-center ">
                    <div class="flex flex-row">
                        <legend class="flex-none">Nom</legend>
                        <input type="text" name="nom" class="text-black">
                        <legend class="flex-none">Secteur d'activité</legend>
                        <input type="text" name="secteur" class="text-black">
                    </div>
                    
                    <legend>Adresse</legend>
                    <input type="text" name="adr_1" class="text-black" required>
                    <legend>Adresse 2</legend>
                    <input type="text" name="adr_2" class="text-black">
                    <legend>Adresse 3</legend>
                    <input type="text" name="adr_3" class="text-black">
                    
                    <p>Rendre visible?</p>
                    <input type="checkbox" name="visible" value="1">                    
                </section>
            </section>
            <section title="button part" >
                <button type="submit" name="envoi" class=" finish bg-blue-800 text-white text-lg rounded-full w-32 h-14 mx-10 hover:bg-blue-900">Valider</button>
                <button class="reinitialiser bg-red-700 text-white text-lg rounded-full px-6 h-14 hover:bg-red-900" onclick="restart()">Reinitialiser</button>
            </section>
        </form>
    </main>
    
    <script src="script/creation.js"></script>
</body>
</html>