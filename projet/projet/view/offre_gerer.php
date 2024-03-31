<?php 
    require_once(dirname(__FILE__) .'/../controller/controller.php');
    adminredirection();
    ?>  
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="gere eleve">
    <meta name="theme-color" content="#567BB2">
    <title>Gerer offre</title>
    <link rel="stylesheet" href="style/gerer.css" >
</head>
<body> 
    <?php require_once(dirname(__FILE__) .'/entete.php');?>
    <main class="my-32">
        <p class="text-xl flex justify-center items-center">Gerer les offres</p>
        <section title="choix"class=" mx-10 flex  justify-between items-center ">
            <section title="crée" class="bg-blue-500 text-white px-10 py-10">
                <p><a href="crea_offre.php">Crée une offre</p>
            </section>
            <section title="crée" class="bg-blue-500 text-white px-10 py-10">
                <p><a href="modif_off.php">Modifier une offre</p>
            </section>
            <section title="crée" class="bg-blue-500 text-white px-10 py-10">
                <p><a href="del_off.php">Supprimer une offre</p>
            </section>


        </section>
    </main>
    <?php require_once(dirname(__FILE__) .'/footer.php');?>
</body>
</html>