<?php 
    require_once(dirname(__FILE__) .'/../controller/controller.php');
    redirection();
?>  
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="acceuil page cte">
    <meta name="theme-color" content="#567BB2">
    <title>Acceuil</title>
    <link href="style/acceuil.css" rel="stylesheet">
</head>
<body> 
    <?php require_once(dirname(__FILE__) .'/entete.php');?>
    <main >
        <header>
            <section class="z-10   max-w-screen mx-auto">
                <img src="src/datacenter.jpg" alt="image promo" class="w-full h-80 lg:h-auto lg:max-h-96 bg-opacity-50">
            </section>
        </header>
        <p class="text-3xl mx-10 my-2 font-bold">Trouve ton offre?</p>
        <p class="text-2xl mx-9  font-bold ">Simple utilise CTE</p>
        <section class="flex flex-col md:flex-row mx-7 md:mx-10 my-2 w-10/12 lg:grid lg:grid-cols-2 gap-4 mx-auto lg:mx-10 mt-5 lg:mt-10">            <div class="w-full md:max-w-auto lg:w-100 bg-blue-700 rounded-md mb-4 lg:mb-0">
                <img src="src/reu.jpeg" alt="reunion image" class="w-full items-center h-auto lg:w-90 lg:h-auto rounded-md">
            </div>
            <div class="items-center md:mx-10 lg:mx-30  lg:my-15 text-center md:text-left md:mx-auto lg:mx-auto lg:text-left">
                <p class="text-xl font-bold">Gerer vos Rendez-vous</p>
                <h5 class="w-79 h-40 text-center lg:text-left md:w-60 md:h-28">Simple, utiliser notre outil de gestion regroupant un calendrier et un module permettant de voir vos disponibilité directement</h5>
                <button id="dispo" class="bg-blue-700 text-white h-10 w-40 rounded-md hover:bg-custom-blue">Voir vos disponibilité</button>
            </div>            
        </section>
        <section class="flex flex-col-reverse md:ml-28 lg:ml-40 w-10/12 md:flex-row mx-7 my-20  lg:grid lg:grid-cols-2 gap-4 mx-auto lg:mx-0">            <div class="items-center md:mx-10 lg:mx-30 my-10 lg:my-15 text-center md:text-left md:mx-auto lg:mx-auto lg:text-left">
                <p class="text-lg lg:text-xl font-bold ">Des offres faites pour vous</p>
                <p class="w-79 h-40 text-center lg:text-left md:w-60 md:h-40">Nos offres sont detaillés avec des informations tel que la disponibilites, l’accesibilitées et encore, plein d’autres informations. Cliquez en dessous pour découvrir ses offres !  </p>
                <button id="decouvrir" class="bg-blue-700 mx-10 lg:mx-0 text-white h-10 w-40 rounded-md hover:bg-custom-blue">Découvrir les offres</button>
            </div>  
            <div class="w-full md:max-w-auto lg:w-100 bg-blue-700 rounded-md mb-4 lg:mb-0">
                <img src="src/recherche.jpg" alt="reunion image" class="w-full justify-center h-auto lg:w-90 lg:h-auto rounded-md">
            </div>
        </section>
        <section class="mx-10" title="Conseil préparation">
            <section>
                <p class="text-xl font-bold">Préparez vous!</p>
                <p class="text-lg">Soyez prêt à être répondre aux offres !</p>
            </section>
            <section class="my-10 hidden  md:flex justify-center items-center grid-cols-3 gap-x-0">
                <p class="bg-teal-500 text-xl mx-10 w-48 lg:w-60 h-60 text-center grid justify-center items-center text-white rounded-md">Mettez vos CV sur notre site</p>
                <p class="bg-cyan-700 text-xl mx-10 w-52 lg:w-60 h-60 text-center  grid justify-center items-center text-white rounded-md ">Nos offres en ce moment</p>
                <p class="bg-indigo-800 text-xl mx-10 w-52 lg:w-60 h-60 text-center grid justify-center items-center text-white rounded-md">Plateforme numéro 1 du marché</p>
            </section>
            <section class="my-10  flex md:hidden overflow-x-auto w-full max-w-screen-xl">
                <div class="box bg-teal-500 text-xl w-48 h-60 grid justify-center items-center text-center text-white rounded-md mr-4 flex-none">Mettez vos CV sur notre site</div>
                <div class="box bg-cyan-700 text-xl w-48 h-60 grid justify-center items-center text-center text-white rounded-md mx-auto flex-none">Nos offres en ce moment</div>
                <div class="box bg-indigo-800 text-xl w-48 h-60 grid justify-center items-center text-center text-white rounded-md ml-4 flex-none">Plateforme numéro 1 du marché</div>
            </section>

        </section>
        <section class="mx-10" title="actualité">
            <p class="text-xl font-bold"> Notre actualité : </p>
            <section class="hidden lg:flex flex-row items-center justify-center gap-x-1">
                <!-- faire des sections et afficher texte uniquement si hover -->
                <img src="src/usine.webp" class="w-52 h-96 object-cover  scale-100 hover:scale-125 hover:z-50  hover:w-80 hover:brightness-50 shadow-2xl shadow-cyan-500/50" alt="actu">
                <img src="src/usine.webp" class="w-52 h-96 object-cover scale-100 hover:scale-125 hover:z-50 hover:w-80 hover:brightness-50 shadow-2xl shadow-blue-500/50" alt="actu">
                <img src="src/usine.webp" class="w-52 h-96 object-cover  scale-100 hover:scale-125 hover:z-50 hover:w-80 hover:brightness-50 shadow-2xl shadow-indigo-500/50" alt="actu">
                <img src="src/usine.webp" class="w-52 h-96  object-cover  scale-100 hover:scale-125 hover:z-50 hover:w-80 hover:brightness-50 shadow-2xl shadow-blue-800/50" alt="actu">
            </section>
            <section class="my-10  flex lg:hidden overflow-x-auto w-full max-w-screen-xl">
                <img src="src/usine.webp" class="w-52 h-96 object-cover  scale-100  shadow-2xl mr-4 shadow-cyan-500/50" alt="actu">
                <img src="src/usine.webp" class="w-52 h-96 object-cover scale-100  shadow-2xl mr-4 shadow-blue-500/50" alt="actu">
                <img src="src/usine.webp" class="w-52 h-96 object-cover  scale-100  shadow-2xl mx-auto shadow-indigo-500/50" alt="actu">
                <img src="src/usine.webp" class="w-52 h-96  object-cover  scale-100  shadow-2xl ml-4 shadow-blue-800/50" alt="actu">
            </section>
        </section>

        <p class="text-xl font-bold bg-white  align-top text-left mx-10 my-2 lg:my-10 ">Notre newsletter :</p>
        <section class=" grid justify-center items-center mx-10 " title="newsletter">
            <section class="bg-blue-900 flex  w-72 h-60 justify-center items-center rounded-md mt-6 flex-col">
                <p class="text-white text-xl text-center mb-4">Abonnez-vous à notre newsletter</p>
                <input type="text" class="rounded-md w-60 h-12 mb-4"  aria-label="Search">
                <button class="bg-blue-500 text-white w-60 h-12 hover:bg-cyan-700">Enregistrer</button>
            </section>
        </section>
        
    </main>
    <?php require_once(dirname(__FILE__) .'/footer.php');?>
</body>
<script src="script/index_script.js"></script>
</html>
