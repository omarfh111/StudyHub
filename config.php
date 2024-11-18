<?php
class Config {
    private static $pdo = null;

    public static function getConnexion() {
        if (self::$pdo === null) { // Vérifie si la connexion existe déjà
            try {
                self::$pdo = new PDO(
                    "mysql:host=localhost;dbname=studyhub;charset=utf8mb4",
                    "root", // Remplacez par votre utilisateur MySQL si différent
                    "",     // Remplacez par votre mot de passe si nécessaire
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                    ]
                );
            } catch (PDOException $e) {
                // Journalisation de l'erreur
                error_log("Erreur de connexion : " . $e->getMessage());
                die('Erreur de connexion à la base de données.');
            }
        }
        return self::$pdo;
    }
}

// Test de connexion
try {
    $db = Config::getConnexion();
    echo "Connexion réussie.";
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
