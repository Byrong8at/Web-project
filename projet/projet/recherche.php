<?php
require_once(dirname(__FILE__) .'/bdd.php');
session_start();



//pour determiner le nombre de page
$sql = 'SELECT COUNT(*) AS nb_offre FROM `offre`;';
$query = $conn->prepare($sql);
$query->execute();
$result = $query->fetch();
$nb_offre = (int) $result['nb_offre'];

$limite = 10;
$page_actu = 1; 
$nb_Page =ceil($nb_offre / $limite);
if (isset($_GET['page']) && !empty($_GET['page'])){
    $page_actu=(int)strip_tags($_GET['page']);
}else{
    $page_actu = 1;
}
if ($page_actu>$nb_Page){
    header("Location: error.html");  
}

if ($page_actu<1){
    header("Location: error.html");  
    exit; 
}
function get_offre($conn, $limite, $page_actu) {
    $debut = ($page_actu - 1) * $limite;
    $sql = "SELECT offre.*, entreprise.Nom AS entreprise_Nom, entreprise.Adresse
            FROM offre
            INNER JOIN entreprise ON offre.ID_entreprise = entreprise.ID_entreprise
            WHERE offre.voir = 1 AND entreprise.Voir = 1
            LIMIT :limit OFFSET :debut";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':limit', $limite, PDO::PARAM_INT);
    $stmt->bindParam(':debut', $debut, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$offres = get_offre($conn, $limite, $page_actu);
?>




<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="page offre">
    <meta name="theme-color" content="#567BB2">
    <link href="style/compte.css" rel="stylesheet">
    <title>Recherche offre</title>
</head>
<body>
        <header class="bg-blue-900 text-white flex justify-between items-center  py-2 ">
          <a href="acceuil.html">
            <img src="src/logo.png" alt="logo du site" class="w-24 h-auto mr-0" ></a>
            <div class="flex items-center space-x-4 flex-grow"> 
                <input type="text" class="w-full sm:w-48 md:w-200 lg:w-80 xl:w-200 h-10 px-4 rounded-full border border-gray-300 text-black" placeholder="Search">
            </div>
             
            &nbsp;&nbsp;&nbsp;&nbsp;<img src="src/user.svg" alt="profile picture" class="w-10 h-auto">&nbsp;&nbsp;
        </header>
    
        <main>

            <section class="w-full h-50vh relative">
                <img src="src/ibm.jpeg" class="w-full h-96" alt="offre moment">
                <div class="flex flex-col items-center justify-center absolute top-0 left-0 right-0 bottom-0">
                    <h1 class="text-2xl md:text-3xl lg:text-4xl text-white px-8 py-2 font-size: 3vmin">Postuler à l'offre du moment</h1>
                    <button class="bg-blue-900 text-xl md:text-2xl lg:text-3xl text-white rounded- px-8 py-2 font-size: 1.5vmin mt-4 rounded-full">
                        Postuler
                    </button>
                </div>
            </section>
            <section class="w-full h-auto relative mt-8 mb-4">
              <h1 class="text-center text-4xl font-bold md:text-4xl sm:text-4xl xl:text-7xl">EMPLOI DISPONIBLE</h1>
            </section>
            <section id="filtretrimobile" class="md:hidden mb-4 flex justify-between w-full" alt="Section Filtre et Tri version mobile">
              <button id="filtrermobile" class="w-full bg-blue-900 text-xl sm:text-2xl md:text-2xl lg:text-3xl text-white rounded px-8 py-2 font-size: 1.5vmin mt-4 rounded-full mx-2">Filtrer</button>
              <button id="triermobile" class="w-full bg-blue-900 text-xl sm:text-2xl md:text-2xl lg:text-3xl text-white rounded px-8 py-2 font-size: 1.5vmin mt-4 rounded-full mx-2">Trier</button>
            </section>
            <div class="hidden md:hidden flex flex-col allfiltri border-solid border-gray-400 border-2 mt-6 mb-6 mx-4 px-4 py-2">
              <label>Date</label>
              <select class="selectdate border border-gray-400 rounded p-2">
                <option></option>
                <option>Aujourd'hui</option>
                <option>Ces 3 dernier jours</option>
                <option>Cette semaine</option>
                <option>Ce mois-ci</option>
              </select>
              <label>Nom d'offres</label>
              <select class="selectoffre border border-gray-400 rounded p-2">
                <option></option>
                <option></option>
                <option>Croissant</option>
                <option>Décroissant</option>
              </select>
              <label>Nom d'entreprise</label>
              <select class="selectentreprise border border-gray-400 rounded p-2 mb-2">
                <option></option>
                <option></option>
                <option>Croissant</option>
                <option>Décroissant</option>
              </select>
              </div>
              <div class="hidden md:hidden text-xl flex flex-col allfiltri border-solid border-gray-400 border-2 mt-6 mb-6 mx-4 px-4 py-2">
                <label class="mb-2 font-bold">Niveau</label>
                <div class="flex flex-col"></div>
                <div class="flex items-center mb-2">
                  <input class="bac0 w-6 h-6 mr-2" type="checkbox" name="myCheckbox" value="option1">
                  <label>Pas d'expérience</label>
                </div>
                <div class="flex items-center mb-2">
                  <input class="bac1 w-6 h-6 mr-2" type="checkbox" name="myCheckbox" value="option1">
                  <label>Bac</label>
                </div>
                <div class="flex items-center mb-2">
                  <input class="bac2 w-6 h-6 mr-2" type="checkbox" name="myCheckbox" value="option1">
                  <label>Bac+2</label>
                </div>
                <div class="flex items-center mb-2">
                  <input class="bac3 w-6 h-6 mr-2" type="checkbox" name="myCheckbox" value="option2">
                  <label>Bac+3</label>
                </div>
                <div class="flex items-center mb-2">  
                  <input class="bac4 w-6 h-6 mr-2" type="checkbox" name="myCheckbox" value="option3">
                  <label>Bac+4</label>
                </div>
                <div class="flex items-center mb-2">
                  <input class="bac5 w-6 h-6 mr-2" type="checkbox" name="myCheckbox" value="option3">
                  <label>Bac+5</label>
                </div>
                <label class="pt-2 font-bold">Ville</label>
                <input type="text" class="inputville border border-gray-400 rounded p-2">
                <label class="pt-2 font-bold ">Contrat</label>
                    <select class="selectcontrat border border-gray-400 rounded p-2">
                      <option></option>
                      <option>Stage</option>
                      <option>Alternance</option>
                    </select>
                    <label class="pt-2 font-bold">Durée Contrat</label>
                    <select class="selectdureecontrat border border-gray-400 rounded p-2">
                      <option></option>
                      <option>1 mois</option>
                      <option>2 mois</option>
                      <option>3 mois</option>
                      <option>4 mois</option>
                      <option>5 mois</option>
                      <option>6+ mois</option>
                    </select>
                
                <div class="flex items-center mb-2 mt-4">
                  <input class="remuneration w-6 h-6 mr-2" type="checkbox" name="myCheckbox" value="">
                  <label>Rémunération</label>
                </div>
                <div class="flex items-center mb-2">
                  <input class="teletravail w-6 h-6 mr-2" type="checkbox" name="myCheckbox" value="">
                  <label>Télétravail</label>
                </div>
                <label class="py-2 font-bold">Domaine</label>
                <div class="flex items-center mb-2">
                  <input class="generaliste w-6 h-6 mr-2" type="checkbox" name="myCheckbox">
                  <label>Généraliste</label>
                </div>
                <div class="flex items-center mb-2">
                  <input class="informatique w-6 h-6 mr-2" type="checkbox" name="myCheckbox">
                  <label>Informatique</label>
                </div>
                <div class="flex items-center mb-2">
                  <input class="btp w-6 h-6 mr-2" type="checkbox" name="myCheckbox">
                  <label>BTP</label>
                </div>
                <div class="flex items-center mb-2">
                  <input class="s3e w-6 h-6 mr-2" type="checkbox" name="myCheckbox">
                  <label>Système embarqué</label>
                </div>
              </div>
            
            
            
            <section id="main" class="flex">
                <section id="filtretri" class="item-center hidden md:flex flex-col w-1/4 border-t border-r border-gray-400 px-4" alt="Section Filtre et Tri">
                  <h2 class="text-center text-3xl font-bold my-2">Trier</h2>
                  <button id="trier" class="bg-blue-900 text-xl sm:text-xl md:text-xl lg:text-3xl text-white rounded py-2 font-size: 1.5vmin mt-4 rounded-full my-3 mx-2">Trier par</button>
                  <div class="hidden allfiltri flex flex-col text-basic sm:text-basic md:text-basic lg:text-xl mx-4">
                    <label>Date</label>
                    <select class="selectdate border border-gray-400 rounded p-2">
                      <option></option>
                      <option>Aujourd'hui</option>
                      <option>Ces 3 dernier jours</option>
                      <option>Cette semaine</option>
                      <option>Ce mois-ci</option>
                    </select>
                    <label>Nom d'offres</label>
                    <select class="selectoffre border border-gray-400 rounded p-2">
                      <option></option>
                      <option>Croissant</option>
                      <option>Décroissant</option>
                    </select>
                    <label>Nom d'entreprise</label>
                    <select class="selectentreprise border border-gray-400 rounded p-2">
                      <option></option>
                      <option>Croissant</option>
                      <option>Décroissant</option>
                    </select>
                  </div>
                  <h2 class="text-center text-3xl font-bold my-2 mt-4">Filtrer</h2>
                  <button id="niveau" class="bg-blue-900 text-xl sm:text-xl md:text-xl lg:text-3xl text-white rounded py-2 font-size: 1.5vmin mt-4 rounded-full my-3 mx-2">Niveau</button>
                  <div class="hidden allfiltri flex flex-col text-basic sm:text-basic md:text-basic lg:text-xl mx-4">
                    <label>
                      <input class="bac0" type="checkbox" name="myCheckbox" value="option1">
                      Pas d'expérience
                    </label>
                    <label>
                      <input class="bac1" type="checkbox" name="myCheckbox" value="option1">
                      Bac
                    </label>
                    <label>
                      <input class="bac2" type="checkbox" name="myCheckbox" value="option1">
                      Bac+2
                    </label>
                    <label>
                      <input class="bac3" type="checkbox" name="myCheckbox" value="option2">
                      Bac+3
                    </label>
                    <label>
                      <input class="bac4" type="checkbox" name="myCheckbox" value="option3">
                      Bac+4
                    </label>
                    <label>
                      <input class="bac5" type="checkbox" name="myCheckbox" value="option3">
                      Bac+5
                    </label>
                  </div>
                  <button id="localisation" class="bg-blue-900 text-xl sm:text-xl md:text-xl lg:text-3xl text-white rounded py-2 font-size: 1.5vmin mt-4 rounded-full my-3 mx-2">Localisation</button>
                  <div class="hidden allfiltri flex flex-col text-basic sm:text-basic md:text-basic lg:text-xl mx-4">
                    <label>Ville</label>
                    <input class="inputville border border-gray-400 rounded p-2" type="text" class="border border-gray-400 rounded p-2">
                  </div>
                  <button id="domaine" class="bg-blue-900 text-xl sm:text-xl md:text-xl lg:text-3xl text-white rounded py-2 font-size: 1.5vmin mt-4 rounded-full my-3 mx-2">Domaine</button>
                  <div class="hidden allfiltri flex flex-col text-basic sm:text-basic md:text-basic lg:text-xl mx-4">
                    <label>
                      <input class="generaliste" type="checkbox" name="myCheckbox">
                      Généraliste
                    </label>
                    <label>
                      <input class="informatique" type="checkbox" name="myCheckbox">
                      Informatique
                    </label>
                    <label>
                      <input class="btp" type="checkbox" name="myCheckbox">
                      BTP
                    </label>
                    <label>
                      <input class="s3e" type="checkbox" name="myCheckbox">
                      Système embarqué
                    </label>
                  </div>
                  <button id="contrat" class="bg-blue-900 text-xl sm:text-xl md:text-xl lg:text-3xl text-white rounded py-2 font-size: 1.5vmin mt-4 rounded-full my-3 mx-2">Contrat</button>
                  <div class="hidden allfiltri flex flex-col text-basic sm:text-basic md:text-basic lg:text-xl mx-4">
                    <label>Contrat</label>
                    <select class="selectcontrat border border-gray-400 rounded p-2">
                      <option></option>
                      <option>Stage</option>
                      <option>Alternance</option>
                    </select>
                    <label>Durée Contrat</label>
                    <select class="selectdureecontrat border border-gray-400 rounded p-2">
                      <option></option>
                      <option>1 mois</option>
                      <option>2 mois</option>
                      <option>3 mois</option>
                      <option>4 mois</option>
                      <option>5 mois</option>
                      <option>6+ mois</option>
                    </select>
                    <label>
                      <input class="remuneration" type="checkbox" name="myCheckbox" value="">
                      Rémunération
                    </label>
                    <label>
                      <input class="teletravail" type="checkbox" name="myCheckbox" value="">
                      Télétravail
                    </label>
                  </div>
                  <div class="grid justify-items-stretch my-10">
                    <button id="valider" class="bg-blue-900 text-xl sm:text-xl md:text-xl lg:text-3xl text-white rounded py-2 font-size: 1.5vmin mt-4 rounded-full my-3 mx-2">Valider</button>
                    <button id="réinitialiser" class="bg-blue-900 text-xl sm:text-xl md:text-xl lg:text-3xl text-white rounded py-2 font-size: 1.5vmin mt-4 rounded-full my-3 mx-2">Réinitialiser</button>
                  </div>
                </section>
                
                <section id="offre" class="w-full md:w-3/4 p-6 border-t border-gray-400" alt="Section offre">
                <?php
                foreach ($offres as $offre) {
                    $id_offre = $offre['ID_offre'];
                    $nom_offre = $offre['Nom'];
                    $description_offre = $offre['detail'];
                    $nom_entreprise = $offre['entreprise_Nom']; 
                    $lieu= $offre['Adresse'];
                ?>
                <article class="flex flex-row border border-gray-400 mb-6 relative">
                    <button class="absolute top-0 right-0 mr-2 my-2">
                        <img name="love" src="src/coeur.png" class="w-10 h-10 coeur" alt="coeur">
                    </button>
                    <img src="src/cesi.png" class="w-16 h-16" alt="logo">
                    <div class="flex flex-col flex-grow justify-between ml-1">
                        <div>
                            <a href="www.google.fr" class="text-xl text-blue-500 font-bold"><?php echo $nom_offre; ?></a>
                            <h2><?php echo $nom_entreprise; ?></h2>
                            <h2><?php echo $lieu; ?></h2>
                        </div>
                        <p class="text-right content-offre text-ellipsis overflow-hidden"><?php echo $description_offre; ?></p>
                    </div>
                </article>
                <?php } ?>

                  
            <div class="flex justify-center items-center text-black">
            <?php
            echo "Page : " ;
            
            for ($i = 1; $i <= $nb_Page; $i++) {
                if ($i == $page_actu) {
                    echo "<strong id='element'>$i</strong> ";
                } else {
                    echo "<a href='?page=$i' id='element'>$i</a> ";
                }
            }
            ?>
        </div>
            

        </main>
        <footer class="bg-blue-900 text-white flex flex-col sm:flex-row justify-between items-center px-10 py-8 mt-6">
          <section class="mt-4 sm:mt-0">
              <p>Nous contacter par mail:</p>
              <p><span class="move"><a href="mailto:hugo.lefebvre1@viacesi.fr">hugo.lefebvre1@viacesi.fr</a></span></p>
              <p>Nous contacter par téléphone:</p>
              <p><span class="move"><a href="tel:0637132323">06 37 13 23 23</a></span></p>
          </section>

          <section class="mt-4 sm:mt-0">
              <p><a href="cgu.html">Nos Conditions D'utilisation</a></p>
              <p><a href="mention.html">Nos mentions légale d'utilisation</a></p>
          </section>

           
        </footer>
        
        <script src="script/offre.js"></script>
    
</body>
</html>