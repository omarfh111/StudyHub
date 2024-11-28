<?php
// Inclure le contrôleur des cours
/*include 'C:\xampp\htdocs\StudyHub_nouv\Controller\CoursController.php';

// Instanciation du contrôleur
$CoursController = new CoursController();
$idc = $_GET["idc"] ?? null; // Récupérer l'ID du cours depuis l'URL

// Vérifier si un cours correspondant existe
$list = $CoursController->getAllCours();
$cou = null;
foreach ($list as $cours) {
    if ($cours['idc'] == $idc) {
        $cou = $cours;
        break;
    }
}

if (!$cou) {
    die("Cours introuvable."); // Message d'erreur si le cours n'existe pas
}

// Gestion du formulaire soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire
    $updcours = new cours(
        $_POST['titre_c'] ?? null,
        $_POST['description_c'] ?? null,
        $_POST['niveau'] ?? null,
        $_POST['nombre_consultation'] ?? null,
        $_POST['duree'] ?? null,
        $_POST['contenu'] ?? null,
        $_POST['position'] ?? null
    );

    // Mettre à jour le cours
    if ($CoursController->updateCours($updcours, $idc)) {
        echo "Modification effectuée avec succès.";
    } else {
        echo "Erreur lors de la mise à jour du cours.";
    }
}*/

require_once 'C:\xampp\htdocs\StudyHub_nouv\config.php';
require_once 'C:\xampp\htdocs\StudyHub_nouv\Controller\CoursController.php';
require_once 'C:\xampp\htdocs\StudyHub_nouv\Model\cours.php'; // Inclure la classe Cours si elle est définie ailleurs

$error = "";

// Instanciation du contrôleur
$CoursController = new CoursController();

// Vérifiez que l'ID est défini dans $_GET
if (isset($_GET['idc']) && !empty($_GET['idc'])) {
    $idc = (int)$_GET['idc']; // Convertir l'ID en entier
} else {
    echo "<div class='alert alert-danger'>ID manquant ou invalide.</div>";
    exit; // Arrêtez l'exécution si l'ID est manquant ou invalide
}

// Récupérez les détails du cours par ID
$list = $CoursController->getAllCours();
$pr = null;

foreach ($list as $row) {
    if ($row['idc'] == $idc) {
        $pr = $row;
        break;
    }
}

if ($pr === null) {
    echo "<div class='alert alert-danger'>Cours introuvable pour cet ID.</div>";
    exit;
}

// Vérifiez si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        isset($_POST["titre_c"]) && isset($_POST["description_c"]) &&
        isset($_POST["niveau"]) && isset($_POST["nombre_consultation"]) &&
        isset($_POST["duree"]) && isset($_POST["contenu"]) && isset($_POST["position"])
    ) {
        // Instanciez l'objet cours avec les données soumises
        $cours = new Cours(
            $_POST['titre_c'],
            $_POST['description_c'],
            $_POST['niveau'],
            $_POST['nombre_consultation'],
            $_POST['duree'],
            $_POST['contenu'],
            $_POST['position']
        );

        // Appelez la méthode de mise à jour
        $CoursController->updateCours($cours, $idc);
        header("Location: listecoursB.php");
        exit;

    } else {
        $error = "Des informations sont manquantes.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Cours</title>
    <!-- Liens CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="card" style="width: 600%; max-width: 600px;">
            <div class="card-header">
                <h3 class="card-title text-center">Modifier un Cours</h3>
            </div>
            <form action="" method="POST" class="card-body">
                <!-- Titre -->
                <div class="form-group row">
                    <label class="col-md-4 col-form-label">Titre du Cours <span class="text-danger">*</span></label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="titre_c" required placeholder="Entrez le titre" value="<?= htmlspecialchars($pr['titre_c'] ?? '') ?>">
                    </div>
                </div>

                <!-- Description -->
                <div class="form-group row">
                    <label class="col-md-4 col-form-label">Description <span class="text-danger">*</span></label>
                    <div class="col-md-8">
                        <textarea class="form-control" name="description_c" rows="3" required><?= htmlspecialchars($pr['description_c'] ?? '') ?></textarea>
                    </div>
                </div>

                <!-- Niveau -->
                <div class="form-group row">
                    <label class="col-md-4 col-form-label">Niveau <span class="text-danger">*</span></label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="niveau" required placeholder="Niveau requis" value="<?= htmlspecialchars($pr['niveau'] ?? '') ?>">
                    </div>
                </div>

                <!-- Nombre de Consultations (entre Niveau et Durée) -->
                <div class="form-group row">
                    <label class="col-md-4 col-form-label">Nombre de Consultations</label>
                    <div class="col-md-8">
                        <input type="number" class="form-control" name="nombre_consultation" value="<?= htmlspecialchars($pr['nombre_consultation'] ?? '') ?>">
                    </div>
                </div>

                <!-- Durée -->
                <div class="form-group row">
                    <label class="col-md-4 col-form-label">Durée (en mois)<span class="text-danger">*</span></label>
                    <div class="col-md-8">
                        <input type="number" class="form-control" name="duree" required placeholder="Durée en mois" value="<?= htmlspecialchars($pr['duree'] ?? '') ?>">
                    </div>
                </div>

                <!-- Contenu -->
                <div class="form-group row">
                    <label class="col-md-4 col-form-label">Contenu <span class="text-danger">*</span></label>
                    <div class="col-md-8">
                        <textarea class="form-control" name="contenu" rows="4" required><?= htmlspecialchars($pr['contenu'] ?? '') ?></textarea>
                    </div>
                </div>

                <!-- Position -->
                <div class="form-group row">
                    <label class="col-md-4 col-form-label">Position</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="position" value="<?= htmlspecialchars($pr['position'] ?? '') ?>">
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
</body>
</html>
