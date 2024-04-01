<?php 
    require_once(dirname(__FILE__) .'/../controller/controller.php');
    redirection();
?>  

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Page error">
    <meta name="theme-color" content="#567BB2">
    <title>Error</title>
    <link href="style/index.css" rel="stylesheet">
</head>
<body>   
    <?php require_once(dirname(__FILE__) .'/entete.php');?>
    
    <main >
        
        <section class="flex md:flex-col lg:flex-row justify-center items-center my-3 mx-5 md:my-10 md:mx-10 py-64 md:py-20 xl:py-40 bg-blue-800">            
            <img src="src/error.png" class="hidden md:flex mr-auto lg:w-100">
            <span class="flex flex-col justify-center items-center mr-auto ">
                <p class="text-4xl text-center text-white w-full py-2 mx-10 lg:mx-auto mb-auto xl:mx-10 ">On dirait que vous vous êtes perdue!</p>
                <button id="retour" class="bg-white hover:bg-custom-purple rounded-md text-lg w-64 h-12 mb-auto">retourner à la page d'accueil</button>
            </span>
        </section>
        

        
    </main>
    <?php require_once(dirname(__FILE__) .'/footer.php');?>
</body>
<script src="script/index.js"></script>
</html>
