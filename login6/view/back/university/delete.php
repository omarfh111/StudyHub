<?php
require_once    'C:\xampp\htdocs\login6\config.php';
require_once 'C:\xampp\htdocs\login6\controller\offercontroller.php';
$travelOfferC = new OfferController();
$travelOfferC->deleteOffer($_GET["idp"]);
header('Location:library.php');
?>