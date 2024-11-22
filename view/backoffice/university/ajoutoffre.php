<?php

use PSpell\Config;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
  require_once 'C:\xampp\htdocs\project\config.php';
  require_once 'C:\xampp\htdocs\project\model\produitmodel.php';
  $nomp=$_POST['nomp'];
  $quantite=$_POST['quantite'];
  $prix_p=$_POST['prix_p'];
  $reduction=$_POST['reduction'];
  $types=$_POST['types'];
  
  $produit=new ProductModel($pdo,$nomp,$quantite,$prix_p,$reduction,$types);
  if($produit->addProduct()){
    echo "produit ajouté a la base avec succes";
    //metier envoyer mail
  }
  
}



  


?>
<!DOCTYPE html>
<html lang="en">

<!doctype html>
<html lang="en" dir="ltr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="icon" href="favicon.ico" type="image/x-icon"/>
<title>:: Ericsson :: Home</title>

<!-- Bootstrap Core and vandor -->
<link rel="stylesheet" href="../assets/plugins/bootstrap/css/bootstrap.min.css" />

<!-- Plugins css -->
<link rel="stylesheet" href="../assets/plugins/summernote/dist/summernote.css"/>


<!-- Core css -->
<link rel="stylesheet" href="../assets/css/style.min.css"/>
</head>

<body class="font-muli theme-blush">
<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
    </div>
</div>
<form action="C:\xampp\htdocs\project\view\backoffice\ajoutoffre.php" name="ajoutoffre"  method="post" class="form-group" ></form>
<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">


   
        <div class="container">
          <div class="row align-items-end">
            
          </div>
        </div>
      </div> 
    

    <div class="custom-breadcrumns border-bottom">
     
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="section-body mt-4">
         
                </div>
            </div>
        </div>
    </div>

    
        <div class="container">
          <div class="row">
            <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
              
              
            </div>
            
            <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
              
             
              
          </div>
        </div>
      </div>
      

   

</body>

</html>