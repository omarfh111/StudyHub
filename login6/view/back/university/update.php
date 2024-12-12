<?php
require_once 'C:\xampp\htdocs\login6\config.php';
require_once 'C:\xampp\htdocs\login6\controller\offercontroller.php';

$error = "";
$offer = null;

$offerController = new OfferController();

// Ensure the ID is set from the GET request and is valid
if (isset($_GET['idp']) && !empty($_GET['idp'])) {
    $id = $_GET['idp'];  // Retrieve the ID from the URL
}
if ($id === null) {
    echo "Product ID is missing or invalid.";
    exit; // Stop the script if ID is not valid
}

// Get the product details by ID
$list = $offerController->affichaa();
$pr = null;
foreach ($list as $row) {
    if ($row['idp'] == $id) {
        $pr = $row;
        break;
    }
}

// Check if the form is submitted and handle the update
if (isset($_POST["nomp"]) && isset($_POST["quantite"]) && isset($_POST["prix_p"]) && isset($_POST["fin_prix"]) && isset($_POST["descri"]) && isset($_POST["types"])) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(empty($_POST['nomp']) || ($_POST['quantite'])<0 || empty($_POST['prix_p']) || empty($_POST['fin_prix']) || empty($_POST['descri']) || empty($_POST['types'])){
            echo("Please fill in all fields.");
        }
        else{
        // Create the ProductModel object from POST data
        $produit = new ProductModel(
            $_POST['nomp'],
            $_POST['quantite'],
            $_POST['prix_p'],
            $_POST['fin_prix'],
            $_POST['descri'],
            $_POST['types']
        );

        // Call the updateOffer method and pass the product object along with the ID
        $offerController->updateOffer($produit, $id);
        header("Location:library.php");
        exit;
    }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
    
        <link href="/login6/view/back/university/assets/css/cssss.css" rel="stylesheet">

    
        <!-- Custom fonts for this template-->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">
    
        <!-- Custom styles for this template-->
        <link href="css/sb-admin-2.min.css" rel="stylesheet">
    
    </head>
    <body id="page-top">

        <!-- Page Wrapper -->
        <div id="wrapper">
    
            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    
                <!-- Sidebar - Brand -->
              
                <!-- Nav Item - Dashboard -->
                
                
    
               
    
    
            </ul>
            <!-- End of Sidebar -->
    
            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">
    
                <!-- Main Content -->
                <div id="content">
    
                    <!-- Topbar -->
                   
    
                        <!-- Sidebar Toggle (Topbar) -->
                       
    
                       
    
                       
    
                    </nav>
                    <!-- End of Topbar -->
    
                    <!-- Begin Page Content -->
                    <div class="container-fluid">
    
                        <!-- Page Heading -->
                 
    
                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-12 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
     
                                            <form id="register-form" action="update.php?idp=<?php echo $id; ?>" method="POST">
    
                                                    
                                                <label for="name">name:</label><br>
                                                <input class="form-control form-control-user" type="text" id="destination" name="nomp" value="<?php echo $pr['nomp'] ?>" >
                                                <span id="destination_error"></span><br>
                                        
                                                <label for="quantity">quantity</label><br>
                                                <input class="form-control form-control-user" type="number" id="departure_date" name="quantite" value="<?php echo $pr['quantite'] ?>" >
                                                <span id="departure_date_error"></span><br>
                                        
                                                <label for="price">price</label><br>
                                                <input class="form-control form-control-user" type="number" id="return_date" name="prix_p" value="<?php echo $pr['prix_p'] ?>">
                                                <span id="return_date_error"></span><br>
                                        
                                                <label for="reduction">prix final</label><br>
                                                <input class="form-control form-control-user"  type="number" id="price" name="fin_prix"  value="<?php echo $pr['fin_prix'] ?>">
                                                <span id="price_error"></span><br>
                                        
                                                <label for="descri">description</label>
                                                <span id="category_error"></span><br>
                                                <textarea name="descri" id="descri" cols="80" rows="10" ></textarea><br
                                                <label for="types">types</label><br>
                                                <select class="form-control form-control-user" id="category" name="types" value="<?php echo $pr['types'] ?>">
                                                    <option value="scolaire">scolaire</option>
                                                    <option value="bureaux">bureaux</option>
                                                    <option value="info">info</option>
                                                    
                                                </select>
                                           <br>
                                        
                                                <button type="submit" 
                                                class="btn btn-primary btn-user btn-block" 
                                                onClick="validerFormulaire()"
                                                >update offer</button> 
                                                <!-- <button type="submit" 
                                                class="btn btn-primary btn-user btn-block" 
                                                
                    
                                                >Add Offer</button> -->
                                                <input type="reset">
                                            </form>
                                            <?php ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                          
                        </div>
    
                      
    
                    </div>
                   
    
                </div>
               
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        
                    </div>
                </footer>
              
    
            </div>
         
    
        </div>
       
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
        <script src="js/addOffer.js"></script>
    
        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    
        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    
        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>
    
        <!-- Page level plugins -->
        <script src="vendor/chart.js/Chart.min.js"></script>
    
        <!-- Page level custom scripts -->
        <script src="js/demo/chart-area-demo.js"></script>
        <script src="js/demo/chart-pie-demo.js"></script>
    
    </body>

</html>
