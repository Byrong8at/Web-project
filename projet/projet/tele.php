<?php
function traitement($img) {
    if (!empty($_FILES['image']['name'])) {

        $check = getimagesize($_FILES['image']['tmp_name']);
        if ($check !== false) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $img)) {
                
                
            } else {
                $error_message = "Une erreur est survenue lors du téléchargement de l'image.";
            }
        } else {
            $error_message = "Le fichier n'est pas une image valide.";
        }
    
}
return $img;
}

function delete_img($conn,$id_ent) {
    $sql = "SELECT logo FROM entreprise WHERE ID_entreprise = :id_ent";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_ent', $id_ent);
    $stmt->execute();
    $img = $stmt->fetchColumn();

    if (file_exists($img)) {
        unlink($img);
    }
}