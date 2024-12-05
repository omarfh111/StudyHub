<?php
// Connexion à la base de données
require_once 'C:\xampp\htdocs\project\config.php';

// Connexion à la base de données
$conn = Config::getConnexion();

// Récupérer les produits dans le panier
$sql = "SELECT cart.idc, cart.idp, cart.nompp, cart.price, cart.quantite, produit.nomp AS produit_nom
        FROM cart
        INNER JOIN produit ON cart.idp = produit.idp";
$stmt = $conn->prepare($sql);
$stmt->execute();
$cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="addToCart.js" defer></script>
  <title>Academics &mdash; Website by Colorlib</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Inclure jQuery -->
  <link rel="stylesheet" href="styles.css">
  <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700,900" rel="stylesheet">
  <link rel="stylesheet" href="fonts/icomoon/style.css">

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/jquery-ui.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">

  <link rel="stylesheet" href="css/jquery.fancybox.min.css">

  <link rel="stylesheet" href="css/bootstrap-datepicker.css">

  <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

  <link rel="stylesheet" href="css/aos.css">
  <link href="css/jquery.mb.YTPlayer.min.css" media="all" rel="stylesheet" type="text/css">

  <link rel="stylesheet" href="css/style.css">
  
  <script src="affichage.js" defer></script>
  <link rel="stylesheet" href="affichage.css?v=1.0">   

</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">


  <div class="site-wrap">

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>


    <div class="py-2 bg-light">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-9 d-none d-lg-block">
            <a href="#" class="small mr-3"><span class="icon-question-circle-o mr-2"></span> avez vous une question?</a> 
            <a href="#" class="small mr-3"><span class="icon-phone2 mr-2"></span> 21544247</a> 
            <a href="#" class="small mr-3"><span class="icon-envelope-o mr-2"></span> hamzafhaiel1004@gmail.com</a> 
          </div>
          <div class="col-lg-3 text-right">
       
            
          </div>
        </div>
      </div>
    </div>
    <header class="site-navbar py-4 js-sticky-header site-navbar-target" role="banner">

      <div class="container">
        <div class="d-flex align-items-center">
          <div class="site-logo">
            <a href="index.html" class="d-block">
              <img src="images/logo.jpg" alt="Image" class="img-fluid">
            </a>
          </div>
          <div class="mr-auto">
            <nav class="site-navigation position-relative text-right" role="navigation">
              <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
                <li>
                  <a href="index.html" class="nav-link text-left">Home</a>
                </li>
                <li class="has-children">
                  <a href="about.html" class="nav-link text-left">About Us</a>
                  <ul class="dropdown">
                    <li><a href="teachers.html">Our Teachers</a></li>
                    <li><a href="about.html">Our School</a></li>
                  </ul>
                </li>
                <li>
                  <a href="admissions.html" class="nav-link text-left">Admissions</a>
                </li>
                <li>
                  <a href="courses.html" class="nav-link text-left">Courses</a>
                </li>
                <li>
                    <a href="contact.html" class="nav-link text-left">Contact</a>
                  </li>
              </ul>                                                                                                                                                                                                                                                                                          </ul>
            </nav>

          </div>
          <div class="ml-auto">
            <div class="social-wrap">
              <a href="#"><span class="icon-facebook"></span></a>
              <a href="#"><span class="icon-twitter"></span></a>
              <a href="#"><span class="icon-linkedin"></span></a>

              <a href="#" class="d-inline-block d-lg-none site-menu-toggle js-menu-toggle text-black"><span
                class="icon-menu h3"></span></a>
            </div>
          </div>
         
        </div>
      </div>

    </header>

    
    <div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" >

                <div class="container">
          <div class="row align-items-end">
            <div class="col-lg-7">
              <h2 class="mb-0">Les meilleurs offres pour la rentrée</h2>
              <p id="tdate"></p>
            </div>
          </div>
        </div>
      </div> 
    

    <div class="custom-breadcrumns border-bottom">
      <div class="container">
        <a href="index.html">Home</a>
        <span class="mx-3 icon-keyboard_arrow_right"></span>
        <span class="current">News</span>
      </div>
      
    </div>

    <div class="site-section">
  
    <div class="container">
    
    <div class="row justify-content-center">
    
        <div class="col-md-9 mb-4">
        <div class="pagination">
        
