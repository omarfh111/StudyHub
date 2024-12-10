<?php

require_once 'C:\xampp\htdocs\login6\config.php';
require_once 'C:\xampp\htdocs\login6\model\reclamationM.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Crée un objet Reclamation avec les données du formulaire
    $reclamation = new Reclamation();
    
    $reclamation->setNom($_POST['nom']);
    $reclamation->setPrenom($_POST['prenom']);
    $reclamation->setEmail($_POST['email']);
    $reclamation->setDate(new DateTime($_POST['date'])); 
    $reclamation->setObjet($_POST['objet']);
    $reclamation->setMessage($_POST['message']);
    
    
    $controller = new ReclamationController();
    $controller->ajouterReclamation($reclamation);
}

class ReclamationController {

    // Ajouter réclamation
    public function ajouterReclamation(Reclamation $reclamation) {
        $conn = Config::getConnexion();
    
        try {
            // Préparer la requête d'insertion dans la base de données
            $sql = "INSERT INTO reclamation (idu, nom, prenom, email, date, objet, message, `check`) 
                    VALUES (:idu, :nom, :prenom, :email, :date, :objet, :message, :check)";
            $stmt = $conn->prepare($sql);
    
            // Exécuter la requête avec les données de l'objet Reclamation
            $stmt->execute([
                ':idu' => $reclamation->getIdu(),
                ':nom' => $reclamation->getNom(),
                ':prenom' => $reclamation->getPrenom(),
                ':email' => $reclamation->getEmail(),
                ':date' => $reclamation->getDate()->format('Y-m-d H:i:s'),
                ':objet' => $reclamation->getObjet(),
                ':message' => $reclamation->getMessage(),
                ':check' => $reclamation->getCheck()
            ]);
    
            echo "Réclamation ajoutée avec succès.";
        } catch (PDOException $e) {
            echo "Erreur lors de l'ajout de la réclamation: " . $e->getMessage();
        }
    }
    


    // Récupérer toutes les réclamations
    public function getAllReclamations() {
    $db = config::getConnexion();
    $sql = "SELECT * FROM reclamation";
    try {
        $query = $db->prepare($sql);
        $query->execute();
        $reclamations = $query->fetchAll(PDO::FETCH_OBJ);  
        return $reclamations;  
    } catch (Exception $e) {
        echo 'Erreur: ' . $e->getMessage();
    }
}

    // Supprimer réclamation
    public function supprimerReclamation($id) {
        $db = config::getConnexion();
    
        try {
            // Supprimer les réponses associées
            $sqlReponses = "DELETE FROM reponse WHERE id_rec = :id";
            $queryReponses = $db->prepare($sqlReponses);
            $queryReponses->execute(['id' => $id]);
    
            $this->updateCheckReclamation($id);
            $sqlReclamation = "DELETE FROM reclamation WHERE id_rec = :id";
            $queryReclamation = $db->prepare($sqlReclamation);
            $queryReclamation->execute(['id' => $id]);
    
            echo "Réclamation et ses réponses supprimées avec succès !";
        } catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }

    // Récupérer réclamation par ID
    
public function getReclamationById($id) {
    $db = config::getConnexion();
    $sql = "SELECT * FROM reclamation WHERE id_rec = :id";
    $query = $db->prepare($sql);
    $query->execute(['id' => $id]);

    $reclamationData = $query->fetch(PDO::FETCH_ASSOC); // Utilisez FETCH_ASSOC ici

    if ($reclamationData) {
        $reclamation = new Reclamation();
        // Assigner les valeurs récupérées à l'objet Reclamation
        $reclamation->setIdRec($reclamationData['id_rec']);
        $reclamation->setNom($reclamationData['nom']);
        $reclamation->setPrenom($reclamationData['prenom']);
        $reclamation->setEmail($reclamationData['email']);
        $reclamation->setDate(new DateTime($reclamationData['date'])); // Assurez-vous que la date est bien formatée
        $reclamation->setObjet($reclamationData['objet']);
        $reclamation->setMessage($reclamationData['message']);
        $reclamation->setCheck($reclamationData['check']);

        return $reclamation;
    } else {
        return null;  
    }
}


