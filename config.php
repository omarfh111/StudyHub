<?php
class config {
    private static $pdo = null;

    public static function getConnexion() {
        if (!isset(self::$pdo)) {
            try {
                self::$pdo = new PDO(
                    "mysql:host=localhost;dbname=studyhub;charset=utf8mb4",
                    "root",
                    "",
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                    ]
                );
            } catch (Exception $e) {
                error_log("Erreur de connexion : " . $e->getMessage());
                die('Erreur de connexion à la base de données.');
            }
        }
        return self::$pdo;
    }
}

// Test de connexion
try {
    $db = config::getConnexion();
    echo "Connexion réussie.";
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
}