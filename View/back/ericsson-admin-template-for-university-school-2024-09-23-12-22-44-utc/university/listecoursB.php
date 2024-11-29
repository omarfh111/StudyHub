<?php
include 'C:\xampp\htdocs\StudyHub\Controller\CoursController.php';

$CoursController = new CoursController();
$list = $CoursController->getAllCours();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Cours</title>
   
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Custom styles -->
    <link href="css/custom-style.css" rel="stylesheet">
    <style>
        /* Background color and main theme */
        body {
            background-color: #f8f0f6;
        }
        .btn-custom {
            background-color: #f06292; /* Pink color */
            color: white;
            transition: background-color 0.3s ease;
        }
        .btn-custom:hover {
            background-color: #d81b60; /* Darker pink for hover effect */
        }
        .table-primary {
            background-color: #f8d9e5;
        }
        .table-responsive {
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        }
        .card {
            border-radius: 12px;
        }
        .card-header {
            background-color: #f06292;
            color: white;
            font-weight: bold;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }
        .footer {
            background-color: #f8f0f6;
            border-top: 1px solid #ddd;
        }
        .footer .text-muted {
            color: #f06292;
        }
        h1.page-title {
            color: #d81b60;
        }
        .breadcrumb-item a {
            color: #d81b60;
        }
        .breadcrumb-item.active {
            color: #9c4d75;
        }
        /* Input search */
        .form-control {
            border-radius: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

    <!-- Page title and tab -->
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="w-100 text-center"> <!-- Ajout de la classe 'w-100 text-center' pour centrer le titre -->
                <h1 class="page-title">Liste des Cours</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Ericsson</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Liste des Cours</li>
                </ol>
            </div>
            <a href="javascript:void(0)" class="btn btn-outline-custom"><i class="fas fa-file-excel"></i> Exporter Excel</a>
        </div>
    </div>

    <!-- Start main content -->
    <div class="container">
        <div class="card shadow-lg">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h2 class="mb-0">Liste des Cours</h2>
                <input type="text" class="form-control w-25" placeholder="Rechercher un cours..." id="searchInput">
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middle">
                        <thead class="table-primary">
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
                        <tbody id="courseTable">
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
                                            <a href="modif.php?idc=<?= $course['idc']; ?>" class="btn btn-warning btn-sm" title="Modifier">
                                                <i class="fas fa-edit"></i> Modifier
                                            </a>
                                            <a href="supprimer.php?idc=<?= $course['idc']; ?>" 
                                               class="btn btn-danger btn-sm" 
                                               title="Supprimer" 
                                               onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce cours ?')">
                                                <i class="fas fa-trash"></i> Supprimer
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8" class="text-center text-muted">Aucun cours trouvé.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer mt-5 py-3">
        <div class="container text-center">
            <small class="text-muted">
                &copy; 2024 <a href="https://themeforest.net/user/puffintheme/portfolio" class="text-decoration-none">PuffinTheme</a>. Tous droits réservés.
            </small>
        </div>
    </footer>

    <!-- Required JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Recherche dans le tableau
        const searchInput = document.getElementById('searchInput');
        const courseTable = document.getElementById('courseTable');

        searchInput.addEventListener('keyup', function () {
            const filter = searchInput.value.toLowerCase();
            const rows = courseTable.getElementsByTagName('tr');
            
            for (const row of rows) {
                const cells = row.getElementsByTagName('td');
                const match = Array.from(cells).some(cell => cell.textContent.toLowerCase().includes(filter));
                row.style.display = match ? '' : 'none';
            }
        });
    </script>
</body>
</html>
