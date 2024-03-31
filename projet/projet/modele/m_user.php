<?php 
    require_once(dirname(__FILE__) .'/../controller/controller.php');
    class user{
        public function get_all($conn, $id) {
            $sql = "SELECT utilisateur.*
                    FROM utilisateur
                    WHERE utilisateur.ID_user = :id";
    
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } 
    }
?>