<?php
require_once  'C:\xampp\htdocs\StudyHub\config.php';
require_once  'C:\xampp\htdocs\StudyHub\Controller\CoursController.php';


$CoursController = new CoursController();
$CoursController->deleteCourse($_GET["idc"]);
header('Location: listecoursB.php');
?>
