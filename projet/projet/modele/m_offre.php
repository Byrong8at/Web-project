<?php 
    require_once(dirname(__FILE__) .'/../controller/controller.php');
    class offre{
        public function get_all($conn, $id) {
            $sql = "SELECT offre.*
                    FROM offre
                    WHERE offre.ID_offre = :id";
    
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    
        public function get_nomEntreprise($conn, $id){
            $sql = "SELECT entreprise.Nom
                    FROM entreprise
                    INNER JOIN offre ON entreprise.ID_entreprise = offre.ID_entreprise
                    WHERE offre.ID_offre = :id";
    
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchColumn();
        }

    }
?>