<?php
// Include your database connection
require_once 'C:\xampp\htdocs\login6\config.php';

try {
    // Connect to the database
    $conn = Config::getConnexion();

    // Get the user's cart quantities
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
                // Fetch product name
                $req = 'SELECT nomp FROM produit WHERE idp = :idp';
                $query = $conn->prepare($req);
                $query->execute([':idp' => $productId]);
                $res = $query->fetch();
                $productName = $res['nomp'];
                $errorMessages[] = "La quantité demandée pour le produit $productName dépasse le stock disponible.";
            }
        } else {
            $errorMessages[] = "Le produit ID <strong>$productId</strong> n'existe pas dans la base de données.";
        }
    }

    // If there are errors, display them; otherwise, proceed to cmd.php
    if (!empty($errorMessages)) {
        echo '<!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Erreur de Stock</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f9f9f9;
                    margin: 0;
                    padding: 0;
                }
                .container {
                    max-width: 600px;
                    margin: 50px auto;
                    background: white;
                    border-radius: 8px;
                    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
                    padding: 20px;
                }
                h3 {
                    color: #e74c3c;
                    text-align: center;
                }
                ul {
                    list-style-type: none;
                    padding: 0;
                }
                ul li {
                    margin: 10px 0;
                    color: #333;
                }
                a {
                    display: inline-block;
                    text-decoration: none;
                    background-color: #3498db;
                    color: white;
                    padding: 10px 15px;
                    border-radius: 5px;
                    text-align: center;
                    margin-top: 20px;
                }
                a:hover {
                    background-color: #2980b9;
                }
                .footer {
                    text-align: center;
                    margin-top: 20px;
                    color: #777;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <h3>Erreurs détectées</h3>
                <ul>';
        foreach ($errorMessages as $message) {
            echo '<li>' . htmlspecialchars($message) . '</li>';
        }
        echo '</ul>
                <a href="panier.php">Retour au panier</a>
            </div>
            <div class="footer">Merci davoir changer les informations avant de procéder.</div>
        </body>
        </html>';
    } else {
        header("Location: cmd.php");
        exit();
    }
} catch (PDOException $e) {
    echo "<p>Erreur de base de données : " . htmlspecialchars($e->getMessage()) . "</p>";
}
?>
