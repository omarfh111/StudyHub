<?php
require_once 'C:\xampp\htdocs\login6\config.php';
require_once 'C:\xampp\htdocs\login6\model\cartmodel.php';

class CartController
{
    private $user_id = 1;

    public function addProductToCart($idp, $quantite)
    {
        $conn = Config::getConnexion();

        $sql = "SELECT nomp, prix_p FROM produit WHERE idp = :idp AND user_id = :user_id";
        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute([':idp' => $idp, ':user_id' => $this->user_id]);
            $product = $stmt->fetch();

            if ($product) {
                $nompp = $product['nomp'];
                $price = $product['prix_p'];

                $checkSql = "SELECT idc, quantite FROM cart WHERE idp = :idp AND user_id = :user_id";
                $checkStmt = $conn->prepare($checkSql);
                $checkStmt->execute([':idp' => $idp, ':user_id' => $this->user_id]);
                $existingCartItem = $checkStmt->fetch();

                if ($existingCartItem) {
                    $newQuantity = $existingCartItem['quantite'] + $quantite;
                    $updateSql = "UPDATE cart SET quantite = :quantite WHERE idc = :idc";
                    $updateStmt = $conn->prepare($updateSql);
                    $updateStmt->execute([':quantite' => $newQuantity, ':idc' => $existingCartItem['idc']]);
                } else {
                    $insertSql = "INSERT INTO cart (idp, nomp, user_id, price, quantite) 
                                  VALUES (:idp, :nomp, :user_id, :prix_p, :quantite)";
                    $insertStmt = $conn->prepare($insertSql);
                    $insertStmt->execute([
                        ':idp' => $idp,
                        ':nomp' => $nompp,
                        ':user_id' => $this->user_id,
                        ':prix_p' => $price,
                        ':quantite' => $quantite
                    ]);
                }
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Erreur lors de l'ajout au panier: " . $e->getMessage();
            return false;
        }
    }

    // Méthode pour récupérer les produits du panier pour un utilisateur spécifique
    public function getCartItems($user_id)
    {
        // Connexion à la base de données
        $conn = Config::getConnexion();
    
        // Requête pour récupérer les produits du panier
        $sql = "SELECT c.idc, c.idp, c.nompp, c.price, c.quantite, c.statut 
                FROM cart c
                WHERE c.user_id = :user_id";
    
        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute([':user_id' => $user_id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retourne tous les produits sous forme de tableau associatif
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération des produits du panier: " . $e->getMessage();
            return [];
        }
    }
    

    // Méthode pour supprimer un produit du panier
    public function removeProductFromCart($idc, $user_id)
    {
        // Connexion à la base de données
        $conn = Config::getConnexion();
    
        // Requête pour supprimer le produit du panier
        $sql = "DELETE FROM cart WHERE idc = :idc AND user_id = :user_id";
    
        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute([':idc' => $idc, ':user_id' => $user_id]);
            return true;
        } catch (PDOException $e) {
            echo "Erreur lors de la suppression du produit du panier: " . $e->getMessage();
            return false;
        }
    }
    
}
?>
