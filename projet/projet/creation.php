<?php
require_once(dirname(__FILE__) .'/bdd.php');
require_once(dirname(__FILE__) .'/tele.php');
session_start();

$error_message = "";

if (isset($_POST['envoi'])) {
        //rajouter empty
        $statut = $_POST['statut'];
        $nom= $_POST['nom'];
        $prenom=$_POST['prenom'];
        $Centre= $_POST['Centre'];
        $promo=$_POST['promo'];
        $identifiant = $_POST['Login'];
        $mot_de_passe = $_POST['password'];
        $img = 'src/profil/' . basename($identifiant) . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        traitement( $img);

        try {
            if (creation($statut,$nom,$prenom,$Centre,$promo,$identifiant, $mot_de_passe,$img, $conn)) {
                $error_message ='valider';
                
            } else {
                $error_message = "Une erreur à eu lieu";
            }
        } catch (PDOException $e) {
            $error_message = "Échec de la connexion à la base de données : " . $e->getMessage();
        }
    }


function creation($statut,$nom,$prenom,$Centre,$promo,$identifiant, $mot_de_passe,$img, $conn){
    try {
        $sqllog = "INSERT INTO utilisateur(statut, Nom, Prénom, Centre, Login, Mot_de_passe,logo) VALUES (:statut, :nom, :prenom, :Centre, :identifiant, :mot_de_passe, :logo)";
        $quezy = $conn->prepare($sqllog);
        $quezy->bindParam(':statut', $statut);
        $quezy->bindParam(':nom', $nom);
        $quezy->bindParam(':prenom', $prenom);
        $quezy->bindParam(':Centre', $Centre);
        $quezy->bindParam(':identifiant', $identifiant);
        $quezy->bindParam(':mot_de_passe', $mot_de_passe);
        $quezy->bindParam(':logo', $img);
        $quezy->execute();
        $sql = "INSERT INTO integrer (ID_user, Id_Promo)
            VALUES (
                (SELECT ID_user FROM utilisateur WHERE Login = :identifiant LIMIT 1),
                (SELECT Id_Promo FROM promotion WHERE Id_Promo = :promo LIMIT 1)
            )";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':identifiant', $identifiant);
        $stmt->bindParam(':promo', $promo);

        
        $stmt->execute();

        return true;
    } catch (PDOException $e) {
        echo "Échec de la requête : " . $e->getMessage();
        return false;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Modification">
    <meta name="theme-color" content="#567BB2">
    <link rel="stylesheet" href="style/user_cre.css">
    <title>Creation utilisateur</title>
</head>
<body>
    <header class="bg-blue-900 text-white flex justify-between items-center  py-2 ">
                <a href="acceuil.html">
                <img src="src/logo.png" alt="logo du site" class="w-24 h-auto mr-0" ></a>
                <div class="flex items-center space-x-4 flex-grow"> 
                    <input type="text" class="w-full sm:w-48 md:w-200 lg:w-80 xl:w-200 h-10 px-4 rounded-full border border-gray-300 text-black" placeholder="Search">
                </div>
                <p class="hidden sm:inline ml-4">Nos offres </p> 
                <!-- faire que si on clique dessus un menu déroulant s'affiche en dessous -->
                &nbsp;&nbsp;&nbsp;&nbsp;<img src="src/user.svg" alt="profile picture" class="w-10 h-auto">&nbsp;&nbsp;  
        </header>
    
    <main>
        <header class="flex justify-center items-center text-black text-4xl my-10 font-bold">
            <p>Creation d'un compte</p>
            
        </header>
        <?php
            echo '<p name="error-message" style="color: red;">' . $error_message . '</p>';
        ?>
        <form method="post" enctype="multipart/form-data" class="flex flex-col md:flex-row justify-center items-center text-white">
            <section title="formulaire creation" class="flex flex-row justify-center items-center bg-custom-green px-10 py-10 my-10">
                <section class="flex flex-col justify-center items-center">
                    <img src="src/user.png" class="w-44" alt="image user">
                    <input type="file" name="image" class="bg-custom-purple text-white text-lg w-24 h-14 rounded-full" accept="image/*" text="Parcourir">

                </section>
                <section title="input" class="flex flex-col justify-center items-center ">
                    <legend class="text-right ">Statut</legend>
                    <select name="statut" class="w-96 mb-4 text-black">
                            <option value="1" name="Etudiant">Etudiant</option>
                            <option value="0" name="tuteur">Tuteur</option>
                    </select>
                    <div class="flex flex-row">
                        <legend class="flex-none">Nom</legend>
                        <input type="text" name="nom" class="text-black">
                        <legend class="flex-none">Prenom</legend>
                        <input type="text" name="prenom" class="text-black">
                    </div>
                    
                    <legend>Centre</legend>
                    <input type="text" name="Centre" class="text-black">
                    <p>Promotion</p>
                    <select name="promo" class="text-black bg-white">
                            <option  value="1">X1_i1</option>
                            <option value="2">X1_i2</option>
                            <option  value="3">X1_i3</option>
                            <option  value="4">X1_i4</option>
                            <option  value="5">X1_i5</option>
                    </select>
                    <p>Login</p>
                    <input type="text" name="Login" class="text-black">
                    <p>Mot de passe</p>
                    <input type="password" name="password" class="text-black">
                </section>
            </section>
            <section title="button part" >
                <button type="submit" name="envoi" class=" finish bg-blue-800 text-white text-lg rounded-full w-32 h-14 mx-10 hover:bg-blue-900">Valider</button>
                <button class="reinitialiser bg-red-700 text-white text-lg rounded-full px-6 h-14 hover:bg-red-900" onclick="restart()">Reinitialiser</button>
            </section>
        </form>
    </main>
    
    <script src="script/creation.js"></script>
</body>
</html>