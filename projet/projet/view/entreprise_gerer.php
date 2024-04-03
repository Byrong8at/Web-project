<?php 
    require_once(dirname(__FILE__) .'/../controller/controller.php');
    adminredirection();
    ?>  
<!DOCTYPE html>
<html lang="fr">
<head>
<link rel="manifest" href="manifest.json">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="gere eleve">
    <meta name="theme-color" content="#567BB2">
    <title>Gerer offre</title>
    <link rel="stylesheet" href="style/acceuil.css" >
    <link href="style/script.css" rel="stylesheet">
</head>
<body> 
    <?php require_once(dirname(__FILE__) .'/entete.php');?>
    <main class="mt-4">
        <p>Gerer les entreprises</p>
        <section class="container">
            <div class="box">
                <p><a href="crea_ent.php">Crée une entreprise</a></p>
            </div>
            <div class="box">
                <p><a href="modif_ent.php">Modifier une entreprise</a></p>
            </div>
            <div class="box">
                <p><a href="del_ent.php">Supprimer une entreprise</a></p>
            </div>
        </section>
    </main>

</body>
</html>