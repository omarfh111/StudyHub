<?php
require_once  'C:\xampp\htdocs\StudyHub\config.php';
require_once  'C:\xampp\htdocs\StudyHub\Controller\CertifController.php';


$CertifController = new CertifController();
$CertifController->deleteCertif($_GET["id_certif"]);
header('Location: listecertif.php');
?>