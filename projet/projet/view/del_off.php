<?php
require_once(dirname(__FILE__) .'/../controller/controller.php');
adminredirection();


$error_message = "";
$req = array();

if (isset($_POST['envoi'])) {
    if(!empty($_POST['nom'])AND !empty($_POST['description']) AND !empty($_POST['durée'])){
        $ent=$_POST['ent'];
        $offre=$_POST['id_user'];
        try {
            if (delete_off($offre, $conn)) {
                $error_message ='';
                
            } else {
                $error_message = "Une erreur à eu lieu";
            }
        } catch (PDOException $e) {
            $error_message = "Échec de la connexion à la base de données : " . $e->getMessage();
        }}
        else{
            $error_message="Veuillez completez les champs obligatoires";
        }
    }
function delete_off($offre, $conn){
    try {
        $del = "DELETE FROM candidature
                WHERE ID_offre=:id_offre";
        $stmt = $conn->prepare($del);
        $stmt->bindParam(':id_offre', $offre);
        $stmt->execute();

        $del = "DELETE FROM wishlist
                WHERE ID_offre=:id_offre";
        $stmt = $conn->prepare($del);
        $stmt->bindParam(':id_offre', $offre);
        $stmt->execute();

        $sqllog = "DELETE FROM offre  WHERE ID_offre = :id_offre";
        $quezy = $conn->prepare($sqllog);
        $quezy->bindParam(':id_offre', $offre);
        $quezy->execute();

        return true;
    } catch (PDOException $e) {
        echo "Échec de la requête : " . $e->getMessage();
        return false;
    }
}

function entreprise($conn){
    try {
        $sql = "SELECT * FROM entreprise";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Erreur ent" . $e->getMessage();
    }
}

$name_ent=entreprise($conn);
?>

<!DOCTYPE html>
<html lang="Fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Supprimer">
    <meta name="theme-color" content="#567BB2">
    <title>Supprimer offre</title>
    <link href="style/compte.css" rel="stylesheet">
    
</head>
<body>
    <?php require_once(dirname(__FILE__) .'/entete.php');?>
        <div class="flex justify-center items-center my-10" title="recherche">
            <div class="flex flex-col items-center">
                <input type="text" id="search" data-searchtype="offre" placeholder="Rechercher..." class="w-64 border-2 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" onkeyup="searchData(this.value)">
                <div id="result" class="mt-4"></div>
            </div>
        </div>

    <main>
    <form method="post" enctype="multipart/form-data" class="flex flex-col md:flex-row justify-center items-center text-white">
        <input type="hidden" name="id_user" id="id_user" value="">

        <section title="formulaire creation" class="flex flex-row justify-center items-center bg-custom-green px-10 py-10 my-10">
                <section title="input" class="flex flex-col justify-center items-center ">
                    <div class="flex flex-col">
                        <legend class="flex-none">Nom</legend>
                        <input type="text" id="nom" name="nom" class="text-black">
                    </div>
                        <legend class="flex-none">compétences</legend>
                        <input type="text" id="competences" name="competences" class="text-black">
                        <legend class="flex-none">Description (maximun 256 caractères)</legend>
                        <textarea name="description" id="description" class="text-black">
                            Veuillez décrire l'offre
                        </textarea>
                        <legend class="flex-none">Type de promo concerné</legend>
                        <select id="promo" name="promo" class="text-black bg-white">
                            <option  value="1">X1_i1</option>
                            <option value="2">X1_i2</option>
                            <option  value="3">X1_i3</option>
                            <option  value="4">X1_i4</option>
                            <option  value="5">X1_i5</option>
                        </select>
                    
                    
                    <legend>Durée du stage(en semaine)</legend>
                    <input type="text"id="durée" name="durée" class="text-black" >
                    <legend>Salaire</legend>
                    <input type="text" id="salaire" name="salaire" class="text-black">
                    <legend>Date de l'offre</legend>
                    <input type="text" id="date" name="date" class="text-black">
                    <legend>Nombre de places :</legend>
                    <select id="place" name="place" class="text-black">
                        <option value="0" class="text-black" >0</option>
                        <option value="1" class="text-black">1</option>
                        <option value="2" class="text-black">2</option>
                        <option value="3" class="text-black">3</option>
                        <option value="4" class="text-black">4</option>
                        <option value="5" class="text-black">5</option>
                        <option value="6" class="text-black">6</option>
                        <option value="7" class="text-black">7</option>
                        <option value="8" class="text-black">8</option>
                        <option value="9" class="text-black">9</option>
                        <option value="10" class="text-black">10 ou +</option>
                    </select>

                    
                    <p>Rendre visible?</p>
                    <input type="checkbox" id="visible" name="visible" value="1">  
                    <p>Télétravail?</p>
                    <input type="checkbox" id="tele" name="tele" value="1">     
                    <section title="choisir ent">
                        <legend>Appartient à quel entreprise</legend>
                        <select id="ent" name="ent" class="text-black">
                            <?php
                            foreach ($name_ent as $ent) {
                                $id_ent = $ent['ID_entreprise'];
                                $nom_offre = $ent['Nom'];
                            ?>
                                <option class="text-black"  value="<?php echo $id_ent; ?>">
                                    <?php echo $nom_offre; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </section>
            <section title="button part" >
                <button type="submit" name="envoi" class=" finish bg-blue-800 text-white text-lg rounded-full w-32 h-14 mx-10 hover:bg-blue-900">Valider</button>
            </section>
        </form>
    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="script/script.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</body>
</html>
