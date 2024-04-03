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
        public function get_avis($conn, $id) {
            $sql = "SELECT utilisateur.Nom, utilisateur.Prénom, avis.Note, avis.description, avis.Jour
                    FROM avis
                    JOIN utilisateur ON avis.ID_user = utilisateur.ID_user
                    JOIN offre ON avis.ID_offre = offre.ID_offre
                    JOIN entreprise ON offre.ID_entreprise = entreprise.ID_entreprise
                    WHERE entreprise.ID_entreprise = :id;";
    
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function get_avisMoyenne($conn, $id) {
            $sql = "SELECT COUNT(avis.ID_avis) AS nbavis,AVG(avis.Note) AS moyenne
                    FROM avis
                    JOIN utilisateur ON avis.ID_user = utilisateur.ID_user
                    JOIN offre ON avis.ID_offre = offre.ID_offre
                    JOIN entreprise ON offre.ID_entreprise = entreprise.ID_entreprise
                    WHERE entreprise.ID_entreprise = :id;";
    
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } 
        public function get_candidatureEntreprise($conn, $id) {
            $sql = "SELECT COUNT(DISTINCT candidature.ID_user) as nbrcandidature
                    FROM candidature
                    JOIN offre ON candidature.ID_offre = offre.ID_offre
                    JOIN entreprise ON offre.ID_entreprise = entreprise.ID_entreprise
                    WHERE entreprise.ID_entreprise = :id;";
    
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function get_wishlistEntreprise($conn, $id) {
            $sql = "SELECT COUNT(DISTINCT wishlist.ID_user) as nbrwishlist
                    FROM wishlist
                    JOIN offre ON wishlist.ID_offre = offre.ID_offre
                    JOIN entreprise ON offre.ID_entreprise = entreprise.ID_entreprise
                    WHERE entreprise.ID_entreprise = :id;";
    
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } 

        
        
    }
?>