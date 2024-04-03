<?php
require_once(dirname(__FILE__) .'/../controller/controller.php');
redirection();

if (!isset($_GET['page'])){
  $_GET['page'] = 1;
}
$data = page_recherche($_GET['page'],false);

// Récupérer les valeurs de tri sélectionnées
$tri_date = isset($_GET['Date']) ? $_GET['Date'] : null;
$tri_nom_offre = isset($_GET['Name_offre']) ? $_GET['Name_offre'] : null;
$tri_ordre = isset($_GET['name_ent']) ? $_GET['name_ent'] : null;

$offres = get_offre($data[0],$data[1]);
$wishs = get_wish();

?>
    
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
              <button type="button" id="filtrermobile" class="w-full bg-blue-900 text-xl sm:text-2xl md:text-2xl lg:text-3xl text-white rounded px-8 py-2 font-size: 1.5vmin mt-4 rounded-full mx-2">Filtrer</button>
              <button type="button" id="triermobile" class="w-full bg-blue-900 text-xl sm:text-2xl md:text-2xl lg:text-3xl text-white rounded px-8 py-2 font-size: 1.5vmin mt-4 rounded-full mx-2">Trier</button>
            </section>
            
            <form id="formtrimobile" class="hidden md:hidden flex flex-col allfiltri border-solid border-gray-400 border-2 mt-6 mb-6 mx-4 px-4 py-2">
              <label>Date</label>
              <select name="date" class="selectdate border border-gray-400 rounded p-2">
                <option value="0"></option>
                <option value="1">Aujourd'hui</option>
                <option value="2">Ces 3 dernier jours</option>
                <option value="3">Cette semaine</option>
                <option value="4">Ce mois-ci</option>
              </select>
              <label>Nom d'offres</label>
              <select name="Name_offre" class="selectoffre border border-gray-400 rounded p-2">
                    <button id="réinitialiser" class="bg-blue-900 text-xl sm:text-xl md:text-xl lg:text-3xl text-white rounded py-2 font-size: 1.5vmin mt-4 rounded-full my-3 mx-2">Réinitialiser</button>
              </div>
              </form>
              <form id="formfiltremobile" class="hidden md:hidden text-xl flex flex-col allfiltri border-solid border-gray-400 border-2 mt-6 mb-6 mx-4 px-4 py-2">
                <label class="mb-2 font-bold">Niveau</label>
                <div class="flex flex-col"></div>
                <div class="flex items-center mb-2">


                </div>
                <div class="grid justify-items-stretch my-10">
                    <button  id="valider" class="bg-blue-900 text-xl sm:text-xl md:text-xl lg:text-3xl text-white rounded py-2 font-size: 1.5vmin mt-4 rounded-full my-3 mx-2">Valider</button>
                    <button type="button" id="réinitialiser" class="bg-blue-900 text-xl sm:text-xl md:text-xl lg:text-3xl text-white rounded py-2 font-size: 1.5vmin mt-4 rounded-full my-3 mx-2">Réinitialiser</button>
                  </div>
              </form>
            
            <section id="main" class="flex">
                <form id="filtretri" class="item-center hidden md:flex flex-col w-1/4 border-t border-r border-gray-400 px-4" alt="Section Filtre et Tri">
                  <h2 class="text-center text-3xl font-bold my-2">Trier</h2>
                  <button type="button" id="trier" class="bg-blue-900 text-xl sm:text-xl md:text-xl lg:text-3xl text-white rounded py-2 font-size: 1.5vmin mt-4 rounded-full my-3 mx-2">Trier par</button>
                  <div class="hidden allfiltri flex flex-col text-basic sm:text-basic md:text-basic lg:text-xl mx-4">
                    <label>Date</label>
                    <select name="Date" class="selectdate border border-gray-400 rounded p-2">
                    <select id="Date" name="Date" class="selectdate border border-gray-400 rounded p-2">
                      <option value="0"></option>
                      <option value="1">Aujourd'hui</option>
                      <option value="2">Ces 3 dernier jours</option>
                      <option value="3">Cette semaine</option>
                      <option value="4">Ce mois-ci</option>
                    </select>
                    <label>Nom</label>
                    <select id="Name_offre" name="Name_offre" class="selectoffre border border-gray-400 rounded p-2">
                      <option ></option>
                      <option value="Offres">Offres</option>
                      <option value="Entreprises">Entreprise</option>
                    </select>
                    <label>Ordre</label>
                    <select id="name_ent" name="name_ent" class="selectentreprise border border-gray-400 rounded p-2">
                      <option value="ASC">Croissant</option>
                      <option value="DESC">Décroissant</option>
                    </select>
                  </div>
                  <h2 class="text-center text-3xl font-bold my-2 mt-4">Filtrer</h2>
                  <button type="button" id="niveau" class="bg-blue-900 text-xl sm:text-xl md:text-xl lg:text-3xl text-white rounded py-2 font-size: 1.5vmin mt-4 rounded-full my-3 mx-2">Niveau</button>
                  <div class="hidden allfiltri flex flex-col text-basic sm:text-basic md:text-basic lg:text-xl mx-4">
                    <label>
                      <input class="bac0" type="checkbox" name="bac" value="Null">

