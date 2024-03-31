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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Modification">
    <meta name="theme-color" content="#567BB2">
    <link rel="stylesheet" href="style/user_cre.css">
    <title></title>
</head>
<body>
    <?php require_once(dirname(__FILE__) .'/entete.php')?>
    <main>
        <img alt="Photo de profile" src="<?php echo $data_utilisateur[0]['logo']?>">
        <h2 class="text-2xl mx-4 py-4 md:text-3xl lg:text-4xl">Nom : <?php echo $data_utilisateur[0]['Nom'];?></h2>
        <h2 class="text-2xl mx-4 py-4 md:text-3xl lg:text-4xl">Prénom : <?php echo $data_utilisateur[0]['Prénom'];?></h2>
        <h2 class="text-2xl mx-4 py-4 md:text-3xl lg:text-4xl">Centre : <?php echo $data_utilisateur[0]['Centre'];?></h2>
        <h2 class="text-2xl mx-4 py-4 md:text-3xl lg:text-4xl">Statut :
            <?php 
                if($data_utilisateur[0]['Statut'] == 1){
                    echo 'Élève';
                }else{
                    echo 'Tuteur';
                };
            ?>
        </h2>
    </main>

    <?php require_once(dirname(__FILE__) .'/footer.php')?>
</body>
</html>