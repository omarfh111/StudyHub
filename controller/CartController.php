<?php
require_once 'C:\xampp\htdocs\project\config.php';
require_once 'C:\xampp\htdocs\project\model\cartmodel.php';

class CartController
{
    // Méthode pour ajouter un produit au panier
    public function addProductToCart($idp, $email, $quantite)
    {
        // Connexion à la base de données
        $conn = Config::getConnexion();

        // Récupérer les détails du produit
        $sql = "SELECT nomp, prix_p FROM produit WHERE idp = :idp";
        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute([':idp' => $idp]);
            $product = $stmt->fetch();

            if ($product) {
                $nompp = $product['nomp'];
                $price = $product['prix_p'];

                // Ajouter le produit au panier
                $cart = new CartModel($idp, $nompp,  $price, $quantite);
                return $cart->save();
            } else {
                return false; // Produit non trouvé
            }
        } catch (PDOException $e) {
            echo "Erreur lors de l'ajout au panier: " . $e->getMessage();
            return false;
        }
    }


    // Get all cart items with product details
 
}