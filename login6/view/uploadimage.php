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

if (!isset($_GET['idu']) || empty($_GET['idu'])) {
    die("ID utilisateur manquant.");
}

$userC = new UserController();
$id = $_GET['idu'];

// Récupérez les données de l'utilisateur à partir de la liste
$liste = $userC->listuser();
$user = null;
foreach ($liste as $u) {
    if ($u['idu'] == $id) {
        $user = $u;
        break;
    }
}

if (!$user) {
    die("Utilisateur introuvable.");
}

// Vérifiez si un fichier a été téléchargé
if (isset($_FILES['pdp'])) {
    if ($_FILES['pdp']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['pdp']['tmp_name']; // Chemin temporaire du fichier
        $fileType = $_FILES['pdp']['type']; // Type de fichier

        // Validez les types de fichiers autorisés
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($fileType, $allowedTypes)) {
            try {
                // Définir le nom de l'image en utilisant l'ID de l'utilisateur
                $fileName = 'user_' . $id . '_' . basename($_FILES['pdp']['name']); // Format: user_<idu>_<nom original du fichier>
                
                // Téléchargement vers Cloudinary
                $uploadResult = (new UploadApi())->upload($fileTmpPath, [
                    'public_id' => $fileName, // Utilisez l'ID de l'utilisateur comme préfixe pour l'identifiant public de Cloudinary
                    'folder' => 'user_profiles' // Dossier dans Cloudinary
                ]);

                // URL de l'image Cloudinary
                $pdpUrl = $uploadResult['secure_url'];

                // Mettez à jour l'utilisateur dans la base de données avec l'URL de la photo de profil
                $userC->updateUserPdpUrl($id, $pdpUrl);

                header('Location: profile.php');
                exit();
            } catch (Exception $e) {
                die('Erreur lors du téléchargement vers Cloudinary : ' . $e->getMessage());
            }
        } else {
            die('Type de fichier non autorisé. Veuillez télécharger une image JPEG, PNG ou GIF.');
        }
    } else {
        die('Erreur lors du téléchargement du fichier : ' . $_FILES['pdp']['error']);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Utilisateur</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
        }
        .form-container {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }
        label {
            font-weight: bold;
        }
        input[type="file"] {
            margin: 10px 0;
        }
        button {
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 5px;
        }
        button:hover {
            background-color: #218838;
        }
        .image-preview {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .image-preview img {
            max-width: 100%;
            border-radius: 5px;
        }
    </style>
</head>
<body>
<div class="form-container">
    <form action="uploadimage.php?idu=<?php echo $_GET['idu']; ?>" method="POST" enctype="multipart/form-data"> <!-- Envoi de l'ID utilisateur via GET -->
        <label for="pdp">Choisissez une photo de profil :</label>
        <input type="file" name="pdp" id="pdp" accept="image/*" required onchange="previewFile(event)">
        <div class="image-preview" id="imagePreview"></div>
        <button type="submit">Télécharger</button>
    </form>
</div>

<script>
    function previewFile(event) {
        const file = event.target.files[0];
        const reader = new FileReader();
        reader.onload = function(e) {
            const imagePreview = document.getElementById('imagePreview');
            imagePreview.innerHTML = `<img src="${e.target.result}" alt="Image prévisualisée">`;
        };
        reader.readAsDataURL(file);
    }
</script>
</body>
</html>
