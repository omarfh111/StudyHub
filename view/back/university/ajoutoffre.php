<?php
require_once 'C:\xampp\htdocs\login6\controller\offercontroller.php';
require_once 'C:\xampp\htdocs\login6\model\produitmodel.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nomp = $_POST['nomp'];
  $quantite = $_POST['quantite'];
  $prix_p = $_POST['prix_p'];
  $fin_prix = $_POST['fin_prix'];
  $descri=$_POST['descri'];
  $types = $_POST['types'];

  // Basic validation

      $OfferController = new OfferController();
      $result = $OfferController->addproduct($nomp,$quantite,$prix_p,$fin_prix,$descri,$types);

      if ($result) {
          header('Location:library.php');
      } else {
          echo "<p>Failed to add user.</p>";
      }
}



  


?>
