<?php
require_once  'C:\xampp\htdocs\StudyHub_nouv\config.php';
require_once  'C:\xampp\htdocs\StudyHub_nouv\Controller\CoursController.php';


$CoursController = new CoursController();
$CoursController->deleteCourse($_GET["idc"]);
header('Location: listecoursB.php');
?>
