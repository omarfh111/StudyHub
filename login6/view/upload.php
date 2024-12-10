<?php
require_once 'C:\xampp\htdocs\login6\config.php'; 
require_once '../controller/UserController.php';
require 'C:\xampp\htdocs\login6\vendor/autoload.php'; // Charger l'autoloader de Cloudinary
use Cloudinary\Cloudinary;
use Cloudinary\Configuration\Configuration;
use Cloudinary\Api\Upload\UploadApi;

// Configuration de Cloudinary
Configuration::instance([
    'cloud' => [
        'cloud_name' => 'dcvbqvdyx', // Remplacez par votre cloud_name
        'api_key' => '868728732994956', // Remplacez par votre api_key
        'api_secret' => 'bHfv4HA9o50pZ-jAI88dv6RgHJg' // Remplacez par votre api_secret
    ]
]);

// Vérifiez si un fichier a été téléchargé
if (isset($_FILES['pdp'])) {
    if ($_FILES['pdp']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['pdp']['tmp_name']; // Chemin temporaire du fichier
        $fileType = $_FILES['pdp']['type']; // Type de fichier

        // Validez les types de fichiers autorisés
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($fileType, $allowedTypes)) {
            try {
                // Téléchargement vers Cloudinary
                $uploadResult = (new UploadApi())->upload($fileTmpPath, [
                    'folder' => 'user_profiles' // Dossier dans Cloudinary
                ]);

                // URL de l'image Cloudinary
                $pdpUrl = $uploadResult['secure_url'];

                // Récupération de l'ID de l'utilisateur
                $userId = $_POST['user_id'];

                // Mettez à jour l'utilisateur dans la base de données
                $userController = new UserController();
                $userController->updateUserPdpUrl($userId, $pdpUrl);

                //echo json_encode(['message' => 'Image téléchargée et utilisateur mis à jour avec succès.', 'secure_url' => $pdpUrl]);
            } catch (Exception $e) {
                die('Erreur lors du téléchargement vers Cloudinary : ' . $e->getMessage());
            }
        } else {
            die('Type de fichier non autorisé. Veuillez télécharger une image JPEG, PNG ou GIF.');
        }
    } else {
        die('Erreur lors du téléchargement du fichier : ' . $_FILES['pdp']['error']);
    }
} else {
    die('Aucun fichier reçu.');
}
