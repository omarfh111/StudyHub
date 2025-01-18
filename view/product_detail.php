<?php
require_once 'C:\xampp\htdocs\login6\config.php'; // Include your config file

// Establish a database connection
$conn = Config::getConnexion();

if (isset($_GET['idp'])) {
    $idp = intval($_GET['idp']); // Sanitize the input to ensure it's an integer

    try {
        // Prepare the SQL query
        $query = $conn->prepare("SELECT * FROM produit WHERE idp = :idp");
        $query->bindParam(':idp', $idp, PDO::PARAM_INT);

        // Execute the query
        $query->execute();

        // Fetch the product details
        $produit = $query->fetch();

        if ($produit) {
            // Display product details
            echo "<h1>" . htmlspecialchars($produit['nomp']) . "</h1>";
             
            echo "<p>Description: " . htmlspecialchars($produit['descri']) . "</p>";
        } else {
            echo "<p>Product not found.</p>";
        }
    } catch (PDOException $e) {
        echo "<p>Error fetching product: " . $e->getMessage() . "</p>";
    }
} else {
    echo "<p>No product ID specified.</p>";
}
?>
