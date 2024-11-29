<?php
require_once    'C:\xampp\htdocs\project\config.php';
require_once 'C:\xampp\htdocs\project\controller\offercontroller.php';
$travelOfferC = new OfferController();
$travelOfferC->deleteOffer($_GET["idp"]);
header('Location:library.php');
?>