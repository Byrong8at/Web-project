<?php
require_once(dirname(__FILE__) .'/../modele/m_entreprise.php');
require_once(dirname(__FILE__) .'/../modele/m_offre.php');
require_once(dirname(__FILE__) .'/../modele/m_user.php');
require_once(dirname(__FILE__) .'/../modele/m_search.php');

if (isset($_POST['function']) && $_POST['function'] == 'search') {
    $search_term = $_POST['search'];
    search($search_term);
}

function get_all($id,$name){
    global $conn;
    if ($name == "entreprise"){
        $classentreprise = new entreprise();
        $data_entreprise = $classentreprise->get_all($conn, $id);
        return $data_entreprise;
    }else if ($name == "utilisateur"){
        $classuser = new user();
        $data_user = $classuser->get_all($conn, $id);
        return $data_user;
    }else if ($name == "offre"){
        $classoffre = new entreprise();
        $data_offre = $classoffre->get_all($conn, $id);
        return $data_offre;
    }
}

function get_entrepriseOffres($id){
    global $conn;
    $class = new entreprise();
    $data = $class->get_offres($conn, $id);
    return $data;
}

function get_adressesEntreprise($id){
    global $conn;
    $class = new entreprise();
    $data = $class->get_adresses($conn, $id);
    return $data;
}

function page_offre($id){
    global $conn;
    $classoffre = new offre();
    $data_offre = $classoffre->get_all($conn, $id);
    $data_offre[0]['entreprise_Nom'] = $classoffre->get_nomEntreprise($conn, $id);
    $adresses = $classoffre->get_adressesEntreprise($conn, $id);
    $data_offre[0]['entreprise_Adresse'] = $adresses[0]['Adresse'];
    $data_offre[0]['entreprise_Adresse2'] = $adresses[0]['Adresse_2'];
    $data_offre[0]['entreprise_Adresse3'] = $adresses[0]['Adresse_3'];
    return $data_offre;
}

