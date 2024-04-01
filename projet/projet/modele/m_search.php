<?php
require_once(dirname(__FILE__) .'/../controller/controller.php');
class search{
    function getall($search_term, $conn) {
        $sql = "SELECT 'offre' as category, ID_offre as ID, Nom, '' as Prénom
                FROM offre
                WHERE Nom LIKE :search_term AND Voir=1
                UNION ALL
                SELECT 'entreprise' as category, ID_entreprise as ID, Nom, '' as Prénom
                FROM entreprise
                WHERE Nom LIKE :search_term AND Voir=1
                UNION ALL
                SELECT 'utilisateur' as category, ID_user as ID, Nom, Prénom
                FROM utilisateur
                WHERE Nom LIKE :search_term OR Prénom LIKE :search_term
                LIMIT 3";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':search_term', '%' . $search_term . '%', PDO::PARAM_STR);
        $stmt->execute();
        if ($stmt->errorCode() != PDO::ERR_NONE) {
            $info = $stmt->errorInfo();
            var_dump($info);
        }
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }
    function Filtre_Tri(){}
}