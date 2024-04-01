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
        $data_offre = page_offre($_GET['ID_offre']);
        
    ?>
    
    <main>
            <img src="src/ibm.jpeg" class="w-full h-96">
        <section class="flex justify-between items-center"> 
            <h2 class="text-xl mx-4 py-4 md:text-2xl lg:text-3xl font-bold  underline">Nom de l'offre : <?php echo $data_offre[0]['Nom'];?></h2>
            <h2 class="text-md mx-4 py-4 md:text-lg lg:text-lg">Ajouté le : <?php echo $data_offre[0]['date_de_l_offre'];?></h2>
        </section>
        <section class="flex flex-row  items-center mb-2 ">
            <p class="text-lg ml-4 md:text-lg lg:text-xl italic"><?php echo $data_offre[0]['entreprise_Nom'];?></p>
            <p class="text-lg md:text-lg lg:text-xl italic">/<Adresse></p>
            <p class="text-lg md:text-lg lg:text-xl">/Compétences :<?php echo $data_offre[0]['competences'];?></p>
        </section>
        
        <h2 class="text-lg mx-4 py-4 md:text-lg lg:text-xl">Durée du stage : <?php echo $data_offre[0]['durée_du_stage'];?> mois</h2>
        <h2 class="text-lg mx-4 py-4 md:text-lg lg:text-xl">Nombre de place disponible : <?php echo $data_offre[0]['place'];?></h2>
        <h2 class="text-lg mx-4 py-4 md:text-lg lg:text-xl">Y'a t'il du teletravail :
            <?php 
                if($data_offre[0]['Teletravail'] == 1){
                    echo 'Oui';
                }else{
                    echo 'Non';
                };
            ?>
        </h2>
        <?php
            if($data_offre[0]['entreprise_Adresse'] != ""){
                echo "<h2 class='text-lg mx-4 py-4 md:text-lg lg:text-xl'>Adresse : " . $data_offre[0]['entreprise_Adresse'] . "</h2>";
            }
            if($data_offre[0]['entreprise_Adresse2'] != ""){
                echo "<h2 class='text-lg mx-4 py-4 md:text-lg lg:text-xl'>Adresse 2 : " . $data_offre[0]['entreprise_Adresse2'] . "</h2>";
            }
            if($data_offre[0]['entreprise_Adresse3'] != ""){
                echo "<h2 class='text-lg mx-4 py-4 md:text-lg lg:text-xl'>Adresse 3 : " . $data_offre[0]['entreprise_Adresse3'] . "</h2>";
            }
        ?>

        <h2 class="text-lg mx-4 md:text-lg lg:text-xl">Tes missions : <?php echo $data_offre[0]['detail'];?></h2>
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