function page_recherche($getpage,$filtretri){
    global $conn;
    if ($filtretri === false) {
        $sql = 'SELECT COUNT(*) AS nb_offre FROM `offre`';
        $query = $conn->prepare($sql);
        $query->execute();
        $result = $query->fetch();
        $nb_offre = (int) $result['nb_offre'];
    } else {
        
        $sql = "SELECT COUNT(*) AS nb_offre FROM 'offre'
                :wh
                ;";
        $query = $conn->prepare($sql);
        $query->bindParam(':wh', $filtretri[0], PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch();
        $nb_offre = (int) $result['nb_offre'];
    }
    $limite = 10;
    $page_actu = 1; 
    $nb_Page =ceil($nb_offre / $limite);
    if (isset($getpage) && !empty($getpage)){
        $page_actu=(int)strip_tags($getpage);
    }else{
        $page_actu = 1;
    }
    if ($page_actu>$nb_Page){
        header("Location: error.php");  
    }

    if ($page_actu<1){
        header("Location: error.php");  
        exit; 
    }
    return [$limite,$page_actu,$nb_Page];
}

function pagination($nb_Page,$page_actu){
    echo "Page : " ;
            for ($i = 1; $i <= $nb_Page; $i++) {
                if ($i == $page_actu) {
                    echo "<strong id='element'>$i</strong> ";
                } else {
                    echo "<a href='?page=$i' id='element'>$i</a> ";
                }
            }
}

function get_offre($limite, $page_actu) {
    global $conn;
    $debut = ($page_actu - 1) * $limite;
    $sql = "SELECT offre.*, entreprise.Nom AS entreprise_Nom, entreprise.Adresse
            FROM offre
            INNER JOIN entreprise ON offre.ID_entreprise = entreprise.ID_entreprise
            WHERE offre.voir = 1 AND entreprise.Voir = 1
            ORDER BY offre.date_de_l_offre DESC, entreprise.Nom ASC, offre.Nom ASC
            LIMIT :limit OFFSET :debut";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':limit', $limite, PDO::PARAM_INT);
    $stmt->bindParam(':debut', $debut, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function get_offre_trifiltre($limite, $page_actu, $date, $nom, $ordre) {
    global $conn;
    switch ($date) {
        case '1':
            $whereClause = "offre.date_de_l_offre = CURRENT_DATE()";
            break;
        case '2':
            $whereClause = "offre.date_de_l_offre >= CURRENT_DATE() - INTERVAL 3 DAY";
            break;
        case '3':
            $whereClause = "offre.date_de_l_offre >= CURRENT_DATE() - INTERVAL 1 WEEK";
            break;
        case '4':
            $whereClause = "offre.date_de_l_offre >= CURRENT_DATE() - INTERVAL 1 MONTH";
            break;
        default:
            $whereClause = "1=1";
    }
    switch ($nom) {
        case 'Offres':
            $orderClause = "ORDER BY offre.Nom";
            break;
        case 'Entreprises':
            $orderClause = "ORDER BY entreprise.Nom";
            break;
        default:
            $orderClause = "";
            break;
    }
    switch ($ordre) {
        case 'ASC':
            $ordreClause = "ASC";
            break;
        case 'DESC':
            $ordreClause = "DESC";
            break;
        default:
            $ordreClause = "";
            break;
        }
    $debut = ($page_actu - 1) * $limite;
    $sql = "SELECT offre.*, entreprise.Nom AS entreprise_Nom, entreprise.Adresse
            FROM offre
            INNER JOIN entreprise ON offre.ID_entreprise = entreprise.ID_entreprise
            WHERE offre.voir = 1 AND entreprise.Voir = 1
            AND $whereClause 
            $orderClause $ordreClause
            LIMIT :limit OFFSET :debut";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':limit', $limite, PDO::PARAM_INT);
    $stmt->bindParam(':debut', $debut, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function get_wish(){
    global $conn;
    $sqllog = "SELECT wishlist.ID_user, wishlist.ID_offre as wish_id_offre
            FROM wishlist
            WHERE ID_User=:ID_use
            ";
  
    $stmt = $conn->prepare($sqllog);
    $stmt->bindParam(':ID_use', $_SESSION['user']['ID_user'], PDO::PARAM_INT);
    $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    
  };

function adminredirection(){
    if (!isset($_SESSION)) {
        session_start();
    }
    if (!isset($_SESSION['user'])) {
        header('Location: connexion.php');
        exit();
    } else if ($_SESSION['user']['Statut'] != 0 || $_SESSION['user']['Statut'] != 2) {
        header('Location: error.php');
        exit();
    }
}


function redirection(){
    if (!isset($_SESSION)) {
        session_start();
    }
    
    
    if (!isset($_SESSION['user'])) {
        header('Location: connexion.php');
        exit();
    }
}


function search($search_term){
    $dtb = initbdd();
    $classsearch = new search();
    $data = $classsearch->getall($search_term, $dtb);
    foreach ($data as $row) {
        switch ($row['category']) {
            case 'entreprise':
                echo '<a href="entreprise.php?ID_entreprise=' . $row['ID'] . '"><p class="all-item" data-id="' . $row['ID'] . '" style="background-color: transparent; cursor: pointer;" onmouseover="this.style.backgroundColor=\'blue\'" onmouseout="this.style.backgroundColor=\'transparent\'">' . $row['Nom'] . '</p></a>';
                break;
            case 'offre':
                echo '<a href="offre.php?ID_offre=' . $row['ID'] . '"><p class="all-item" data-id="' . $row['ID'] . '" style="background-color: transparent; cursor: pointer;" onmouseover="this.style.backgroundColor=\'blue\'" onmouseout="this.style.backgroundColor=\'transparent\'">' . $row['Nom'] . '</p></a>';
                break;
            case 'utilisateur':
                echo '<a href="utilisateur.php?ID_utilisateur=' . $row['ID'] . '"><p class="all-item" data-id="' . $row['ID'] . '" style="background-color: transparent; cursor: pointer;" onmouseover="this.style.backgroundColor=\'blue\'" onmouseout="this.style.backgroundColor=\'transparent\'">' . $row['Nom'] ." ". $row['Prénom'] . '</p></a>';
                break;
        }
    }
    
}

function initbdd(){
    $host = 'localhost';
    $dbname = 'phpmyadmin';
    $user = 'root';
    $password = '';
    $charset = 'utf8mb4';

    if (!isset($conn)) {
        try {
            $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=$charset", $user, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $databaseInitialized = true;
        } catch(PDOException $e) {
            echo "Erreur de connexion : " . $e->getMessage();
        }
    }else {
        // Connexion déjà faite
    }
    return $conn;
}

function article($print){
    $articles = [];
    foreach ($print as $offre) {
        $id_offre = $offre['ID_offre'];
        $nom_offre = $offre['Nom'];
        $view = $offre['Voir'];
        $description_offre = $offre['detail'];
        $nom_entreprise = $offre['entreprise_Nom'];
        $lieu = $offre['Adresse'];
        $id_entreprise = $offre['ID_entreprise'];

        // Vérifier $wish_found et définir $wish_img (code inchangé)
        $wishs = get_wish();
        $wish_found = false;
            foreach ($wishs as $wish) {
                $wish_id = $wish['wish_id_offre'];
                $wish_user = $wish['ID_user'];         
                if ($wish_user == $_SESSION['user']['ID_user'] && $wish_id == $id_offre) {
                    $wish_found = true;
                        break;
                    }
                }
            if ($wish_found) {
                $wish_img = '<img name="love" src="src/coeurrempli.png" class="w-10 h-10 coeur favorite fav-add" data-id="' . $id_offre . '" alt="coeur">';
            } else {
                $wish_img = '<img name="love" src="src/coeur.png" class="w-10 h-10 coeur fav-add" data-id="' . $id_offre . '" alt="coeur">';
            }
        $article = '
        <article class="flex flex-row border border-gray-400 mb-6 relative offrearticles">
            <button class="absolute top-0 right-0 mr-2 my-2">
                ' . $wish_img . '
            </button>
            <img src="src/cesi.png" class="w-16 h-16" alt="logo">
            <div class="flex flex-col flex-grow justify-between ml-1">
                <div>
                    <a href="offre.php?ID_offre=' . $id_offre . '" class="text-xl text-blue-500 font-bold">' . $nom_offre . '</a>
                    <a href="entreprise.php?ID_entreprise=' . $id_entreprise . '"><h2>' . $nom_entreprise . '</h2></a>
                    <h2>' . $lieu . '</h2>
                </div>
                <p class="text-right content-offre text-ellipsis overflow-hidden">' . $description_offre . '</p>
            </div>
        </article>';
        $articles[] = $article;
    }
    return $articles;
}

global $conn;
$conn = initbdd();

if (isset($_POST['function']) && $_POST['function'] == 'searchoffre') {
    $date = $_POST['date'];
    $nom = $_POST['nom'];
    $ordre = $_POST['ordre'];
    $print = get_offre_trifiltre(10, 1, $date, $nom, $ordre);
    $response = article($print);
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>