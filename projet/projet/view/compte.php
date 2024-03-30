<?php require_once(dirname(__FILE__) .'/../controller/redirection.php');?>  

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="acceuil page cte">
    <meta name="theme-color" content="#567BB2">
    <title>Acceuil</title>
    <link href="style/compte.css" rel="stylesheet">
</head>
<body>   
     
    <?php require_once(dirname(__FILE__) .'/entete.php');?>
    <main>
        <section class="flex flex-row">
        <section id="menu" class="hidden bg-custom-green lg:flex flex-col justify-center item-center text-white w-80 h-full  py-10 px-4" title="Espace gestion compte">
            <img src="src/croix.png" id="croix" class=" lg:hidden w-10 h-10 flex justify-items-end item-center " fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <img src="src/user.png">
            <p class="text-lg text text-center mb-4"><?php echo $_SESSION['user']['Nom'] . " " . $_SESSION['user']['Prénom'] ?></p>
            <section title="Suivi" class=" text-left">
                <p class="mx-4 text-2xl underline">Suivi</p>
                <ul class="mx-10 text-left">
                    <li class=" text-lg bg-blue-700 bg-opacity-50 rounded-md px-10" id="cv">Cv et lettre de motivation</li>
                    <li class=" text-lg" id="candidatures">Mes candidatures</li>
                    <li class=" text-lg" id="Calendrier">Calendrier</li>
                    <li class=" text-lg" id="favori">Favori</li>
                    <li class=" text-lg" id="modele">Modèles</li>
                </ul>
            </section>
            <section title="Partage" class=" text-left">
                <p class="mx-4 text-2xl underline">Partage</p>
                <ul class="mx-10 text-left">    
                    <li class=" text-lg" id="Evenement">Evenement</li>
                    
                </ul>
            </section>
        </section>
        <img src="src/burger.png" id="hamburger" class="lg:hidden w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
    
    <section title="affichage">
        <section id="cv_affichage" class="flex flex-col justify-center items-center mx-auto">
            <button class="text-white text-lg bg-blue-900 rounded-md w-24 h-10 mt-4 mb-4">Televerser</button>
            <img src="src/cv.png" class="mx-10 my-10">
        </section>
        
        <section id="candidatures_affichage" class="hidden">
            <section class="text-white text-lg bg-blue-900 px-10 py-4  rounded-md ml-4 mt-4 mb-4 flex flex-col justify-center item-center mx-auto">
                <!--Rajouter image-->
                <p> candidature à l'entreprise: {$nom}</p>
                <p>Date</p>
                <p>Objet d'etude:</p>
            </section>
        </section>
        
        <section id="calendrier_affichage" class="hidden">
            <div class="flex flex-row justify-between item-center mx-auto px-4 py-8">
                <div class="text-center mb-4">
                  <h1 class="text-2xl font-bold">Calendrier</h1>
                  <div id="currentMonth" class="text-xl font-semibold"></div>
                </div>
                <div class="grid grid-cols-7 gap-2">
                  <div class="text-center bg-gray-200 p-2 rounded-md font-semibold">Dim</div>
                  <div class="text-center bg-gray-200 p-2 rounded-md font-semibold">Lun</div>
                  <div class="text-center bg-gray-200 p-2 rounded-md font-semibold">Mar</div>
                  <div class="text-center bg-gray-200 p-2 rounded-md font-semibold">Mer</div>
                  <div class="text-center bg-gray-200 p-2 rounded-md font-semibold">Jeu</div>
                  <div class="text-center bg-gray-200 p-2 rounded-md font-semibold">Ven</div>
                  <div class="text-center bg-gray-200 p-2 rounded-md font-semibold">Sam</div>
                </div>
                <div id="calendar" class="grid grid-cols-7 gap-2 mt-4"></div>
              </div>
        </section>
        
        <section id="Favori_affichage" class="hidden mx-10 flex flex-col justify-center item-center">
            <p class="text-2xl text-blue-900 ">Offre favorite:</p>
            <section class="text-white text-lg bg-blue-900 px-10 py-4  rounded-md ml-4 mt-4 mb-4  mx-auto w-full">
                <!--Rajouter image-->
                <p>  {$nom}</p>
                <p>Date</p>
                <p>Diplome</p>
                <p>Contenu:</p>
            </section>
        </section>
        
        <section id="modele_affichage" class="hidden mx-10 my-10 border-2 ">
            <img src="src/modele.png">
        </section>
        <section id="event_affichage" class="hidden">
            <p class="flex justify-center items-center mx-10 text-xl">Rencontrez nous au prochain event:</p>
        </section>
        
    </section>
    </section>
    </main>
    <footer class="bg-blue-900 text-white flex flex-col sm:flex-row justify-between items-center px-10 py-8 mt-6">
        <section class="mt-4 sm:mt-0">
            <p>Nous contacter par mail:</p>
            <p><span class="move"><a href="mailto:hugo.lefebvre1@viacesi.fr">hugo.lefebvre1@viacesi.fr</a></span></p>
            <p>Nous contacter par téléphone:</p>
            <p><span class="move"><a href="tel:0637132323">06 37 13 23 23</a></span></p>
        </section>

        <section class="mt-4 sm:mt-0">
            <p><a href="cgu.html">Nos Conditions D'utilisation</a></p>
            <p><a href="mention.html">Nos mentions légale d'utilisation</a></p>
        </section>
        
    </footer>
    <script src="script/compte.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
</body>
</html>