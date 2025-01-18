<?php
require_once 'C:\xampp\htdocs\login6\config.php';

// Initialiser $filters
$filters = [
    'nom' => '',
    'prenom' => '',
    'email' => '',
    'tel' => '',
];

// Récupérer les données GET si elles existent
if (isset($_GET['nom']) || isset($_GET['prenom']) || isset($_GET['email']) || isset($_GET['tel'])) {
    $filters['nom'] = $_GET['nom'] ?? '';
    $filters['prenom'] = $_GET['prenom'] ?? '';
    $filters['email'] = $_GET['email'] ?? '';
    $filters['tel'] = $_GET['tel'] ?? '';
}

// Appeler une fonction (fetchUsers) pour récupérer les utilisateurs
$liste = fetchUsers($filters);

function fetchUsers($filters)
{
    $db = config::getConnexion();

    // Construire la requête SQL avec des conditions dynamiques
    $conditions = [];
    $params = [];

    if (!empty($filters['nom'])) {
        $conditions[] = "nom LIKE :nom";
        $params[':nom'] = "%" . $filters['nom'] . "%";
    }

    if (!empty($filters['prenom'])) {
        $conditions[] = "prenom LIKE :prenom";
        $params[':prenom'] = "%" . $filters['prenom'] . "%";
    }

    if (!empty($filters['email'])) {
        $conditions[] = "email LIKE :email";
        $params[':email'] = "%" . $filters['email'] . "%";
    }

    if (!empty($filters['tel'])) {
        $conditions[] = "tel LIKE :tel";
        $params[':tel'] = "%" . $filters['tel'] . "%";
    }

    // Ajouter les conditions à la requête SQL
    $sql = "SELECT * FROM user";
    if (count($conditions) > 0) {
        $sql .= " WHERE " . implode(" AND ", $conditions);
    }

    try {
        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
        return [];
    }
}
?>
