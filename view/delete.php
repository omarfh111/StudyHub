<?php

// Connexion à la base de données
require_once 'C:\xampp\htdocs\project\config.php';

try {
    // Connexion à la base de données
    $conn = Config::getConnexion();

    // Supprimer tous les articles du panier
    $sql = "DELETE FROM cart";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // Rediriger vers la page panier après suppression
    header("Location: panier.php"); // Change "panier.php" to your actual cart page.
    exit();
} catch (PDOException $e) {
    // Afficher un message d'erreur en cas d'échec
    echo "Erreur lors de la suppression des articles du panier : " . htmlspecialchars($e->getMessage());
}
?>

