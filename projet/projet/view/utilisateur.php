<?php require_once(dirname(__FILE__) .'/../controller/controller.php');
redirection();
if (!isset($_GET['ID_utilisateur'])){
    header('acceuil.php');
}
$data_utilisateur = get_all($_GET['ID_utilisateur'],'utilisateur');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="manifest" href="manifest.json">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Modification">
    <meta name="theme-color" content="#567BB2">
    <link rel="stylesheet" href="style/user_cre.css">
    <link rel="stylesheet" href="style/user.css">

    <title></title>
</head>
<body>
    <?php require_once(dirname(__FILE__) .'/entete.php')?>
    <main>
        <div class="user-card">
            <img src="image-url" alt="User image">
            <div class="user-info">
                <h2>Nom : <?php echo $data_utilisateur[0]['Nom'];?></h2>
                <h2>Prénom : <?php echo $data_utilisateur[0]['Prénom'];?></h2>
                <h2>Centre : <?php echo $data_utilisateur[0]['Centre'];?></h2>
                <h2>Statut :
                    <?php
                        if($data_utilisateur[0]['Statut'] == 1){
                            echo 'Élève';
                        }else{
                            echo 'Tuteur';
                        };
                    ?>
                </h2>
            </div>
        </div>
    </main>


    <?php require_once(dirname(__FILE__) .'/footer.php')?>
</body>
</html>