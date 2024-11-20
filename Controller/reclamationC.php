<?php
// Inclure ta classe de connexion à la base de données (config.php)
require_once 'C:\xampp\htdocs\WebProject\config.php';
require_once 'C:\xampp\htdocs\WebProject\Model\reclamationM.php'; 

// Vérifier si la méthode de la requête est POST (formulaire soumis)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Crée un objet Reclamation avec les données du formulaire
    $reclamation = new Reclamation();
    $reclamation->setNom($_POST['nom']);
    $reclamation->setPrenom($_POST['prenom']);
    $reclamation->setEmail($_POST['email']);
    $reclamation->setDate(new DateTime($_POST['date'])); // Formatage de la date
    $reclamation->setObjet($_POST['objet']);
    $reclamation->setMessage($_POST['message']);

    // Crée un objet ReclamationController et appelle la méthode pour ajouter la réclamation
    $controller = new ReclamationController();
    $controller->ajouterReclamation($reclamation);
}

class ReclamationController {

    // Fonction pour ajouter une réclamation
    public function ajouterReclamation($reclamation) {
        // Connexion à la base de données
        $db = config::getConnexion();

        // Requête SQL pour insérer une réclamation dans la base de données
        $sql = "INSERT INTO reclamation (nom, prenom, email, date, objet, message) 
                VALUES (:nom, :prenom, :email, :date, :objet, :message)";

        try {
            // Préparation et exécution de la requête avec les données du modèle
            $query = $db->prepare($sql);
            $query->execute([
                'nom' => $reclamation->getNom(),
                'prenom' => $reclamation->getPrenom(),
                'email' => $reclamation->getEmail(),
                'date' => $reclamation->getDate()->format('Y-m-d'), // Formater la date au format YYYY-MM-DD
                'objet' => $reclamation->getObjet(),
                'message' => $reclamation->getMessage()
            ]);
            echo "Réclamation envoyée avec succès!";
            //juste pour ouvrir la liste apres la supprimer
            $reclamations = $this->getAllReclamations();

        // Afficher le tableau des réclamations
        echo "<h2>Liste des Réclamations</h2>";
        echo "<table border='1'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Date</th>
                        <th>Objet</th>
                        <th>Message</th>
                    </tr>
                </thead>
                <tbody>";

        // Boucle pour afficher chaque réclamation
        foreach ($reclamations as $reclamation) {
            echo "<tr>
                    <td>{$reclamation->id_rec}</td>
                    <td>{$reclamation->nom}</td>
                    <td>{$reclamation->prenom}</td>
                    <td>{$reclamation->email}</td>
                    <td>{$reclamation->date}</td>
                    <td>{$reclamation->objet}</td>
                    <td>{$reclamation->message}</td>
                </tr>";
        }

        echo "</tbody></table>";

        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();  // Gestion des erreurs
        }
    }



    public function getAllReclamations() {
        $db = config::getConnexion();
        $sql = "SELECT * FROM reclamation";
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $reclamations = $query->fetchAll(PDO::FETCH_OBJ);  // Récupère toutes les réclamations
            return $reclamations;  // Retourne les réclamations pour les utiliser dans la vue
        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }
    
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $controller = new ReclamationController();
    $reclamations = $controller->getAllReclamations();
    // Inclure la vue pour afficher les réclamations
    include 'afficher_reclamations.php';  
}

?>
