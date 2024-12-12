<?php
require_once 'C:/xampp/htdocs/login6/Controller/reclamationC.php';
session_start();

// Vérification que l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Utilisateur non connecté.']);
    exit();
}

$idu = $_SESSION['user_id'];
$conn = Config::getConnexion();

try {
    // Vérifier s'il y a une réclamation répondue (check=1)
    $sqlCheck = "SELECT * FROM reclamation WHERE `check` = 1 AND idu = :idu LIMIT 1";
    $stmtCheck = $conn->prepare($sqlCheck);
    $stmtCheck->execute([':idu' => $idu]);
    $reclamation = $stmtCheck->fetch(PDO::FETCH_ASSOC);

    if ($reclamation) {
        echo json_encode(['status' => 'success', 'message' => 'Nous avons repondu a votre reclamation .Regarder votre boite mail.']);
    } else {
        echo json_encode(['status' => 'none']);
    }
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Erreur : ' . $e->getMessage()]);
}

?>
