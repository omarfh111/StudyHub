<?php
require_once 'C:\xampp\htdocs\project\controller\offercontroller.php';
$deleteoff = new offerController();
$deleteoff->deleteproduct($_POST["idp"]);
header('Location:offerList.php');
?>




