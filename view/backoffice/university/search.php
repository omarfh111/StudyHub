<?php
// Include the configuration file
require_once 'C:\xampp\htdocs\project\config.php'; // Adjust the path based on your directory structure

try {
    // Get the PDO connection
    $pdo = config::getConnexion();

    // Check if the search term is set
    if (isset($_GET['search'])) {
        $searchTerm = htmlspecialchars($_GET['search']); // Sanitize input

        // Prepare and execute the query
        $query = $pdo->prepare("SELECT nomp, prix_p, quantite , types FROM produit WHERE nomp LIKE :searchTerm");
        $query->execute(['searchTerm' => '%' . $searchTerm . '%']);

        // Fetch results
        $results = $query->fetchAll();

        // Display results
        if ($results) {
            echo "<h3>Search Results for: " . htmlspecialchars($searchTerm) . "</h3>";
            echo "<ul>";
            foreach ($results as $row) {
                echo "<li>" . htmlspecialchars($row['nomp']) . "</li>";
            }
            echo "</ul>";
        } else {
            echo "<h3>No results found for: " . htmlspecialchars($searchTerm) . "</h3>";
        }
    }
} catch (Exception $e) {
    // Handle errors
    echo "Error: " . $e->getMessage();
}
?>
