<?php require_once(dirname(__FILE__) .'/../controller/redirection.php')?>
<?php require_once(dirname(__FILE__) .'/../modele/bdd.php')?>
<!DOCTYPE html>
<html lang="en">
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
    </main>

    <?php require_once(dirname(__FILE__) .'/footer.php')?>
</body>
</html>