<?php 
require_once(dirname(__FILE__) .'/../controller/controller.php');
adminredirection();
if (isset($_POST['noter'])) {
    if(!empty($_POST['Description']) AND !empty($_POST['note']) AND !empty($_POST['date_avis'])) {
        $note= $_POST['note'];
        $detail= $_POST['Description'];
        $avis=$_POST['avis'];
        $date_avis = $_POST['date_avis']; 
        $timestamp = strtotime($date_avis);
        $date_format = date('Y-m-d', $timestamp);
        
        try {
            if (set_avis($note, $date_format, $detail, $avis, $conn)) {
                echo "avis Valider";
            } else {
                echo 'Une erreur à eu lieu';
            }
        } catch (PDOException $e) {
            echo  "Échec de la connexion à la base de données : " . $e->getMessage();
        }
    }
        else{
            echo "Veuillez completez les champs obligatoires";
        }
    }
    
function set_avis($note, $date_format, $detail, $avis, $conn){
    $sql="INSERT INTO avis(Note,description,Jour,ID_user,ID_offre) VALUES (:note,:detail,:Date,:Id_user,:Id_offre)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':note', $note, PDO::PARAM_INT);
    $stmt->bindParam(':detail', $detail, PDO::PARAM_STR);
    $stmt->bindParam(':Date', $date_format, PDO::PARAM_STR);;
    $stmt->bindParam(':Id_user', $_SESSION['user']['ID_user'], PDO::PARAM_INT);
    $stmt->bindParam(':Id_offre', $avis, PDO::PARAM_INT);
    $stmt->execute();
    $stmt->fetch(PDO::FETCH_ASSOC);

    return true;
}
    
function stage_select_tuteur($conn){
    $sql="SELECT offre.*,entreprise.Nom AS ent_Nom, entreprise.Voir As ent_see, avis.ID_user
    FROM offre 
    LEFT JOIN entreprise on offre.ID_entreprise=entreprise.ID_entreprise
    LEFT JOIN avis ON offre.ID_offre = avis.ID_offre 
    WHERE  offre.Voir=1 AND entreprise.Voir=1 AND (avis.ID_user IS NULL OR avis.ID_user <> :Id_user);";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':Id_user', $_SESSION['user']['ID_user'], PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$stage=stage_select_tuteur($conn);
?>  
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Avis">
    <meta name="theme-color" content="#567BB2">
    <title>Avis</title>
    <link href="style/compte.css" rel="stylesheet">
</head>
<body>   
     
    <?php require_once(dirname(__FILE__) .'/entete.php');?>

<main>
<p class="flex justify-center items-center mx-10 text-xl">Vos avis:</p>
                <form method="POST" >
                    <div class="flex flex-row">
                        <p>Avis fait le : </p>
                        <input type="text" id="date_avis" name="date_avis" readonly>
                    </div>
                    <label>Quel stage choisir</label>
                
                    <select name="avis">
                        <?php foreach ($stage as $stage) {
                            $id_offre = $stage['ID_offre'];
                            $nom_offre = $stage['Nom'];
                            $nom_ent = $stage['ent_Nom'];
                        ?>
                        <option class="text-black text-lg" value="<?php echo $id_offre; ?>"><?php echo $nom_offre; ?>-<span class="text-md"><?php echo $nom_ent ?></span></option>
                        <?php } ?>
                    </select>
                    <label>Decrivez votre avis</label>
                    <textarea name="Description" class="border border-gray-200 w-32"></textarea>
                    <section class="flex flex-col w-32">
                        <label>Note de ce stage:</label>
                        <input id="pi_input" name="note" type="range" min="0" max="5" step="0.5" />
                        <p>Votre note: <output id="value"></output></p>
                    </section>

                    <button type="submit" name="noter" class=" finish bg-blue-800 text-white text-lg rounded-full w-32 h-14 mx-10 hover:bg-blue-900">Valider votre avis</button>
                </form>
        </section>
        
    </section>
    </section>
    </main>
    <script src="script/avis.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
</body>
</html>