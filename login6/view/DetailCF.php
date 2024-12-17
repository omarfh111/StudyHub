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
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="css/aos.css">
    <link href="css/jquery.mb.YTPlayer.min.css" media="all" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

<div class="site-wrap">

 


    <div class="custom-breadcrumns border-bottom">
        <div class="container">
            <a href="index.html">Home</a>
            <span class="mx-3 icon-keyboard_arrow_right"></span>
            <a href="courses.html">Courses</a>
            <span class="mx-3 icon-keyboard_arrow_right"></span>
            <span class="current"><?= htmlspecialchars($cours['titre_c']); ?></span>
        </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <p>
                        <img src="images/course_5.jpg" alt="Image" class="img-fluid">
                    </p>
                </div>
                <div class="col-lg-5 ml-auto align-self-center">
                    <h2 class="section-title-underline mb-5">
                        <span>Course Details</span>
                    </h2>

                    <p><strong class="text-black d-block">Title:</strong> <?= htmlspecialchars($cours['titre_c']); ?></p>
                    <p><strong class="text-black d-block">Description:</strong> <?= htmlspecialchars($cours['description_c']); ?></p>
                    <p><strong class="text-black d-block">Level:</strong> <?= htmlspecialchars($cours['niveau']); ?></p>
                    <p><strong class="text-black d-block">Views:</strong> <?= htmlspecialchars($cours['nombre_consultation']); ?></p>
                    <p><strong class="text-black d-block">Duration:</strong> <?= htmlspecialchars($cours['duree']); ?> hours</p>
                   
                    <p><strong class="text-black d-block">Position:</strong> <?= htmlspecialchars($cours['position']); ?></p>
                    <p><strong class="text-black d-block">Certificate:</strong> 
                        <?= isset($cours['id_certif']) ? htmlspecialchars($cours['id_certif']) : "No certificate available"; ?>
                    </p>

                    <p>
                    <a href="Contenu.php?id=<?= htmlspecialchars($cours['idc'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-secondary rounded-0 btn-lg px-5">Enroll To This Course</a>

                      
                     
                    </p>

                    <p>
                    <a href="courses.html" class="btn btn-secondary rounded-0 btn-lg px-5">Back to Courses</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

   
</div>



<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/jquery-migrate-3.0.1.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.stellar.min.js"></script>
<script src="js/jquery.countdown.min.js"></script>
<script src="js/bootstrap-datepicker.min.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/aos.js"></script>
<script src="js/jquery.fancybox.min.js"></script>
<script src="js/jquery.sticky.js"></script>
<script src="js/jquery.mb.YTPlayer.min.js"></script>
<script src="js/main.js"></script>

</body>
</html>
