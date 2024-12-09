<?php
// Include your database connection
require_once 'C:\xampp\htdocs\project\config.php';

try {
    // Connect to the database
    $conn = Config::getConnexion();

    // Get the user's cart quantities (you need to customize this part based on your table structure)
    $cartItems = $conn->query("SELECT idp, quantite FROM cart")->fetchAll(PDO::FETCH_ASSOC);

    // Check each cart item against the database
    $errorMessages = [];
    foreach ($cartItems as $item) {
        $productId = $item['idp'];
        $cartQuantity = $item['quantite'];

        // Fetch the available stock for the product
        $stmt = $conn->prepare("SELECT quantite FROM produit WHERE idp = :idp");
        $stmt->execute(['idp' => $productId]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($product) {
            $availableStock = $product['quantite'];
            if ($cartQuantity > $availableStock) {
                $req='select nomp from produit where idp=:idp';
                $query=$conn->prepare($req);
                $query->execute(array(':idp'=>$productId));
                $res=$query->fetch();
                $productName = $res['nomp'];
                $errorMessages[] = "La quantite demandé par le produit $productName est superieure au stock";
            }
        } else {
            $errorMessages[] = "Le produit ID $productId n'existe pas dans la base de données.";
        }
    }

    // If there are errors, display them; otherwise, proceed to cmd.php
    if (!empty($errorMessages)) {
        echo "<h3>Erreur(s) :</h3><ul>";
        foreach ($errorMessages as $message) {
            echo "<li>" . htmlspecialchars($message) . "</li>";
        }
        echo "</ul>";
        echo '<a href="panier.php">Retour au panier</a>'; // Link back to cart
    } else {
        header("Location: cmd.php");
        exit();
    }
} catch (PDOException $e) {
    echo "Erreur : " . htmlspecialchars($e->getMessage());
}
?>
