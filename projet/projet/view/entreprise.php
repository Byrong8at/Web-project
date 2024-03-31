<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content=" page entreprise ">
    <meta name="theme-color" content="#567BB2">
    <title>Acceuil</title>
    <link href="style/entreprise.css" rel="stylesheet">
</head>
<body>
    <?php
    require_once(dirname(__FILE__) .'/../controller/controller.php');
    redirection();
    ?>   
    <?php require_once(dirname(__FILE__) .'/entete.php');?>
    <main>
        <header>
            <section class="relative max-w-screen mx-auto ">
                <img src="src/capgemini.jpg" alt="image promo" class=" w-full h-100 lg:h-auto lg:max-h-96 bg-opacity-50">
                <span class="absolute bottom-20 left-20 text-white text-3xl  text-shadow-[0_4px_8px_#6366f1] p-2 underline "><?php echo $_GET['ID_entreprise'];?></span>
            </section>
        </header>
        <main class="mx-10 my-10">
            <section title="presentation ">
                <section class="my-2" title="description entreprise" >
                    <p class="text-xl font-bold">Presentation de l'entreprise : </p>
                    <p>Capgemini est un leader mondial dans les services de conseil, de technologie et de transformation numérique, avec plus de 300 000 collaborateurs dans plus de 50 pays. Notre mission est d'accompagner nos clients dans leur transformation numérique en leur offrant des solutions innovantes et sur mesure. Nous proposons des services de conseil en stratégie et transformation, des services technologiques et des solutions numériques. Chez Capgemini, nous croyons en l'intégrité, l'innovation, la collaboration et la responsabilité sociale. Bienvenue chez Capgemini, où l'avenir est entre vos mains.</p>
                </section>
            </section> 
            <section title="offre en cours " class="text-white">
                <p class="text-xl font-bold text-black">Les offres en cours :</p>
                <section class="flex overflow-x-auto  w-full max-w-screen-3xl my-2">
                    
                        <section title="offre de stage" class="text-left bg-custom-blue-sky px-4 w-64 h-80 lg:mx-10 mr-4 lg:mr-0 flex-none ">
                            <p>Nom du stage</p>
                            <p>Date</p>
                            <p>Type de Contrat</p>
                            <p>Mission:</p>
                        </section>
                
                        <section title="offre de stage" class="text-left bg-custom-blue-sky px-4 w-64 h-80 lg:mx-10 text-white mr-4 lg:mr-0 flex-none">
                            <p>Nom du stage</p>
                            <p>Date</p>
                            <p>Type de Contrat</p>
                            <p>Mission:</p>
                        </section>
                        <section title="offre de stage" class="text-left bg-custom-blue-sky px-4 w-64 h-80 lg:mx-10 mr-4 lg:mr-0 flex-none ">
                            <p>Nom du stage</p>
                            <p>Date</p>
                            <p>Type de Contrat</p>
                            <p>Mission:</p>
                        </section>
                
                        <section title="offre de stage" class="text-left bg-custom-blue-sky px-4 w-64 h-80 lg:mx-10 text-white mr-4 lg:mr-0 flex-none">
                            <p>Nom du stage</p>
                            <p>Date</p>
                            <p>Type de Contrat</p>
                            <p>Mission:</p>
                        </section>
                        <section title="offre de stage" class="text-left bg-custom-blue-sky px-4 w-64 h-80 lg:mx-10  mr-4 lg:mr-0 flex-none ">
                            <p>Nom du stage</p>
                            <p>Date</p>
                            <p>Type de Contrat</p>
                            <p>Mission:</p>
                        </section>
                
                        <section title="offre de stage" class="text-left bg-custom-blue-sky px-4 w-64 h-80 lg:mx-10 text-white mr-4 lg:mr-0 flex-none">
                            <p>Nom du stage</p>
                            <p>Date</p>
                            <p>Type de Contrat</p>
                            <p>Accessibilité</p>
                            <p>Mission:</p>
                        </section>
                        <section title="offre de stage" class="text-left bg-custom-blue-sky px-4 w-64 h-80 lg:mx-10 mr-4 lg:mr-0 flex-none">
                            <p>Nom du stage</p>
                            <p>Date</p>
                            <p>Type de Contrat</p>
                            <p>Accessibilité</p>
                            <p>Mission:</p>
                        </section>
                
                        <section title="offre de stage" class="text-left bg-custom-blue-sky px-4 w-64 h-80 lg:mx-10 text-white mr-auto lg:mr-0 flex-none">
                            <p>Nom du stage</p>
                            <p>Date</p>
                            <p>Type de Contrat</p>
                            <p>Accessibilité</p>
                            <p>Mission:</p>
                        </section>
                        
                        
                        <!-- Ajoutez plus de sections au besoin -->

                </section>
                <button id="see-offre" class="flex justify-center items-center rounded-md text-lg bg-custom-blue-sky hover:bg-cyan-900 w-40 my-2 px-4 py-2 text-white mx-auto">Voir plus</button>
            </section>
            
        </main>
        <footer>
            <section class="my-10 mx-10" title="Avis">
                <p class="text-xl font-bold">Avis sur l'entreprise</p>
                <!-- Rendre les étoiles à jour tout seul-->
                <section class="flex items-center justify-center">
                    <span class=" text-3xl">&#9733;&#9733;&#9733;&#9734;&#9734;</span>
                    <span class="text-gray-600 ml-1">3.0 (30 avis)</span>
                </section>
                <section class="flex justify-between items-center my-2" title="choice">
                    <p>Les plus récents</p>
                    <p>Les plus positif</p>
                    <p>Les plus négatif</p>
                </section>
                <section class="flex flex-col justify-center items-center gap-y-2 my-2" title="avis trouvé">
                    <div class="bg-custom-purple text-white rounded-md w-72 md:w-4/5 h-36">
                        <span class="flex justify-between mx-1 md:mx-5">
                            <p>Nom de l'élève</p>
                            <p>Note/5</p>
                        </span>
                        <p class="mx-1 md:mx-5">Date de l'emploi</p>
                        <p class="mx-1 md:mx-5">Commentaire :</p>
                    </div>
                    <div class="bg-custom-purple text-white rounded-md w-72 md:w-4/5 h-36">
                        <span class="flex justify-between mx-1 md:mx-5">
                            <p>Nom de l'élève</p>
                            <p>Note/5</p>
                        </span>
                        <p class="mx-1 md:mx-5">Date de l'emploi</p>
                        <p class="mx-1 md:mx-5">Commentaire :</p>
                    </div>
                    <div  class=" additional-items hidden bg-custom-purple text-white rounded-md w-72 md:w-4/5 h-36">
                        <span class="flex justify-between mx-1 md:mx-5">
                            <p>Nom de l'élève</p>
                            <p>Note/5</p>
                        </span>
                        <p class="mx-1 md:mx-5">Date de l'emploi</p>
                        <p class="mx-1 md:mx-5">Commentaire :</p>
                    </div>
                    <div  class=" additional-items hidden bg-custom-purple text-white rounded-md w-72 md:w-4/5 h-36">
                        <span class="flex justify-between mx-1 md:mx-5">
                            <p>Nom de l'élève</p>
                            <p>Note/5</p>
                        </span>
                        <p class="mx-1 md:mx-5">Date de l'emploi</p>
                        <p class="mx-1 md:mx-5">Commentaire :</p>
                    </div>
                    
                    <button id="btn-plus" class="bg-custom-green hover:bg-cu text-white font-bold py-2 px-4 rounded mt-4">+</button>
                </section>
                
            </section>
        </footer>
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
    <script src="script/entreprise.js"></script>
</body>
</html>