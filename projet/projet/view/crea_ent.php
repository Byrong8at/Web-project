<?php
    require_once(dirname(__FILE__) .'/tele.php');
    require_once(dirname(__FILE__) .'/../controller/controller.php');
    adminredirection();

$error_message = "";

if (isset($_POST['envoi'])) {
    if(!empty($_POST['nom'])AND !empty($_POST['secteur']) AND !empty($_POST['adr_1'])){
        $nom= $_POST['nom'];
        $secteur=$_POST['secteur'];
        $adr_1= $_POST['adr_1'];
        $adr_2=$_POST['adr_2'];
        $adr_3 = $_POST['adr_3'];
        $visible = isset($_POST['visible']) ? (int) $_POST['visible'] : 0;
        $img = 'src/logo/' . basename($nom) . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        traitement($img);
        //"src/logo/".$nom
        try {
            if (creation($nom,$secteur,$adr_1,$adr_2,$adr_3, $visible,$img, $conn)) {
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



function creation($nom, $secteur, $adr_1, $adr_2, $adr_3, $visible, $img, $conn) {
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

        $sqllog = "INSERT INTO entreprise(Nom, secteur_d_activité, Adresse, Adresse_2, Adresse_3, Voir, logo) VALUES (:nom, :secteur, :adr_1, :adr_2, :adr_3,  :visible, :img)";
        $quezy = $conn->prepare($sqllog);
        $quezy->bindParam(':nom', $nom);
        $quezy->bindParam(':secteur', $secteur);
        $quezy->bindParam(':adr_1', $adr_1);
        $quezy->bindParam(':adr_2', $adr_2);
        $quezy->bindParam(':adr_3', $adr_3);
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
    <link rel="stylesheet" href="style/offre_gerer.css">
    <title>Creation entreprise</title>
</head>
<body>
    <?php require_once(dirname(__FILE__) .'/entete.php');?>
    
    <main>
        <header class="flex justify-center items-center text-black text-4xl my-10 font-bold">
            <p>Creation d'une entreprise</p>
            
        </header>
        <?php
            echo '<p name="error-message" style="color: red;">' . $error_message . '</p>';
        ?>
        <form method="post" enctype="multipart/form-data" class="">
            <section title="formulaire creation" class="">
                <section class="">
                    <img src="src/user.png" class="w-44">
                    <input type="file" name="image" class="" accept="image/*">
                </section>
                <section title="input" class=" ">
                        <legend class="flex-none">Nom</legend>
                        <input type="text" name="nom" class="text-black">
                        <legend class="flex-none">Secteur d'activité</legend>
                        <input type="text" name="secteur" class="text-black">
                    
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