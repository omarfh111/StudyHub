<?php
//ob_start(); // Commencer le tampon de sortie
require_once  'C:\xampp\htdocs\StudyHub_nouv\Controller\CoursController.php';
require_once 'C:\xampp\htdocs\StudyHub_nouv\config.php';
//include 'courses.php';//

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
//ob_end_flush(); // Terminer le tampon de sortie
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Cours</title>
    <!-- Liens CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        .card-options {
            display: flex;
            justify-content: flex-end;
        }
        .card-options a {
            margin-left: 10px;
            color: #333;
        }
        .card-title {
            font-weight: bold;
        }
        .btn {
            margin-right: 10px;
        }
    </style>
</head>
<body class="bg-light">
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="tab-pane" id="Courses-add">
            <div class="card" style="width: 600%; max-width: 600px;">
                <div class="card-header">
                    <h3 class="card-title text-center">Ajouter un Cours</h3>
                    <div class="card-options">
                        <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                        <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                    </div>
                </div>
                <form action="" method="POST" class="card-body"> <!-- action="" pour soumettre à la même page -->
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Titre du Cours <span class="text-danger">*</span></label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="titre_c" name="titre_c" required placeholder="Entrez le titre du cours">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Description <span class="text-danger">*</span></label>
                        <div class="col-md-8">
                            <textarea class="form-control" id="description_c" name="description_c" rows="3" required placeholder="Ajoutez une description"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Niveau <span class="text-danger">*</span></label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="niveau" name="niveau" required placeholder="Niveau requis">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">nombre de consultations <span class="text-danger">*</span></label>
                        <div class="col-md-8">
                            <input type="number" class="form-control" id="nombre_consultation" name="Nombre_consultation" required placeholder="nombre de consultation">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Duree<span class="text-danger">*</span></label>
                        <div class="col-md-8">
                        <input type="number" class="form-control" id="duree" name="Duree" value="0" placeholder="Duree">  
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Contenu</label>
                        <div class="col-md-8">
                        <textarea class="form-control" id="contenu" name="contenu" rows="3" required placeholder="Ajoutez un contenu"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Position</label>
                        <div class="col-md-8">
                            <input type="number" class="form-control" id="position" name="position" value="0" placeholder="position">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label"></label>
                        <div class="col-md-8">
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                            <button type="reset" class="btn btn-outline-secondary">Annuler</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Liens JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
