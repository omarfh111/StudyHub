<?php
class Config {
    private static $pdo = null;

    public static function getConnexion() {
        if (self::$pdo === null) {
            try {
                self::$pdo = new PDO(
                    "mysql:host=localhost;dbname=studyhub;charset=utf8mb4", // Database connection string
                    "root", // Your database username
                    "", // Your database password
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Throw exceptions on errors
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // Fetch mode as associative array
                    ]
                );
            } catch (PDOException $e) {
                die('Database connection error: ' . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}
?>