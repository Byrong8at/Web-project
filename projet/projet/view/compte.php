<?php 
require_once(dirname(__FILE__) .'/../controller/controller.php');
redirection();
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
    
function stage_select($conn){
    $sql="SELECT stage.*,offre.*,candidature.ID_Candi,entreprise.Nom AS ent_Nom, entreprise.Voir As ent_see, avis.ID_user
            FROM stage 
            LEFT JOIN candidature on stage.ID_Candi =candidature.ID_Candi 
            LEFT JOIN offre on candidature.ID_offre=offre.ID_offre 
            LEFT JOIN entreprise on offre.ID_entreprise=entreprise.ID_entreprise
            LEFT JOIN avis ON offre.ID_offre = avis.ID_offre 
            WHERE stage.ID_user=:id_user AND offre.Voir=1 AND entreprise.Voir=1 AND (avis.ID_user IS NULL OR avis.ID_user <> :id_user);";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_user', $_SESSION['user']['ID_user'], PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$stage=stage_select($conn);
?>  
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="acceuil page cte">
    <meta name="theme-color" content="#567BB2">
    <title>Compte</title>
    <link href="style/compte.css" rel="stylesheet">
</head>
<body>   
     
    <?php require_once(dirname(__FILE__) .'/entete.php');?>
    <main>
        <section class="flex flex-row">
        <section id="menu" class="hidden bg-custom-green lg:flex flex-col justify-center item-center text-white w-80 h-full  py-10 px-4" title="Espace gestion compte">
            <img src="src/croix.png" id="croix" class=" lg:hidden w-10 h-10 flex justify-items-end item-center " fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <?php if ($_SESSION['user']['logo']) { ?>
                <img id="logo" src="<?php echo $_SESSION['user']['logo']; ?>" alt="profile picture" class="w-80 h-80 rounded-full"></a>
                <?php }else{ ?>
                    <img id="logo" src="src/user.png" alt="profile picture" class="w-80 h-auto"></a>
            <?php } ?>
            <p class="text-lg text text-center mb-4"><?php echo $_SESSION['user']['Nom'] . " " . $_SESSION['user']['Prénom'] ?></p>
            <section title="Suivi" class=" text-left">
                <p class="mx-4 text-2xl underline">Suivi</p>
                <ul class="mx-10 text-left">
                    <li class=" text-lg bg-blue-700 bg-opacity-50 rounded-md px-10" id="cv">Cv et lettre de motivation</li>
                    <li class=" text-lg" id="candidatures">Mes candidatures</li>
                    <li class=" text-lg" id="Calendrier">Calendrier</li>
                    <li class=" text-lg" id="favori">Favori</li>
                    <li class=" text-lg" id="modele">Modèles</li>
                </ul>
            </section>
            <section title="Partage" class=" text-left">
                <p class="mx-4 text-2xl underline">Partage</p>
                <ul class="mx-10 text-left">    
                    <li class=" text-lg" id="Evenement">Avis</li>
                    
                </ul>
            </section>
        </section>
        <img src="src/burger.png" id="hamburger" class="lg:hidden w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
    
    <section title="affichage">
        <section id="cv_affichage" class="flex flex-col justify-center items-center mx-auto">
            <button class="text-white text-lg bg-blue-900 rounded-md w-24 h-10 mt-4 mb-4">Televerser</button>
            <img src="src/cv.png" class="mx-10 my-10">
        </section>
        
        <section id="candidatures_affichage" class="hidden">
            <section class="text-white text-lg bg-blue-900 px-10 py-4  rounded-md ml-4 mt-4 mb-4 flex flex-col justify-center item-center mx-auto">
                <!--Rajouter image-->
                <p> candidature à l'entreprise: {$nom}</p>
                <p>Date</p>
                <p>Objet d'etude:</p>
            </section>
        </section>
        
        <section id="calendrier_affichage" class="hidden">
            <div class="flex flex-row justify-between item-center mx-auto px-4 py-8">
                <div class="text-center mb-4">
                  <h1 class="text-2xl font-bold">Calendrier</h1>
                  <div id="currentMonth" class="text-xl font-semibold"></div>
                </div>
                <div class="grid grid-cols-7 gap-2">
                  <div class="text-center bg-gray-200 p-2 rounded-md font-semibold">Dim</div>
                  <div class="text-center bg-gray-200 p-2 rounded-md font-semibold">Lun</div>
                  <div class="text-center bg-gray-200 p-2 rounded-md font-semibold">Mar</div>
                  <div class="text-center bg-gray-200 p-2 rounded-md font-semibold">Mer</div>
                  <div class="text-center bg-gray-200 p-2 rounded-md font-semibold">Jeu</div>
                  <div class="text-center bg-gray-200 p-2 rounded-md font-semibold">Ven</div>
                  <div class="text-center bg-gray-200 p-2 rounded-md font-semibold">Sam</div>
                </div>
                <div id="calendar" class="grid grid-cols-7 gap-2 mt-4"></div>
              </div>
        </section>
        
        <section id="Favori_affichage" class="hidden mx-10 flex flex-col justify-center item-center">
            <p class="text-2xl text-blue-900 ">Offre favorite:</p>
            <section class="text-white text-lg bg-blue-900 px-10 py-4  rounded-md ml-4 mt-4 mb-4  mx-auto w-full">
                <!--Rajouter image-->
                <p>  {$nom}</p>
                <p>Date</p>
                <p>Diplome</p>
                <p>Contenu:</p>
            </section>
        </section>
        
        <section id="modele_affichage" class="hidden mx-10 my-10 border-2 ">
            <img src="src/modele.png">
        </section>
        <section id="event_affichage" class="hidden ">
            <p class="text-xl">Vos avis:</p>
            <form method="POST" class="flex flex-col justify-center items-center ml-4 p-10 w-full max-w-lg">
                <div class="flex flex-row mb-4">
                    <p class="w-1/4 text-right pr-2">Avis fait le : </p>
                    <input type="date" id="date_avis" name="date_avis" class="flex-1 border border-gray-200 rounded-md py-2 px-3">
                </div>
                <div class="mb-4">
                    <label class="block">Quel stage choisir</label>
                    <select name="avis" class="border border-gray-200 rounded-md py-2 px-3 w-full">
                        <?php foreach ($stage as $stage) {
                            $id_offre = $stage['ID_offre'];
                            $nom_offre = $stage['Nom'];
                            $nom_ent = $stage['ent_Nom'];
                        ?>
                        <option class="text-black text-lg" value="<?php echo $id_offre; ?>"><?php echo $nom_offre; ?>-<span class="text-md"><?php echo $nom_ent ?></span></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block">Decrivez votre avis</label>
                    <textarea name="Description" class="border border-gray-200 rounded-md py-2 px-3 w-full"></textarea>
                </div>
                <section class="flex flex-col mb-4">
                    <label>Note de ce stage:</label>
                    <input id="pi_input" name="note" type="range" min="0" max="5" step="0.5" class="mt-2" />
                    <p>Votre note: <output id="value" class="font-medium"></output></p>
                </section>

                <button type="submit" name="noter" class="finish bg-blue-800 text-white text-lg rounded-full py-2 px-6 hover:bg-blue-900">Valider votre avis</button>
            </form>
        </section>
        
    </section>
    </section>
    </main>
    
    <script src="script/compte.js"></script>
    <script src="script/avis.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
</body>
</html>