<?php
// Connexion à la base de données
require_once 'C:\xampp\htdocs\project\config.php';

if (isset($_GET['idc'])) {
    $idc = $_GET['idc'];

    // Connexion à la base de données
    $conn = Config::getConnexion();

    try {
        // Supprimer l'article du panier
        $sql = "DELETE FROM cart WHERE idc = :idc";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':idc' => $idc]);

        // Rediriger vers la page panier après suppression
        header("Location: panier.php"); // La page où vous affichez le panier
        exit();
    } catch (PDOException $e) {
        echo "Erreur lors de la suppression de l'article : " . $e->getMessage();
    }
} else {
    echo "ID de produit manquant.";
}
?>