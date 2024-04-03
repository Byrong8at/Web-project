<?php
require_once(dirname(__FILE__) .'/../controller/controller.php');
adminredirection();
?>

<!DOCTYPE html>
<html lang="Fr">
<head>
    <meta charset="UTF-8">
    <link rel="manifest" href="manifest.json">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="stage">
    <meta name="theme-color" content="#567BB2">
    <title>Gerer stage</title>
    <link href="style/compte.css" rel="stylesheet">
    
</head>
<body>
    <?php require_once(dirname(__FILE__) .'/entete.php');?>
        <div class="flex justify-center items-center my-10" title="recherche">
            <div class="flex flex-col items-center">
                <input type="text" id="search" data-searchtype="candidature" placeholder="Rechercher..." class="w-64 border-2 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" onkeyup="searchData(this.value)">
                <div id="result" class="mt-4"></div>
            </div>
        </div>

    <main>

        <section title="affichage" class="flex flex-col justify-center items-center text-white px-10 py-10 my-10">
            <div id="candi" class="mt-4 grid grid-cols-5 gap-4"></div>
                    
        <section>    
    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="script/postuler.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</body>
</html>