<?php
// Connexion à la base de données
require_once 'C:\xampp\htdocs\login6\config.php';
require_once 'C:\xampp\htdocs\login6\controller\CartController.php';
require_once 'C:\xampp\htdocs\login6\controller\usercontroller.php';
session_start();

if (isset($_COOKIE['studyhub'])) {
  // Décoder les données du cookie
  $userData = json_decode($_COOKIE['studyhub'], true);

  $email = $userData['email'];
  $nom = $userData['nom'];
  $role = $userData['role'];

} else {
  header('Location: login.php');
  exit();
}
if (!isset($_SESSION['user_id'])) {
  die('Erreur : utilisateur non connecté.');
}

$idu = $_SESSION['user_id']; // Récupérer l'ID utilisateur depuis la session
$userController = new UserController();

// Récupérer les informations de l'utilisateur connecté
$user = $userController->getUserById($idu);

// Récupérer les données envoyées par AJAX
$idp = $_POST['idp'];
$nomp = $_POST['nomp'];
$user_id =$idu;
$price = $_POST['price'];
$quantite = $_POST['quantite'];

// Connexion à la base de données
$conn = Config::getConnexion();

try {
    // Préparer la requête d'insertion dans le panier
    $sql = "INSERT INTO cart (idp, nompp,user_id, price, quantite) 
            VALUES (:idp, :nompp,:user_id ,:price, :quantite)";
    $stmt = $conn->prepare($sql);
    
    // Exécuter la requête avec les données du produit
    $stmt->execute([
        ':idp' => $idp,
        ':nompp' => $nomp,
        ':user_id' => $user_id,
        ':price' => $price,
        ':quantite' => $quantite
    ]);

    // Retourner une réponse pour indiquer que l'ajout a réussi
    
} catch (PDOException $e) {
    // En cas d'erreur, afficher l'erreur
    echo "Erreur lors de l'ajout au panier : " . $e->getMessage();
}
?>