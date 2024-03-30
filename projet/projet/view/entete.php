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
            <input type="text" class="w-full sm:w-48 md:w-200 lg:w-80 xl:w-200 h-10 px-4 rounded-full border border-gray-300 text-black" placeholder="Search">
        </div>
        <a href="deconnexion.php">Se déconnecter</a>
        <p class="hidden sm:inline ml-4">Nos offres</p>
        <a href="compte.php"><img src="../logo/<?php echo $_SESSION['user']['logo']; ?>" alt="profile picture" class="w-10 h-auto"><?php echo " " . $_SESSION['user']['Nom']; ?></a>
    <?php else: ?>
        <a href="index.php">
            <img src="src/logo.png" alt="logo du site" class="w-24 h-auto mr-0">
        </a>
        <button id="connexion" class=" border-2 rounded-md border-gray-300 ml-auto mr-5 px-2 hover:bg-white hover:border-0 hover:text-black text-lg" onclick="window.location.href='connexion.php';">Connexion</button>&nbsp;&nbsp;  
    <?php endif; ?>
</header>
