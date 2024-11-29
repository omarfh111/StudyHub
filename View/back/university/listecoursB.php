<?php
include 'C:\xampp\htdocs\StudyHub\Controller\CoursController.php';

include 'courses.php';
$CoursController = new CoursController();
$list = $CoursController->getAllCours();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Cours</title>
   
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome CSS (pour les icônes) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Custom styles (ajouter votre propre CSS si nécessaire) -->
    <link href="css/custom-style.css" rel="stylesheet">
</head>
<body class="bg-light">

    <!-- Page title and tab -->
    <div class="section-body">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center">
                <div class="header-action">
                    <h1 class="page-title">Liste des Cours</h1>
                    <ol class="breadcrumb page-breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Ericsson</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Liste des Cours</li>
                    </ol>
                </div>
                <!-- Export Excel Button (si nécessaire) -->
                <a href="javascript:void(0)" class="btn btn-info btn-sm">Exporter Excel</a>
            </div>
        </div>
    </div>

    <!-- Start main content -->
    <div class="section-body mt-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 d-flex justify-content-end">
                    <!-- Card container with right alignment and max width for better visibility -->
                    <div class="card" style="width: 100%; max-width: 1200px;">
                        <div class="table-responsive">
                            <!-- Titre centralisé -->
                            <h2 class="text-center mb-4">Liste des Cours</h2>
                            
                            <table class="table table-hover table-striped table-vcenter text-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th>Titre</th>
                                        <th>Description</th>
                                        <th>Niveau</th>
                                        <th>Nombre de consultations</th>
                                        <th>Durée</th>
                                        <th>Contenu</th>
                                        <th>Position</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($list)): ?>
                                       
                                        <?php foreach ($list as $course): ?>
                                            <tr>
                                            <td><?= htmlspecialchars($course['titre_c']); ?></td>
                                            <td><?= htmlspecialchars($course['description_c']); ?></td>
                                            <td><?= htmlspecialchars($course['niveau']); ?></td>
                                            <td><?= htmlspecialchars($course['nombre_consultation']); ?></td>
                                            <td><?= htmlspecialchars($course['duree']); ?> </td>
                                            <td><?= htmlspecialchars($course['contenu']); ?></td>
                                            <td><?= htmlspecialchars($course['position']); ?></td>

                                            
                                                
                                                
                                                <td>
                                                    <a href="modif.php?idc=<?=$course['idc']; ?>" class="btn btn-warning btn-sm" title="Modifier">Modifier</a>
                                                    <a href="supprimer.php?idc=<?=$course['idc']; ?>" class="btn btn-danger btn-sm" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce cours ?')">Supprimer</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="6" class="text-center">Aucun cours trouvé.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="section-body">
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        Copyright &copy; 2024 <a href="https://themeforest.net/user/puffintheme/portfolio">PuffinTheme</a>.
                    </div>
                    <div class="col-md-6 col-sm-12 text-md-right">
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item"><a href="../doc/index.html">Documentation</a></li>
                            <li class="list-inline-item"><a href="javascript:void(0)">FAQ</a></li>
                            <li class="list-inline-item"><a href="javascript:void(0)" class="btn btn-outline-primary btn-sm">Buy Now</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Required JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="js/core.js"></script>
    <script src="../assets/bundles/lib.vendor.bundle.js"></script>

</body>
</html>
