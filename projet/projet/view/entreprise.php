<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content=" page entreprise ">
    <meta name="theme-color" content="#567BB2">
    <title>Acceuil</title>
    <link rel="manifest" href="manifest.json">
    <link href="style/entreprise.css" rel="stylesheet">
</head>
<body>
    <?php
    require_once(dirname(__FILE__) .'/../controller/controller.php');
    redirection();
    $data = get_all($_GET['ID_entreprise'],"entreprise");
    $avis = get_avis($_GET['ID_entreprise']);
    $moyenne = get_avisMoyenne($_GET['ID_entreprise']);
    $entreprise_offres = get_entrepriseOffres($_GET['ID_entreprise']);
    ?>   
    <?php require_once(dirname(__FILE__) .'/entete.php');?>
    <main>
        <header>
            <section class="max-w-screen mx-auto ">
                <img src="<?php echo $data[0]['logo']; ?>" alt="image promo" class=" w-full h-100 lg:h-auto lg:max-h-96 bg-opacity-50">
            </section>
        </header>
        <main class="mx-10 my-10">
            <span class="text-3xl  text-shadow-[0_4px_8px_#6366f1] py-2 underline "><?php echo $data[0]['Nom'];?></span>
            <section title="presentation ">
                <section class="my-2" title="description entreprise" >
                    <p class="text-xl font-bold">Presentation de l'entreprise : </p>
                    <p>Capgemini est un leader mondial dans les services de conseil, de technologie et de transformation numérique, avec plus de 300 000 collaborateurs dans plus de 50 pays. Notre mission est d'accompagner nos clients dans leur transformation numérique en leur offrant des solutions innovantes et sur mesure. Nous proposons des services de conseil en stratégie et transformation, des services technologiques et des solutions numériques. Chez Capgemini, nous croyons en l'intégrité, l'innovation, la collaboration et la responsabilité sociale. Bienvenue chez Capgemini, où l'avenir est entre vos mains.</p>
                </section>
            </section> 
            <section title="offre en cours " class="text-white">
                <p class="text-xl font-bold text-black">Les offres en cours :</p>
                <section class="flex overflow-x-auto  w-full max-w-screen-3xl my-2">

                <?php
                foreach ($entreprise_offres as $offre) {
                    $nom_offre = $offre['Nom'];
                    $date = $offre['date_de_l_offre'];
                    $description_offre = $offre['detail'];
                    $idoffre = $offre['ID_offre'];
                ?>
                <a href="offre.php?ID_offre=<?php echo $idoffre?>" alt="<?php echo $nom_offre?>"> <section title="offre de stage" class="text-left bg-custom-blue-sky px-4 w-64 h-80 lg:mx-10 mr-4 lg:mr-0 flex-none ">
                            <p><?php echo $nom_offre?></p>
                            <p>Date : <?php echo $date?></p>
                            <p>Mission :</br><?php echo $description_offre?></p>
                        </section></a>
                <?php } ?>
                    

                </section>
                <button id="see-offre" class="flex justify-center items-center rounded-md text-lg bg-custom-blue-sky hover:bg-cyan-900 w-40 my-2 px-4 py-2 text-white mx-auto">Voir plus</button>
            </section>
            
        </main>
        <section class="my-10 mx-10" title="Avis">
                <p class="text-xl font-bold">Avis sur l'entreprise :</p>
                <section class="flex items-center justify-center">
                    <?php aff_avisMoyenne($moyenne);?>
                </section>
                <section class="flex flex-col justify-center items-center gap-y-2 my-2" title="avis trouvé">
                    <?php aff_avis($avis);?>

                    <button id="btn-plus" class="bg-custom-green hover:bg-cu text-white font-bold py-2 px-4 rounded mt-4">+</button>
                </section>
                
        </section>

        <section class="my-10 mx-10" title="Statistique">
            <p class="text-xl font-bold">Statistiques de l'entreprise :</p>
            <p class="text-lg">Nombre de personnes ayant postuler aux offres de l'entreprise : <?php echo get_candidatureEntreprise($_GET['ID_entreprise'])[0]['nbrcandidature'];?> personne(s)</p>
            <p class="text-lg">Nombre de personnes ayant ajouter les offres de l'entreprise à leur wishlist : <?php echo get_wishlistEntreprise($_GET['ID_entreprise'])[0]['nbrwishlist'];?> personne(s)</p>
        </section>
    </main>
    <?php require_once(dirname(__FILE__) .'/footer.php')?>
    <script src="script/entreprise.js"></script>
</body>
</html>