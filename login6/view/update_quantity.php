<?php
// Connexion à la base de données
require_once 'C:\xampp\htdocs\login6\config.php';

// Vérifier que les données ont été envoyées via POST
if (isset($_POST['idc']) && isset($_POST['quantite'])) {
    $idc = $_POST['idc'];  // ID de l'élément du panier
    $quantite = $_POST['quantite'];  // Nouvelle quantité

    // Connexion à la base de données
    $conn = Config::getConnexion();

    // Assurez-vous que la quantité est un nombre entier et positif
    if ($quantite > 0) {
        try {
            // Préparer la requête pour mettre à jour la quantité
            $sql = "UPDATE cart SET quantite = :quantite WHERE idc = :idc";
            $stmt = $conn->prepare($sql);
            $stmt->execute([':quantite' => $quantite, ':idc' => $idc]);

            // Retourner un message de succès
            
            header("Location: panier.php"); // La page où vous affichez le panier
        exit();
        } catch (PDOException $e) {
            // Si une erreur survient lors de la mise à jour
            echo "Erreur lors de la mise à jour de la quantité : " . $e->getMessage();
        }
    } else {
        echo "La quantité doit être supérieure à 0.";
    }
} else {
    echo "ID ou quantité manquante.";
}
?>