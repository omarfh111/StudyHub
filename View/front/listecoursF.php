<?php
require_once 'C:\xampp\htdocs\StudyHub\Controller\CoursController.php';
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
