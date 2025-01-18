<?php
require_once '../controller/userController.php';
$userC = new usercontroller();
$userC->deleteuser($_GET["idu"]);
header('Location: http://localhost/login6/view/back/university/students.php');