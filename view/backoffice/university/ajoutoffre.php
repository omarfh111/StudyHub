<?php
require_once 'C:\xampp\htdocs\project\controller\offercontroller.php';
require_once 'C:\xampp\htdocs\project\model\produitmodel.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nomp = $_POST['nomp'];
  $quantite = $_POST['quantite'];
  $prix_p = $_POST['prix_p'];
  $reduction = $_POST['reduction'];
  $descri=$_POST['descri'];
  $types = $_POST['types'];

  // Basic validation

      $OfferController = new OfferController();
      $result = $OfferController->addproduct($nomp,$quantite,$prix_p,$reduction,$descri,$types);

      if ($result) {
          header('Location:library.php');
      } else {
          echo "<p>Failed to add user.</p>";
      }
}



  


?>
