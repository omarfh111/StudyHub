<?php
require_once 'C:\xampp\htdocs\login6\Controller\CoursController.php';
 // Doit être en tout premier
require_once 'C:\xampp\htdocs\login6\controller\usercontroller.php';
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

$CoursController = new CoursController();
$list = $CoursController->getAllCours();
include 'courses.html'; 
?>
<div class="row">
    <div class="col-12">
        <div class="owl-slide-3 owl-carousel">
            <?php foreach ($list  as $course): ?>
                <div class="course-1-item">
                    <figure class="thumnail">
                       
                      
                        <div class="price"><?= htmlspecialchars($course['niveau']); ?></div>
                        <div class="category">
                            <h3><?= htmlspecialchars($course['titre_c']); ?></h3>
                        </div>
                    </figure>
                    <div class="course-1-content pb-4">
                       
                       
                        <ul>
                            Description : <?= htmlspecialchars($course['description_c']); ?>
                           
                        </ul>
                        <p>
                        <a href="DetailCF.php?id=<?= htmlspecialchars($course['idc'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-primary rounded-0 px-4">Voir ce cours</a>


                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
