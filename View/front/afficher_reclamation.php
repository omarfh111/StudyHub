<?php

require_once 'C:/xampp/htdocs/WebProject/Controller/reclamationC.php';  

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  // Crée une instance de ReclamationController
  $controller = new ReclamationController();
  // Récupérer la réclamation spécifique par son ID
  $reclamation = $controller->getReclamationById($id);
  $reponseExist = $controller->getReponseByReclamationId($id);
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
  <title>StudyHub &mdash; Website by WebNexus</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


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
  <link rel="stylesheet" href="css/style1.css?">
  <link rel="stylesheet" href="css/style.css?">
  



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
            <a href="#" class="small mr-3"><span class="icon-question-circle-o mr-2"></span> Besoin d'aide?</a> 
            <a href="#" class="small mr-3"><span class="icon-phone2 mr-2"></span>+216 22 200 616 </a> 
            <a href="#" class="small mr-3"><span class="icon-envelope-o mr-2"></span> StudyHub@gmail.com</a> 
          </div>
          <div class="col-lg-3 text-right">
            <a href="login.html" class="small mr-3"><span class="icon-unlock-alt"></span> S'identifier</a>
            <a href="register.html" class="small btn btn-primary px-4 py-2 rounded-0"><span class="icon-users"></span>S'inscrire</a>
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
                  <a href="index.html" class="nav-link text-left">Accueil</a>
                </li>
                <li class="has-children">
                  <a href="about.html" class="nav-link text-left">About Us</a>
                  <ul class="dropdown">
                    <li><a href="teachers.html">Nos Professeurs</a></li>
                    <li><a href="about.html">Notre Academie</a></li>
                  </ul>
                </li>
                <li>
                  <a href="admissions.html" class="nav-link text-left">Admissions</a>
                </li>
                <li>
                  <a href="courses.html" class="nav-link text-left">Cours</a>
                </li>
                <li class="active">
                  <a href="contact.html" class="nav-link text-left">Reclamation</a>
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
    <!-- Notification : apparaît uniquement si une réponse est disponible -->
<?php if ($reponseExist): ?>
    <div id="notification" class="notification">
        <p>Nous avons répondu à votre réclamation. Veuillez vérifier votre boîte mail pour plus d'informations.</p>
    </div>
<?php endif; ?>

<script>
// Fermeture de la notification après 5 secondes
setTimeout(function() {
    var notification = document.getElementById('notification');
    if (notification) {
        notification.style.display = 'none';
    }
}, 5000);
</script>
    
    <div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image: url('images/bg_1.jpg')">
        <div class="container">
          <div class="row align-items-end">
            <div class="col-lg-7">
              <h2 class="mb-0">Mes Réclamations</h2>
              
            </div>
          </div>
        </div>
      </div> 

    <div class="custom-breadcrumns border-bottom">
      <div class="container">
        <a href="index.html">Accueil</a>
        <span class="mx-3 icon-keyboard_arrow_right"></span>
        <span class="current">Reclamation</span>
      </div>
    </div>
    <h2>Votre Réclamation Envoyée</h2>

    <?php if (isset($reclamation)): ?>
  <div class="table-container">
    <table class="success-table">
      <thead>
        <tr>
          <th>Objet</th>
          <th>Message</th>
          <th>Date</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?= htmlspecialchars($reclamation->getObjet()); ?></td>
          <td><?= htmlspecialchars($reclamation->getMessage()); ?></td>
          <td><?= htmlspecialchars($reclamation->getDate()->format('Y-m-d')); ?></td>
        </tr>
      </tbody>
    </table>
    <a href="contact.php" class="success-button">Retour</a>
  </div>
<?php else: ?>
  <p>Vous n'avez envoyé aucune réclamation pour l'instant.</p>
<?php endif; ?>




  
      

    <div class="footer">
      <div class="container">
        <div class="row">
          <div class="col-lg-3">
            <p class="mb-4"><img src="images/logo.png" alt="Image" class="img-fluid"></p>
            <p>Bienvenue sur StudyHub, votre espace d'apprentissage personnalisé où chaque étudiant trouve les ressources et le soutien nécessaires pour atteindre ses objectifs académiques avec succès.</p>  
            <!--<p><a href="#">Learn More</a></p>-->
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
 <!-- <script src="js/validation.js"></script> -->

 </body>

</html>
