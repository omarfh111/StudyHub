<?php
require_once  'C:\xampp\htdocs\StudyHub\Controller\CertifController.php';
require_once 'C:\xampp\htdocs\StudyHub\config.php';

// Instanciation du contrôleur
//$CoursController = new CoursController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire
    $detail =trim ($_POST['detail'] ?? '');
    $certif_url =trim ($_POST['certif_url'] ?? '');
    
    $CertifController = new CertifController();
    // Validation des données (exemple simple)
    if (!empty($detail) && !empty($certif_url) ) {
        // Appeler le contrôleur pour ajouter la certification
        if ($CertifController->addCertif($detail, $certif_url)) {
            header("Location: listecertif.php");
            exit();
        } else {
            echo "Erreur lors de l'ajout de la certification.";
        }
    } else {
        echo "Tous les champs marqués d'un * sont obligatoires.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Certification</title>
    <!-- Liens CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        /* Styles généraux pour le formulaire */
        body {
            background-color: #f8f0f6; /* Fond rose doux */
        }
        .card {
            border-radius: 12px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #f06292; /* Couleur rose pour l'entête */
            color: white;
            font-weight: bold;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }
        .btn-custom {
            background-color: #f06292;
            color: white;
            border-radius: 20px;
            transition: background-color 0.3s ease;
        }
        .btn-custom:hover {
            background-color: #d81b60;
        }
        .form-control {
            border-radius: 20px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }
        .form-group label {
            font-weight: bold;
            color: #9c4d75;
        }
        .footer {
            background-color: #f8f0f6;
            padding: 20px 0;
            border-top: 1px solid #ddd;
            text-align: center;
        }
        .footer a {
            color: #f06292;
            text-decoration: none;
        }
        .footer a:hover {
            color: #d81b60;
        }
        /* Style spécifique pour la mise en page du formulaire */
        .form-section {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="tab-pane" id="Courses-add">
            <div class="card" style="max-width: 600px; width: 100%;">
                <div class="card-header text-center">
                    <h3 class="card-title">Ajouter une Certification</h3>
                </div>
                <form action="" method="POST" class="card-body">
                    <!-- Details -->
                    <div class="form-group row form-section">
                        <label class="col-md-4 col-form-label">Details de la certification <span class="text-danger">*</span></label>
                        <div class="col-md-8">
                            <textarea class="form-control" id="detail" name="detail" rows="3"  placeholder="Entrez les details de la certification"></textarea>
                        </div>
                    </div>
                    <!-- URL -->
                    <div class="form-group row form-section">
                        <label class="col-md-4 col-form-label">URL de la certification <span class="text-danger">*</span></label>
                        <div class="col-md-8">
                            <textarea class="form-control" id="certif_url" name="certif_url" rows="3"  placeholder="Ajoutez l'URL de la certification"></textarea>
                        </div>
                    </div>
                  
                    <!-- Buttons -->
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label"></label>
                        <div class="col-md-8">
                            <button type="submit" class="btn btn-custom">Ajouter</button>
                            <button type="reset" class="btn btn-outline-secondary">Annuler</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2024 <a href="https://themeforest.net/user/puffintheme/portfolio">PuffinTheme</a></p>
    </footer>

    <!-- Liens JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
