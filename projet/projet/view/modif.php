<?php
require_once(dirname(__FILE__) .'/../controller/controller.php');
adminredirection();

$error_message = "";
$req = array();

if (!isset($_GET["Recherche"])) {
    $searchie=$_GET["Recherche"];
    $search = '%' . $searchie . '%';
    $req = $conn->query("SELECT * FROM utilisateur WHERE Nom LIKE '$search' LIMIT 5");
    $req = $req->fetchALL();
}

if (isset($_POST['envoi'])) {
    $statut = $_POST['statut'];
    $nom= $_POST['nom'];
    $prenom=$_POST['prenom'];
    $Centre= $_POST['Centre'];
    $promo=$_POST['promo'];
    $identifiant = $_POST['Login'];
    $mot_de_passe = $_POST['password'];
    
        try {
            if (creation($statut,$nom,$prenom,$Centre,$promo,$identifiant, $mot_de_passe, $conn)) {
                $error_message ='valider';
                
            } else {
                $error_message = "Une erreur à eu lieu";
            }
        } catch (PDOException $e) {
            $error_message = "Échec de la connexion à la base de données : " . $e->getMessage();
        }
    }
function creation($statut,$nom,$prenom,$Centre,$promo,$identifiant, $mot_de_passe, $conn){
    try {
        $sqllog = "UPDATE utilisateur SET statut = :statut, Nom = :nom, Prénom = :prenom, Centre = :Centre, Login = :identifiant, Mot_de_passe = :mot_de_passe WHERE ID_user = :identifiant";
        $quezy = $conn->prepare($sqllog);
        $quezy->bindParam(':statut', $statut);
        $quezy->bindParam(':nom', $nom);
        $quezy->bindParam(':prenom', $prenom);
        $quezy->bindParam(':Centre', $Centre);
        $quezy->bindParam(':identifiant', $identifiant);
        $quezy->bindParam(':mot_de_passe', $mot_de_passe);
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
    <title>Modification utilisateur</title>
</head>
<body>
    <?php require_once(dirname(__FILE__) .'/entete.php');?>
    
    <main>
        <header class="flex justify-center items-center text-black text-4xl my-10 font-bold">
            <p>Modification d'un compte</p>        
        </header>
        <section class="form-group">
            <input type="text" id="Recherche" name="Recherche" placeholder="Recherche">
            <?php
                foreach ($req as $r) {
                    ?>
                    <div class="r mx-10 my-10 bg-white hover:bg-blue-900" data-nom="<?= $r['Nom'] ?>" data-prenom="<?= $r['Prénom'] ?>">
                        <?= $r['Nom'] . " " . $r['Prénom'] ?>
                    </div>
                    <?php
                }
                ?>

        </section>
        
        <form method="post" class="flex flex-col md:flex-row justify-center items-center text-white">
            <section title="formulaire creation" class="flex flex-row justify-center items-center bg-custom-green px-10 py-10 my-10">
                <section class="flex flex-col justify-center items-center">
                    <img src="src/user.png" class="w-44">
                    <button class="bg-custom-purple text-white text-lg w-24 h-14 rounded-full">Modifier</button>
                </section>
                <section title="input" class="flex flex-col justify-center items-center ">
                    <legend class="text-right ">Statut</legend>
                    <select name="statut" class="w-96 mb-4 text-black">
                            <option value="1" name="Etudiant">Etudiant</option>
                            <option value="0" name="tuteur">Tuteur</option>
                    </select>
                    <div class="flex flex-row">
                        <legend class="flex-none">Nom</legend>
                        <input type="text" name="nom" id="nom" class="text-black">
                        <legend class="flex-none">Prenom</legend>
                        <input type="text" name="prenom" id="prenom" class="text-black">
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
            </section>
        </form>
    </main>
    <?php require_once(dirname(__FILE__) .'/footer.php');?>
    <script src="script/modif.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
</body>
</html>