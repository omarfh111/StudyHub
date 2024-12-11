<?php
require_once 'C:\xampp\htdocs\StudyHub\config.php';
require_once 'C:\xampp\htdocs\StudyHub\Controller\CoursController.php';

$CoursController = new CoursController();
$CoursController->deleteCourse($_GET["idc"]);

// Redirection vers la liste des cours
header('Location: listecoursB.php');
exit; // Ajout d'un exit pour stopper l'exécution après la redirection
?>
