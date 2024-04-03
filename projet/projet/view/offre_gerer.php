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
    <link href="style/acceuil.css" rel="stylesheet">
    <link href="style/script.css" rel="stylesheet">
</head>
<body> 
    <?php require_once(dirname(__FILE__) .'/entete.php');?>
    <main class="mt-4">
        <p>Gerer les offres</p>
        <section class="container">
            <div class="box">
                <p><a href="crea_offre.php">Crée une offre</a></p>
            </div>
            <div class="box">
                <p><a href="modif_off.php">Modifier une offre</a></p>
            </div>
            <div class="box">
                <p><a href="del_off.php">Supprimer une offre</a></p>
            </div>
        </section>
    </main>
</body>
</html>