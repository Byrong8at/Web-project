<?php 
    require_once(dirname(__FILE__) .'/../controller/controller.php');
    class entreprise{
        public function get_all($conn, $id) {
            $sql = "SELECT entreprise.*
                    FROM entreprise
                    WHERE entreprise.ID_entreprise = :id";
    
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function get_offres($conn, $id) {
            $sql = "SELECT * FROM offre
                    INNER JOIN entreprise ON offre.ID_entreprise = entreprise.ID_entreprise
                    WHERE entreprise.ID_entreprise = :id";
    
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } 
    }
?>