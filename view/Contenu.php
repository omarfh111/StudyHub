<?php
require_once 'C:\xampp\htdocs\login6\Controller\CoursController.php';
session_start();
if (isset($_COOKIE['studyhub'])) {
    // Décoder les données du cookie
    $userData = json_decode($_COOKIE['studyhub'], true);

    $email = $userData['email'];
    $nom = $userData['nom'];
    $role = $userData['role'];
} else {
    header('Location: /login6/view/login.php');
    exit();
}
$coursController = new CoursController();

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int) $_GET['id']; // Assure que l'ID est un entier
    $cours = $coursController->getCoursById($id);

    if ($cours === null) {
        echo "<p>Aucun cours trouvé pour l'ID : " . htmlspecialchars($id) . ".</p>";
        exit;
    }
} else {
    echo "<p>Paramètre 'id' invalide ou manquant.</p>";
    exit;
}
include 'courses.html'; 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Course Details - <?= htmlspecialchars($cours['titre_c']); ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700,900" rel="stylesheet">
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .content-section {
            height: 100vh;
            overflow-y: scroll;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            padding: 20px;
            background-color: #f8f9fa; /* Light background to match the design */
        }
        .course-header {
            background-color: #51be78;
            padding: 50px 0;
            color: #fff;
            text-align: center;
        }
        .course-header h1 {
            font-size: 36px;
        }
        .course-description {
            background-color: #ffffff;
            padding: 30px;
            margin-bottom: 30px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .course-title {
            font-size: 24px;
            margin-bottom: 15px;
            color: #51be78; /* Couleur identique à celle de l'en-tête */
            font-weight: 700; /* Rendre le texte en gras */
            border-bottom: 2px solid #51be78; /* Ligne en bas du titre pour le mettre en valeur */
            padding-bottom: 10px;
        }

        .course-content {
            margin-bottom: 20px;
        }
        .cert-button {
            margin-top: 30px;
            text-align: center;
        }
    </style>
</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

    <div class="site-wrap">

        <!-- Site Navbar -->
        <header class="site-navbar py-4 js-sticky-header site-navbar-target" role="banner">
            <!-- Navbar content here (same as in your template) -->
        </header>

        <!-- Course Header -->
        <div class="course-header">
            <div class="container">
                <h1>Course Details: <?= htmlspecialchars($cours['titre_c']); ?></h1>
            </div>
        </div>

        <!-- Course Description -->
        <div class="container course-description">
            <div class="row">
                <div class="col-lg-12">
                    <div id="section1" class="content-section">
                        <h2 class="course-title">Part 1</h2>
                        <p><?= nl2br(htmlspecialchars(substr($cours['contenu'], 0, floor(strlen($cours['contenu']) / 3)))); ?></p>
                    </div>

                    <div id="section2" class="content-section">
                        <h2 class="course-title">Part 2</h2>
                        <p><?= nl2br(htmlspecialchars(substr($cours['contenu'], floor(strlen($cours['contenu']) / 3), floor(strlen($cours['contenu']) / 3)))); ?></p>
                    </div>

                    <div id="section3" class="content-section">
                        <h2 class="course-title">Part 3</h2>
                        <p><?= nl2br(htmlspecialchars(substr($cours['contenu'], 2 * floor(strlen($cours['contenu']) / 3)))); ?></p>
                    </div>

                    <!-- Certificate Button -->
                    <div id="cert-button" class="cert-button" style="display: none;">
                        <a href="download_cert.php?id=<?= $id; ?>" class="btn btn-success px-4 py-2 rounded-0">Download Certificate</a>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        // Function to check if a section is fully scrolled
        function isSectionScrolled(sectionId) {
            const section = document.getElementById(sectionId);
            return section.scrollHeight <= section.scrollTop + section.clientHeight;
        }

        // Function to check all sections and display the download button if all are scrolled
        function checkScroll() {
            const sections = ['section1', 'section2', 'section3'];
            let allScrolled = true;

            // Check each section
            sections.forEach(sectionId => {
                if (!isSectionScrolled(sectionId)) {
                    allScrolled = false;
                }
            });

            // Show or hide the download button based on scroll status and time spent
            if (allScrolled && timeSpent >= 30) {
                document.getElementById('cert-button').style.display = 'block'; // Show the button
            } else {
                document.getElementById('cert-button').style.display = 'none'; // Hide the button
            }
        }

        // Timer to track the time spent on the page
        let timeSpent = 0;
        const timer = setInterval(() => {
            timeSpent += 1;
            // Check scroll status every second
            checkScroll();
        }, 1000);

        // Event listeners for scroll on each section
        document.getElementById('section1').addEventListener('scroll', checkScroll);
        document.getElementById('section2').addEventListener('scroll', checkScroll);
        document.getElementById('section3').addEventListener('scroll', checkScroll);
    </script>

</body>
</html>
