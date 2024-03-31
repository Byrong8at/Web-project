<?php require_once(dirname(__FILE__) .'/../controller/controller.php');
redirection();
$error_message = '';
if (isset($_POST['postuler'])) {
    $id_user=$_SESSION['user']['ID_user'];
    $id_offre= $_GET['ID_offre'];
    try {
        if (verif($id_user,$id_offre, $conn)){
            if (postuler($id_user,$id_offre, $conn)) {
                $error_message ='';
                
            } else {
                $error_message = "Une erreur à eu lieu";
            }}
        else {
            $error_message = "Vous avez déjà postuler à cette offre";
        }
    } catch (PDOException $e) {
        $error_message = "Échec de la connexion à la base de données : " . $e->getMessage();
    }
}


function verif($id_user,$id_offre, $conn){
    $sql = "SELECT *
    FROM candidature
    WHERE ID_user= :id_user AND ID_offre = :id_offre";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_user', $id_user);
    $stmt->bindParam(':id_offre', $id_offre);
    $stmt->execute();
    $count = $stmt->fetchColumn();
    if ($count == 0) {
        return true;
    }else{
        return false;
    }
}
function postuler($id_user,$id_offre,  $conn){
    $sql ="INSERT INTO candidature(ID_offre, ID_user) VALUES (:id_offre, :id_user)";
    $quezy = $conn->prepare($sql);
    $quezy->bindParam(':id_offre', $id_offre);
    $quezy->bindParam(':id_user', $id_user);
    $quezy->execute();
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
    <title>Offre</title>
</head>
<body>
    <?php require_once(dirname(__FILE__) .'/entete.php')?>
    <?php 
        require_once(dirname(__FILE__) .'/../modele/m_offre.php');
        $classoffre = new offre();
        $data_offre = $classoffre->get_all($conn, $_GET['ID_offre']);
        $data_offre[0]['entreprise_Nom'] = $classoffre->get_nomEntreprise($conn, $_GET['ID_offre']);
    ?>
    
    <main>
        <section class="w-full h-50vh relative">
            <img src="src/ibm.jpeg" class="w-full h-96">
            <div class="flex flex-col justify-center absolute top-0 left-0 right-0 bottom-0">
                <h1 class="text-2xl md:text-3xl lg:text-4xl text-white px-8 py-2 font-size: 3vmin"><?php echo $data_offre[0]['entreprise_Nom'];?></h1>
            </div>
        </section>
        <h2 class="text-2xl mx-4 py-4 md:text-3xl lg:text-4xl">Nom de l'offre : <?php echo $data_offre[0]['Nom'];?></h2>
        <h2 class="text-2xl mx-4 py-4 md:text-3xl lg:text-4xl">Ajouté le : <?php echo $data_offre[0]['date_de_l_offre'];?></h2>
        <h2 class="text-2xl mx-4 py-4 md:text-3xl lg:text-4xl">Compétences requis : <?php echo $data_offre[0]['competences'];?></h2>
        <h2 class="text-2xl mx-4 py-4 md:text-3xl lg:text-4xl">Durée du contrat : <?php echo $data_offre[0]['durée_du_stage'];?> mois</h2>
        <h2 class="text-2xl mx-4 py-4 md:text-3xl lg:text-4xl">nbr de place : <?php echo $data_offre[0]['place'];?></h2>
        <h2 class="text-2xl mx-4 py-4 md:text-3xl lg:text-4xl">teletravail :
            <?php 
                if($data_offre[0]['Teletravail'] == 1){
                    echo 'Oui';
                }else{
                    echo 'Non';
                };
            ?>
        </h2>
        <h2 class="text-2xl mx-4 py-4 md:text-3xl lg:text-4xl">Description : <?php echo $data_offre[0]['detail'];?></h2>
        <form method="Post">
        <?php
            echo '<p name="error-message" style="color: red;">' . $error_message . '</p>';
        if ($_SESSION['user']['Statut'] == 1){?>
            <button type="submit" name="postuler" class="bg-custom-green px-8 py-8 flex justify-items-end text-white ml-auto mr-4 rounded-md">Postuler</button>
            <?php } ?>
        </form>
    </main>

    <?php require_once(dirname(__FILE__) .'/footer.php')?>
</body>
</html>