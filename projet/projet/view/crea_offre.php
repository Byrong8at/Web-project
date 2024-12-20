<?php
    require_once(dirname(__FILE__) .'/../controller/controller.php');
    adminredirection();

$error_message = "";

if (isset($_POST['envoi'])) {
    if(!empty($_POST['nom'])AND !empty($_POST['description']) AND !empty($_POST['durée'])){
        $nom= $_POST['nom'];
        $competences=$_POST['competences'];
        $detail= $_POST['description'];
        $promo=$_POST['promo'];
        $duree=$_POST['durée'];
        $dates = $_POST['date']; 

        $salaire = $_POST['salaire'];
        $place= $_POST['place'];
        $visible = isset($_POST['visible']) ? (int) $_POST['visible'] : 0;
        $tele= isset($_POST['tele']) ? (int) $_POST['tele'] : 0;
        $ent=$_POST['ent'];
        
        try {
            if (creation($nom, $competences, $detail, $promo, $duree, $dates, $salaire, $place, $visible, $tele,$ent, $conn)) {
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

    function creation($nom, $competences, $detail, $promo, $duree, $dates, $salaire, $place, $visible, $tele, $ent, $conn) {
        try {
            $quezy = $conn->prepare( "INSERT INTO offre(Nom, competences, detail, promo, durée_du_stage, Rémunération, date_de_l_offre, place, Voir, Teletravail, ID_entreprise) VALUES (:nom, :competences, :detail, :promo, :duree, :salaire,:dates,  :place, :visible, :tele, :ent)");
            $quezy->bindParam(':nom', $nom);
            $quezy->bindParam(':competences', $competences);
            $quezy->bindParam(':detail', $detail);
            $quezy->bindParam(':promo', $promo);
            $quezy->bindParam(':duree', $duree);
            $quezy->bindParam(':dates', $dates);
            $quezy->bindParam(':salaire', $salaire);
            $quezy->bindParam(':place', $place);
            $quezy->bindParam(':visible', $visible);
            $quezy->bindParam(':tele', $tele);
            $quezy->bindParam(':ent', $ent);
            $quezy->execute();
            return true;
        } catch (PDOException $e) {
            echo "Erreur creation: " . $e->getMessage();
        }
    }
    

function entreprise($conn){
    try {
        $sql = "SELECT * FROM entreprise WHERE Voir = 1";
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
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Modification">
    <meta name="theme-color" content="#567BB2">
    <link rel="stylesheet" href="style/user_cre.css">
    <link rel="stylesheet" href="style/offre_gerer.css">
    <title>Creation offre</title>
</head>
<body> 
    <?php require_once(dirname(__FILE__) .'/entete.php');?>
    
    <main>
        <header>
            <p>Creation d'une offre</p>
        </header>
        <?php
            echo '<p name="error-message">' . $error_message . '</p>';
        ?>
        <form method="post" enctype="multipart/form-data">
            <section title="formulaire creation">
                <section title="input">
                        <legend class="flex-none">Nom</legend>
                        <input type="text" name="nom">
                    <legend class="flex-none">compétences</legend>
                    <input type="text" id="competences" name="competences">
                    <legend class="flex-none">Description </legend>
                    <textarea name="description" id="description"></textarea>
                    <legend class="flex-none">Type de promo concerné</legend>
                    <select name="promo">
                        <option  value="1">X1_i1</option>
                        <option value="2">X1_i2</option>
                        <option  value="3">X1_i3</option>
                        <option  value="4">X1_i4</option>
                        <option  value="5">X1_i5</option>
                    </select>

                    <legend>Durée du stage</legend>
                    <input type="text" name="durée">
                    <legend>Salaire</legend>
                    <input type="text" name="salaire">
                    <legend>Date de l'offre</legend>
                    <input type="date" id="date_avis" name="date">
                    <legend>Nombre de places :</legend>
                    <select name="place">
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10 ou +</option>
                    </select>

                    <p>Rendre visible?</p>
                    <input type="checkbox" name="visible" value="1">
                    <p>Télétravail?</p>
                    <input type="checkbox" name="tele" value="1">
                    <section title="choisir ent">
                        <legend>Appartient à quel entreprise</legend>
                        <select name="ent">
                            <?php
                            foreach ($name_ent as $ent) {
                                $id_ent = $ent['ID_entreprise'];
                                $nom_offre = $ent['Nom'];
                            ?>
                                <option value="<?php echo $id_ent; ?>">
                                    <?php echo $nom_offre; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </section>
                </section>
            </section>
            <section title="button part">
                <button type="submit" name="envoi" id="submit" class="bg-blue-800 text-white text-lg rounded-full w-32 h-14 mx-10 hover:bg-blue-900">Valider</button>
                <button class="bg-blue-800 text-white text-lg rounded-full w-32 h-14 mx-10 hover:bg-blue-900" onclick="restart()">Reinitialiser</button>
            </section>
        </form>
    </main>
    
    <script src="script/creation.js"></script>
    <script src="script/avis.js"></script>
</body>
</html>