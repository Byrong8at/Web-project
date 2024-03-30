<?php require_once(dirname(__FILE__) .'/../controller/redirection.php')?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Modification">
    <meta name="theme-color" content="#567BB2">
    <link rel="stylesheet" href="style/user_cre.css">
    <title>Offre</title>
</head>
<body>
    <?php require_once(dirname(__FILE__) .'/entete.php')?>
    <main>
        <section class="w-full h-50vh relative">
            <img src="src/ibm.jpeg" class="w-full h-96">
            <div class="flex flex-col justify-center absolute top-0 left-0 right-0 bottom-0">
                <h1 class="text-2xl md:text-3xl lg:text-4xl text-white px-8 py-2 font-size: 3vmin">Nom entreprise</h1>
            </div>
        </section>
        <h2 class="text-2xl mx-4 py-4 md:text-3xl lg:text-4xl">Nom de l'offre</h2>
        <h2 class="text-2xl mx-4 py-4 md:text-3xl lg:text-4xl">Ajouté le </h2>
        <h2 class="text-2xl mx-4 py-4 md:text-3xl lg:text-4xl">Compétences requis</h2>
        <h2 class="text-2xl mx-4 py-4 md:text-3xl lg:text-4xl">Durée</h2>
        <h2 class="text-2xl mx-4 py-4 md:text-3xl lg:text-4xl">nbr de place</h2>
        <h2 class="text-2xl mx-4 py-4 md:text-3xl lg:text-4xl">teletravail</h2>
        <h2 class="text-2xl mx-4 py-4 md:text-3xl lg:text-4xl">Description</h2>
    </main>

    <?php require_once(dirname(__FILE__) .'/footer.php')?>
</body>
</html>