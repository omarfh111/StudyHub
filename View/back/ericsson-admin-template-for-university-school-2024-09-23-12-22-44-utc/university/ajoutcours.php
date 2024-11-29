<?php
require_once  'C:\xampp\htdocs\StudyHub\Controller\CoursController.php';
require_once 'C:\xampp\htdocs\StudyHub\config.php';

// Instanciation du contrôleur
$CoursController = new CoursController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire
    $titre_c = $_POST['titre_c'] ?? null;
    $description_c = $_POST['description_c'] ?? null;
    $niveau = $_POST['niveau'] ?? null;
    $nombre_consultation = $_POST['nombre_consultation'] ?? null;
    $duree = $_POST['duree'] ?? null;
    $contenu = $_POST['contenu'] ?? null;
    $position = $_POST['position'] ?? null;

    // Validation des données (exemple simple)
    if ($titre_c && $description_c && $niveau && $duree && $contenu && $position) {
        if ($CoursController->addCourse($titre_c, $description_c, $niveau, $nombre_consultation, $duree, $contenu, $position)) {
            // Redirection vers la page liste des cours
            header("Location: listecoursB.php");
            exit(); // Arrête l'exécution après la redirection
        } else {
            echo "Erreur lors de l'ajout du cours.";
        }
    } else {
        echo "Veuillez remplir tous les champs obligatoires.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Cours</title>
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
                    <h3 class="card-title">Ajouter un Cours</h3>
                </div>
                <form action="" method="POST" class="card-body">
                    <!-- Titre -->
                    <div class="form-group row form-section">
                        <label class="col-md-4 col-form-label">Titre du Cours <span class="text-danger">*</span></label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="titre_c" name="titre_c" required placeholder="Entrez le titre du cours">
                        </div>
                    </div>
                    <!-- Description -->
                    <div class="form-group row form-section">
                        <label class="col-md-4 col-form-label">Description <span class="text-danger">*</span></label>
                        <div class="col-md-8">
                            <textarea class="form-control" id="description_c" name="description_c" rows="3" required placeholder="Ajoutez une description"></textarea>
                        </div>
                    </div>
                    <!-- Niveau -->
                    <div class="form-group row form-section">
                        <label class="col-md-4 col-form-label">Niveau <span class="text-danger">*</span></label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="niveau" name="niveau" required placeholder="Niveau requis">
                        </div>
                    </div>
                    <!-- Nombre de consultations -->
                    <div class="form-group row form-section">
                        <label class="col-md-4 col-form-label">Nombre de consultations <span class="text-danger">*</span></label>
                        <div class="col-md-8">
                            <input type="number" class="form-control" id="nombre_consultation" name="nombre_consultation" required placeholder="Nombre de consultations">
                        </div>
                    </div>
                    <!-- Durée -->
                    <div class="form-group row form-section">
                        <label class="col-md-4 col-form-label">Durée <span class="text-danger">*</span></label>
                        <div class="col-md-8">
                            <input type="number" class="form-control" id="duree" name="duree" value="0" required placeholder="Durée du cours">
                        </div>
                    </div>
                    <!-- Contenu -->
                    <div class="form-group row form-section">
                        <label class="col-md-4 col-form-label">Contenu</label>
                        <div class="col-md-8">
                            <textarea class="form-control" id="contenu" name="contenu" rows="3" required placeholder="Ajoutez un contenu pour le cours"></textarea>
                        </div>
                    </div>
                    <!-- Position -->
                    <div class="form-group row form-section">
                        <label class="col-md-4 col-form-label">Position</label>
                        <div class="col-md-8">
                            <input type="number" class="form-control" id="position" name="position" value="0" required placeholder="Position du cours">
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
