<?php
// Connexion à la base de données
require_once 'C:\xampp\htdocs\project\config.php';

// Récupérer les données envoyées par AJAX
$idp = $_POST['idp'];
$nomp = $_POST['nomp'];
$price = $_POST['price'];
$quantite = $_POST['quantite'];

// Connexion à la base de données
$conn = Config::getConnexion();

try {
    // Préparer la requête d'insertion dans le panier
    $sql = "INSERT INTO cart (idp, nompp, price, quantite) 
            VALUES (:idp, :nompp, :price, :quantite)";
    $stmt = $conn->prepare($sql);
    
    // Exécuter la requête avec les données du produit
    $stmt->execute([
        ':idp' => $idp,
        ':nompp' => $nomp,
        ':price' => $price,
        ':quantite' => $quantite
    ]);

    // Retourner une réponse pour indiquer que l'ajout a réussi
    
} catch (PDOException $e) {
    // En cas d'erreur, afficher l'erreur
    echo "Erreur lors de l'ajout au panier : " . $e->getMessage();
}
?>