<?php
require_once  'C:\xampp\htdocs\login6\config.php';
require_once  'C:\xampp\htdocs\login6\Controller\CertifController.php';


$CertifController = new CertifController();
$CertifController->deleteCertif($_GET["id_certif"]);
header('Location: listecertif.php');
include 'certif.php'; 
?>