</div>
<br>
<h1>Votre Panier</h1>

    <?php if (count($cartItems) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Quantité</th>
                    <th>Prix Unitaire</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cartItems as $item): ?>
                    <tr data-idc="<?php echo htmlspecialchars($item['idc']); ?>">
                        <td><?php echo htmlspecialchars($item['produit_nom']); ?></td>
                        <td>
                            <input type="number" class="quantite" value="<?php echo htmlspecialchars($item['quantite']); ?>" min="1">
                        </td>
                        <td><?php echo htmlspecialchars($item['price']); ?> DT</td>
                        <td class="total-price"><?php echo htmlspecialchars($item['price'] * $item['quantite']); ?> DT</td>
                        <td>
                            <input type="button" value="update" class="update-quantite">
                        </td>
                        <td>
                            <a href="supp.php?idc=<?php echo htmlspecialchars($item['idc']); ?>">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="total">
            <p>Total: 
                <?php 
                    $total = 0;
                    foreach ($cartItems as $item) {
                        $total += $item['price'] * $item['quantite'];
                    }
                    echo $total . " DT";
                ?>
            </p>
        </div>

    <?php else: ?>
        <p>Votre panier est vide.</p>
    <?php endif; ?>

    <div class="checkout">
        <a href="checkout.php">Passer à la caisse</a>
    </div>

    <script>
        // AJAX pour mettre à jour la quantité
        $(document).ready(function() {
    $('.update-quantite').click(function() {
        // Récupérer les données de la ligne sélectionnée
        var row = $(this).closest('tr');
        var idc = row.data('idc');
        var quantite = row.find('.quantite').val();
        var priceText = row.find('td:nth-child(3)').text().trim();  // Récupérer le prix depuis la troisième cellule
        
        // Nettoyer le prix et le convertir en nombre
        var price = parseFloat(priceText.replace('DT', '').trim());

        // Vérifier que la quantité et le prix sont valides
        if (quantite <= 0) {
            alert("La quantité doit être supérieure à 0.");
            return;
        }
        if (isNaN(price) || price <= 0) {
            alert("Le prix n'est pas valide.");
            return;
        }

        // Calculer le total
        var total = quantite * price;

        // Effectuer l'appel AJAX pour mettre à jour la quantité
        $.ajax({
            url: 'update_quantity.php',
            type: 'POST',
            data: {
                idc: idc,
                quantite: quantite
            },
            success: function(response) {
                // Mettre à jour la quantité et le prix total dans l'interface sans recharger la page
                row.find('.total-price').text(total.toFixed(2) + " DT");  // Mettre à jour le total avec 2 décimales
                //alert(response);  // Afficher un message de succès
            },
            error: function(xhr, status, error) {
                console.error(error);
                alert("Erreur lors de la mise à jour de la quantité.");
            }
        });
    });
});
    </script>

    




           
        </div>
        
    </div>
    
</div>

</div>


    </div>
</div>

                
            </div>
            
        </div>
        
    </div>

    <div class="section-bg style-1" >
        <div class="container">
          <div class="row">
            <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
              <span class="icon flaticon-mortarboard"></span>
              <h3>Our Philosphy</h3>
              <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reiciendis recusandae, iure repellat quis delectus ea? Dolore, amet reprehenderit.</p>
            </div>
            <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
              <span class="icon flaticon-school-material"></span>
              <h3>Academics Principle</h3>
              <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reiciendis recusandae, iure repellat quis delectus ea?
                Dolore, amet reprehenderit.</p>
            </div>
            <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
              <span class="icon flaticon-library"></span>
              <h3>Key of Success</h3>
              <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reiciendis recusandae, iure repellat quis delectus ea?
                Dolore, amet reprehenderit.</p>
            </div>
          </div>
        </div>
      </div>
      

    <div class="footer">
      <div class="container">
        <div class="row">
          <div class="col-lg-3">
            <p class="mb-4"><img src="images/logo.png" alt="Image" class="img-fluid"></p>
              
            <p><a href="#">Learn More</a></p>
          </div>
          <div class="col-lg-3">
            <h3 class="footer-heading"><span>Our Campus</span></h3>
            <ul class="list-unstyled">
                <li><a href="#">Acedemic</a></li>
                <li><a href="#">News</a></li>
                <li><a href="#">Our Interns</a></li>
                <li><a href="#">Our Leadership</a></li>
                <li><a href="#">Careers</a></li>
                <li><a href="#">Human Resources</a></li>
            </ul>
          </div>
          <div class="col-lg-3">
              <h3 class="footer-heading"><span>Our Courses</span></h3>
              <ul class="list-unstyled">
                  <li><a href="#">Math</a></li>
                  <li><a href="#">Science &amp; Engineering</a></li>
                  <li><a href="#">Arts &amp; Humanities</a></li>
                  <li><a href="#">Economics &amp; Finance</a></li>
                  <li><a href="#">Business Administration</a></li>
                  <li><a href="#">Computer Science</a></li>
              </ul>
          </div>
          <div class="col-lg-3">
              <h3 class="footer-heading"><span>Contact</span></h3>
              <ul class="list-unstyled">
                  <li><a href="#">Help Center</a></li>
                  <li><a href="#">Support Community</a></li>
                  <li><a href="#">Press</a></li>
                  <li><a href="#">Share Your Story</a></li>
                  <li><a href="#">Our Supporters</a></li>
              </ul>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <div class="copyright">
                <p>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" >Colorlib</a>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    

  </div>
  <!-- .site-wrap -->

  <!-- loader -->
  <div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#51be78"/></svg></div>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/jquery.countdown.min.js"></script>
  <script src="js/bootstrap-datepicker.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.fancybox.min.js"></script>
  <script src="js/jquery.sticky.js"></script>
  <script src="js/jquery.mb.YTPlayer.min.js"></script>




  <script src="js/main.js"></script>

</body>

</html>