@@ -287,12 +205,12 @@ $wishs=get_wish($conn);
                      Bac+5
                    </label>
                  </div>
                  <button id="localisation" class="bg-blue-900 text-xl sm:text-xl md:text-xl lg:text-3xl text-white rounded py-2 font-size: 1.5vmin mt-4 rounded-full my-3 mx-2">Localisation</button>
                  <button type="button" id="localisation" class="bg-blue-900 text-xl sm:text-xl md:text-xl lg:text-3xl text-white rounded py-2 font-size: 1.5vmin mt-4 rounded-full my-3 mx-2">Localisation</button>
                  <div class="hidden allfiltri flex flex-col text-basic sm:text-basic md:text-basic lg:text-xl mx-4">
                    <label>Ville</label>
                    <input name="Ville" class="inputville border border-gray-400 rounded p-2" type="text" class="border border-gray-400 rounded p-2">
                  </div>
                  <button id="domaine" class="bg-blue-900 text-xl sm:text-xl md:text-xl lg:text-3xl text-white rounded py-2 font-size: 1.5vmin mt-4 rounded-full my-3 mx-2">Domaine</button>
                  <button type="button" id="domaine" class="bg-blue-900 text-xl sm:text-xl md:text-xl lg:text-3xl text-white rounded py-2 font-size: 1.5vmin mt-4 rounded-full my-3 mx-2">Domaine</button>
                  <div class="hidden allfiltri flex flex-col text-basic sm:text-basic md:text-basic lg:text-xl mx-4">
                    <label>
                      <input class="generaliste" type="checkbox" name="Généraliste">

@@ -311,7 +229,7 @@ $wishs=get_wish($conn);
                      Système embarqué
                    </label>
                  </div>
                  <button id="contrat" class="bg-blue-900 text-xl sm:text-xl md:text-xl lg:text-3xl text-white rounded py-2 font-size: 1.5vmin mt-4 rounded-full my-3 mx-2">Contrat</button>
                  <button type="button" id="contrat" class="bg-blue-900 text-xl sm:text-xl md:text-xl lg:text-3xl text-white rounded py-2 font-size: 1.5vmin mt-4 rounded-full my-3 mx-2">Contrat</button>
                  <div class="hidden allfiltri flex flex-col text-basic sm:text-basic md:text-basic lg:text-xl mx-4">
                    
                    <label>Durée Contrat</label>

@@ -334,8 +252,8 @@ $wishs=get_wish($conn);
                    </label>
                  </div>
                  <div class="grid justify-items-stretch my-10">
                    <button  id="valider" class="bg-blue-900 text-xl sm:text-xl md:text-xl lg:text-3xl text-white rounded py-2 font-size: 1.5vmin mt-4 rounded-full my-3 mx-2">Valider</button>
                    <button id="réinitialiser" class="bg-blue-900 text-xl sm:text-xl md:text-xl lg:text-3xl text-white rounded py-2 font-size: 1.5vmin mt-4 rounded-full my-3 mx-2">Réinitialiser</button>
                    <button type="button" id="validerpc" class="bg-blue-900 text-xl sm:text-xl md:text-xl lg:text-3xl text-white rounded py-2 font-size: 1.5vmin mt-4 rounded-full my-3 mx-2">Valider</button>
                    <button type="button" id="réinitialiser" class="bg-blue-900 text-xl sm:text-xl md:text-xl lg:text-3xl text-white rounded py-2 font-size: 1.5vmin mt-4 rounded-full my-3 mx-2">Réinitialiser</button>
                  </div>
                </form>
                

@@ -352,7 +270,7 @@ $wishs=get_wish($conn);
                  
                  
              ?>
              <article class="flex flex-row border border-gray-400 mb-6 relative">
              <article class="flex flex-row border border-gray-400 mb-6 relative offrearticles">
                  <button class="absolute top-0 right-0 mr-2 my-2 ">
                  <?php
                    $wish_found = false;


@@ -386,39 +304,18 @@ $wishs=get_wish($conn);
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
            <?php 
            pagination($data[2],$data[1]);
            ?>
        </div>
        </section>
            

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
        <?php require_once(dirname(__FILE__) .'/footer.php');?>
        
        <script src="script/offre.js"></script>