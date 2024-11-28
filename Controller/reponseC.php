<?php

require_once 'C:\xampp\htdocs\WebProject\config.php';
require_once 'C:\xampp\htdocs\WebProject\Model\reclamationM.php';


class ReponseC {

    // 1. Ajouter une réponse
    public function ajouterReponse($id_rec, $contenu) {
        try {
            $pdo = config::getConnexion();
            $stmt = $pdo->prepare(
                "INSERT INTO reponse (id_rec, contenu, date_reponse) 
                 VALUES (:id_rec, :contenu, :date_reponse)"
            );
            $stmt->execute([
                'id_rec' => $id_rec,
                'contenu' => $contenu,
                'date_reponse' => date('Y-m-d H:i:s')
            ]);
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    // 2. Afficher toutes les réponses d'une réclamation
    public function afficherToutesReponses() {
            try {
                $pdo = config::getConnexion();
                $stmt = $pdo->query("SELECT * FROM reponse");
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $e) {
                die('Erreur: ' . $e->getMessage());
            }
        }

    // 3. Récupérer une réponse spécifique
    public function recupererReponse($id_rsp) {
    try {
        $pdo = config::getConnexion();
        $sql = "SELECT * FROM reponse WHERE id_rsp = :id_rsp";
        $query = $pdo->prepare($sql);
        $query->bindParam(':id_rsp', $id_rsp, PDO::PARAM_INT);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC); // Renvoie un tableau associatif
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

    // Mettre à jour une réponse
    public function modifierReponse($id_rsp, $nouveauContenu) {
        try {
            
            $pdo = config::getConnexion();
            $stmt = $pdo->prepare("UPDATE reponse SET reponse = :reponse WHERE id_rsp = :id_rsp");  
            
            $stmt->bindParam(':id_rsp', $id_rsp, PDO::PARAM_INT);  
            $stmt->bindParam(':reponse', $nouveauContenu, PDO::PARAM_STR);  
    
            
            $stmt->execute();  
    
            return true;  
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
    
    

    // 5. Supprimer une réponse
    public function supprimerReponse($id_rsp) {
        try {
            $pdo = config::getConnexion();
            $stmt = $pdo->prepare("DELETE FROM reponse WHERE id_rsp = :id_rsp");
            $stmt->execute(['id_rsp' => $id_rsp]);
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    public function recupererReponseParReclamation($id_rec) {
        try {
            $pdo = config::getConnexion();
            $stmt = $pdo->prepare("SELECT * FROM reponse WHERE id_rec = :id_rec");
            $stmt->execute(['id_rec' => $id_rec]);
            $reponse = $stmt->fetch(PDO::FETCH_ASSOC);
            return $reponse ?: null; 
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    //6 Fonction qui retourne le nombre de réponses pour une réclamation spécifique
    public function compterToutesReponses() {
        
        $db = config::getConnexion();
        $sql = "SELECT COUNT(*) FROM reponse";
        $query = $db->prepare($sql);
        
        
        $query->execute();
        
        
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result['COUNT(*)'];
    }
    
    
    

}




?>

    