<?php
require_once 'C:\xampp\htdocs\StudyHub\Controller\CoursController.php';
require_once 'C:\xampp\htdocs\StudyHub\config.php';

// Instanciation du contrôleur
$CoursController = new CoursController();
$certifications = $CoursController->getAllCertifications();

// Tableau pour stocker les erreurs
$errors = [];
$titre_c = $description_c = $niveau = $nombre_consultation = $duree = $contenu = $position = $id_certif = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire
    $titre_c = trim($_POST['titre_c'] ?? '');
    $description_c = trim($_POST['description_c'] ?? '');
    $niveau = trim($_POST['niveau'] ?? '');
    $nombre_consultation = trim($_POST['nombre_consultation'] ?? '');
    $duree = trim($_POST['duree'] ?? '');
    $contenu = trim($_POST['contenu'] ?? '');
    $position = trim($_POST['position'] ?? '');
    $id_certif = trim($_POST['id_certif'] ?? '');

    // Validation des données
    if (empty($titre_c)) {
        $errors['titre_c'] = "Le titre est obligatoire.";
    }
    if (empty($description_c)) {
        $errors['description_c'] = "La description est obligatoire.";
    }
    if (empty($niveau)) {
        $errors['niveau'] = "Le niveau est obligatoire.";
    }
    if (empty($duree)) {
        $errors['duree'] = "La durée est obligatoire.";
    }
    if (empty($contenu)) {
        $errors['contenu'] = "Le contenu est obligatoire.";
    }
    if (empty($position)) {
        $errors['position'] = "La position est obligatoire.";
    }
    if (empty($id_certif)) {
        $errors['id_certif'] = "Veuillez choisir une certification.";
    }

    // Si aucune erreur, ajouter le cours
    if (empty($errors)) {
        if ($CoursController->addCours($titre_c, $description_c, $niveau, $nombre_consultation, $duree, $contenu, $position, $id_certif)) {
            header("Location: listecoursB.php");
            exit();
        } else {
            $errors['general'] = "Erreur lors de l'ajout du cours.";
        }
    }
}

include 'courses.html';
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
                   <!-- Titre -->
<div class="form-group row form-section">
    <label class="col-md-4 col-form-label">Titre du Cours <span class="text-danger">*</span></label>
    <div class="col-md-8">
        <input type="text" class="form-control" id="titre_c" name="titre_c" value="<?= htmlspecialchars($titre_c) ?>" placeholder="Entrez le titre du cours">
        <?php if (isset($errors['titre_c'])): ?>
            <small class="text-danger"><?= $errors['titre_c'] ?></small>
        <?php endif; ?>
    </div>
</div>

<!-- Description -->
<div class="form-group row form-section">
    <label class="col-md-4 col-form-label">Description <span class="text-danger">*</span></label>
    <div class="col-md-8">
        <textarea class="form-control" id="description_c" name="description_c" rows="3" placeholder="Ajoutez une description"><?= htmlspecialchars($description_c) ?></textarea>
        <?php if (isset($errors['description_c'])): ?>
            <small class="text-danger"><?= $errors['description_c'] ?></small>
        <?php endif; ?>
    </div>
</div>

<!-- Niveau -->
<div class="form-group row form-section">
    <label class="col-md-4 col-form-label">Niveau <span class="text-danger">*</span></label>
    <div class="col-md-8">
        <input type="text" class="form-control" id="niveau" name="niveau" value="<?= htmlspecialchars($niveau) ?>" placeholder="Niveau requis">
        <?php if (isset($errors['niveau'])): ?>
            <small class="text-danger"><?= $errors['niveau'] ?></small>
        <?php endif; ?>
    </div>
</div>

<!-- Durée -->
<div class="form-group row form-section">
    <label class="col-md-4 col-form-label">Durée <span class="text-danger">(en heure)*</span></label>
    <div class="col-md-8">
        <input type="number" class="form-control" id="duree" name="duree" value="<?= htmlspecialchars($duree) ?>" placeholder="Durée du cours">
        <?php if (isset($errors['duree'])): ?>
            <small class="text-danger"><?= $errors['duree'] ?></small>
        <?php endif; ?>
    </div>
</div>

<!-- Contenu -->
<div class="form-group row form-section">
    <label class="col-md-4 col-form-label">Contenu</label>
    <div class="col-md-8">
        <textarea class="form-control" id="contenu" name="contenu" rows="3" placeholder="Ajoutez un contenu pour le cours"><?= htmlspecialchars($contenu) ?></textarea>
        <?php if (isset($errors['contenu'])): ?>
            <small class="text-danger"><?= $errors['contenu'] ?></small>
        <?php endif; ?>
    </div>
</div>

<!-- Position -->
<div class="form-group row form-section">
    <label class="col-md-4 col-form-label">Position</label>
    <div class="col-md-8">
        <input type="number" class="form-control" id="position" name="position" value="<?= htmlspecialchars($position) ?>" placeholder="Position du cours">
        <?php if (isset($errors['position'])): ?>
            <small class="text-danger"><?= $errors['position'] ?></small>
        <?php endif; ?>
    </div>
</div>

<!-- Certification -->
<div class="form-group row form-section">
    <label class="col-md-4 col-form-label">Détails Certif</label>
    <div class="col-md-8">
        <select class="form-control" id="id_certif" name="id_certif">
            <option value="">-- Choisissez un détail de certification --</option>
            <?php foreach ($certifications as $certif): ?>
                <option value="<?= $certif['id_certif'] ?>" <?= $id_certif == $certif['id_certif'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($certif['detail']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <?php if (isset($errors['id_certif'])): ?>
            <small class="text-danger"><?= $errors['id_certif'] ?></small>
        <?php endif; ?>
    </div>
</div>

                    <!-- Buttons -->
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label"></label>
                        <div class="col-md-8">
                            <button type="submit" class="btn btn-custom">Ajouter</button>
                            <button type="button" class="btn btn-outline-secondary" onclick="window.location.href='listecoursB.php'">Annuler</button>

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