    // Mettre à jour une réclamation
   
public function updateReclamation($reclamation, $id) {
    try {
        $db = config::getConnexion();

        $query = $db->prepare(
            'UPDATE reclamation SET 
                nom = :nom,
                prenom = :prenom,
                email = :email,
                date = :date,
                objet = :objet,
                message = :message
            WHERE id_rec = :id'
        );

        // Exécuter la requête avec les données du formulaire
        $query->execute([
            'id' => $id,
            'nom' => $reclamation->getNom(),
            'prenom' => $reclamation->getPrenom(),
            'email' => $reclamation->getEmail(),
            'date' => $reclamation->getDate()->format('Y-m-d'),
            'objet' => $reclamation->getObjet(),
            'message' => $reclamation->getMessage()
        ]);

        // Si la mise à jour est réussie, rediriger vers la page de succès
        if ($query->rowCount() > 0) {
            header("Location: app-contact.php?message=success_update");
            exit();
        } else {
            header("Location: app-contact.php?message=nochange");
            exit();
        }

    } catch (PDOException $e) {
        header("Location: app-contact.php?message=error");
        exit();
    }
}

// Récupérer la réponse par ID de réclamation
public function getReponseByReclamationId($id_rec) {
    $db = config::getConnexion();
    $sql = "SELECT * FROM reponse WHERE id_rec = :id_rec";
    $query = $db->prepare($sql);
    $query->execute(['id_rec' => $id_rec]);

    $reponse = $query->fetch(PDO::FETCH_ASSOC);
    return $reponse ? true : false;  // Retourne true si une réponse existe, sinon false
}

public function getReclamationsWithOrder($order_id = 'asc', $order_date = 'asc') {
    $db = config::getConnexion();

    // Créer la requête avec tri dynamique sur ID et Date
    $sql = "SELECT * FROM reclamation ORDER BY id_rec $order_id, date $order_date"; // Tri sur les colonnes 'id_rec' et 'date'
    
    $query = $db->prepare($sql);
    $query->execute();

    $reclamations = $query->fetchAll(PDO::FETCH_OBJ);
    
    return $reclamations;
}

public function getReclamationsWithSearch($order_id = 'asc', $order_date = 'asc', $search = '') {
    $db = config::getConnexion();
    
    // Si un terme de recherche est fourni, on modifie la requête pour inclure la recherche
    if ($search) {
        $sql = "SELECT * FROM reclamation WHERE nom LIKE :search ORDER BY id_rec $order_id, date $order_date";
        $query = $db->prepare($sql);
        $query->execute(['search' => "%$search%"]);
    } else {
        // Si aucun terme de recherche, on retourne toutes les réclamations triées
        $sql = "SELECT * FROM reclamation ORDER BY id_rec $order_id, date $order_date";
        $query = $db->prepare($sql);
        $query->execute();
    }

    $reclamations = $query->fetchAll(PDO::FETCH_OBJ);
    
    return $reclamations;
}

public function updateCheckReclamation($id_rec) {
    $db = config::getConnexion();
    
    // Vérifie si une réponse existe pour la réclamation donnée
    $sqlCheck = "SELECT COUNT(*) FROM reponse WHERE id_rec = :id_rec";
    $queryCheck = $db->prepare($sqlCheck);
    $queryCheck->execute(['id_rec' => $id_rec]);
    $hasResponse = $queryCheck->fetchColumn() > 0 ? 1 : 0;

    // Met à jour la colonne 'check' dans la table 'reclamation'
    $sqlUpdate = "UPDATE reclamation SET `check` = :hasResponse WHERE id_rec = :id_rec";
    $queryUpdate = $db->prepare($sqlUpdate);
    $queryUpdate->execute(['hasResponse' => $hasResponse, 'id_rec' => $id_rec]);
}


}
?>
