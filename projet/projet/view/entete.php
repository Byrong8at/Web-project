
<header class="bg-blue-900 text-white flex justify-between items-center  py-2 ">
    <?php
        if (!isset($_SESSION)) {
            session_start();
        }
    ?>
    <?php if (isset($_SESSION['user'])): ?>
        <a href="acceuil.php">
            <img src="src/logo.png" alt="logo du site" class="w-24 h-auto mr-0">
        </a>
        <div class="flex items-center space-x-4 flex-grow">
        <div class=" z-50 relative ">
            <input type="text" id="search_entete" data-searchtype="all" class="w-full sm:w-48 md:w-200 lg:w-80 xl:w-200 h-10 px-4 rounded-full border border-gray-300 text-black" placeholder="Search" onkeyup="searchall(this.value)">
            <div id="resultat" class="  absolute w-full mt-4 text-black bg-white border border-gray-300 "></div>
        </div>


        </div>
        
        <a href="recherche.php" class="hidden sm:inline mr-4">Nos offres</a>
        
        <div class="relative mr-4">
            <?php if ($_SESSION['user']['logo']) { ?>
                <img id="logo" src="<?php echo $_SESSION['user']['logo']; ?>" alt="profile picture" class="w-10 h-16 rounded-full"></a>
                <?php }else{ ?>
                    <img id="logo" src="src/user.png" alt="profile picture" class="w-10 h-auto"></a>
            <?php } ?>
            <section id="profil" class="rtl:mr-3 hidden absolute top-0 start-0 mt-4 mx-36 w-48 bg-white border border-gray-300 text-black">
                <?php if ($_SESSION['user']['Statut'] == 0): ?>
                    <a href="User.php" class="block px-4 py-2 hover:bg-gray-300">Gérer utilisateur</a>
                    <a href="offre_gerer.php" class="block px-4 py-2 hover:bg-gray-300">Gérer Offre</a>
                    <a href="entreprise_gerer.php" class="block px-4 py-2 hover:bg-gray-300">Gérer Entreprise</a>
                    <a href="postuler.php" class="block px-4 py-2 hover:bg-gray-300">Gérer les Stages</a>
                    <a href="avis.php" class="block px-4 py-2 hover:bg-gray-300">Laissez un avis</a>
                    <a href="deconnexion.php" class="block px-4 py-2 hover:bg-gray-300">Se déconnecter</a>
                <?php elseif ($_SESSION['user']['Statut'] == 1): ?>
                    <a href="compte.php" class="block px-4 py-2 hover:bg-gray-300">Mon compte</a>
                    <a href="deconnexion.php" class="block px-4 py-2 hover:bg-gray-300">Se déconnecter</a>
                <?php endif; ?>
            </section>
        </div>
        <p class=" mr-4"><?php echo " " . $_SESSION['user']['Prénom']; ?></p>


        <?php else: ?>
        <a href="index.php">
            <img src="src/logo.png" alt="logo du site" class="w-24 h-auto mr-0">
        </a>
        <button id="connexion" class=" border-2 rounded-md border-gray-300 ml-auto mr-5 px-2 hover:bg-white hover:border-0 hover:text-black text-lg" onclick="window.location.href='connexion.php';">Connexion</button>&nbsp;&nbsp;  
    <?php endif; ?>
</header>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="script/script.js"></script>
