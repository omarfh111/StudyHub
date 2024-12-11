<?php
require_once 'C:\xampp\htdocs\StudyHub\config.php';
require_once 'C:\xampp\htdocs\StudyHub\Controller\CertifController.php';
require_once 'C:\xampp\htdocs\StudyHub\Model\certif.php'; // Inclure la classe Cours si elle est définie ailleurs

$error = "";

// Instanciation du contrôleur
$CertifController = new CertifController();

// Vérifiez que l'ID est défini dans $_GET
$id_certif= $_GET['id_certif'];

// Récupérez les détails du cours par ID
$list = $CertifController->getAllCertif();
$pr = null;

foreach ($list as $row) {
    if ($row['id_certif'] == $id_certif) {
        $pr = $row;
        break;
    }
}

if ($pr === null) {
    echo "<div class='alert alert-danger'>Certification introuvable pour cet ID.</div>";
    exit;
}

// Vérifiez si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Instanciez l'objet cours avec les données soumises
        $certif = new Certif(
            //$idc,
            $_POST['detail'],
            $_POST['certif_url']
           
        );

        // Appelez la méthode de mise à jour
        $CertifController->updateCertif($certif, $id_certif);
        header("Location: listecertif.php");
        exit;
    } else {
        $error = "Des informations sont manquantes.";
    }
include 'certif.html'; 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une Certification</title>
    <!-- Liens CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f9f2f6; /* Couleur de fond rose pâle */
        }
        .card {
            border-radius: 10px;
        }
        .card-header {
            background-color: #e83e8c; /* Couleur rose pour l'entête */
            color: white;
            font-weight: bold;
        }
        .btn-primary {
            background-color: #e83e8c; /* Couleur du bouton rose */
            border-color: #e83e8c;
        }
        .btn-outline-secondary {
            border-color: #e83e8c;
            color: #e83e8c;
        }
        .btn-outline-secondary:hover {
            background-color: #e83e8c;
            color: white;
        }
        .form-group label {
            color: #6f42c1; /* Légèrement violet pour les étiquettes */
        }
        .form-control {
            border-radius: 5px;
        }
        .card-body {
            padding: 2rem;
        }
        .card-title {
            font-size: 1.5rem;
        }
    </style>
</head>
<body>
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="card" style="width: 600px; max-width: 600px;">
            <div class="card-header text-center">
                <h3 class="card-title">Modifier une Certification</h3>
            </div>
            <form action="" method="POST" class="card-body">
                <!-- Details -->
                <div class="form-group row">
                    <label class="col-md-4 col-form-label">Details de la Certification <span class="text-danger">*</span></label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="detail"  placeholder="Entrez les details" value="<?= htmlspecialchars($pr['detail']) ?>">
                    </div>
                </div>

                <!-- URL -->
                <div class="form-group row">
                    <label class="col-md-4 col-form-label">URL de la Certification <span class="text-danger">*</span></label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="certif_url" rows="3" value = "<?= htmlspecialchars($pr['certif_url']) ?>">
                    </div>
                </div>

                

                <!-- Boutons de soumission -->
                <div class="form-group row">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary">Modifier</button>
                        <button type="reset" class="btn btn-outline-secondary">Annuler</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Liens JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
