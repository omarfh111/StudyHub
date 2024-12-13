<?php
require_once 'C:/xampp/htdocs/WebProject/Controller/reclamationC.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $idu = 9;  

  $conn = Config::getConnexion();

  $sqlUser = "SELECT nom, prenom, email FROM user WHERE idu = :idu";

  try {
      $stmt = $conn->prepare($sqlUser);
      $stmt->execute([':idu' => $idu]);
      $user = $stmt->fetch(PDO::FETCH_ASSOC);

      if ($user) {
          $nom = $user['nom'];
          $prenom = $user['prenom'];
          $email = $user['email'];

          $objet = $_POST['objet'];
          $message = $_POST['message'];
          $date = $_POST['date'];

          // Validation des données
          if (!empty($objet) && !empty($message) && !empty($date)) {
              // Insertion de la réclamation dans la table
              $sqlInsert = "INSERT INTO reclamation (idu, nom, prenom, email, date, objet, message) 
                            VALUES (:idu, :nom, :prenom, :email, :date, :objet, :message)";
              $stmtInsert = $conn->prepare($sqlInsert);
              $stmtInsert->execute([
                  ':idu' => $idu,
                  ':nom' => $nom,
                  ':prenom' => $prenom,
                  ':email' => $email,
                  ':date' => $date,
                  ':objet' => $objet,
                  ':message' => $message
              ]);

              echo "<p class='text-success'>Réclamation ajoutée avec succès.</p>";
          } else {
              echo "<p class='text-danger'>Tous les champs sont obligatoires.</p>";
          }
      } else {
          echo "<p class='text-danger'>Utilisateur non trouvé.</p>";
      }
  } catch (PDOException $e) {
      echo "<p class='text-danger'>Erreur : " . $e->getMessage() . "</p>";
  }
}



$conn = Config::getConnexion();
$idu = 9; 
// Récupérer les informations de l'utilisateur avec une jointure entre user et reclamation
$sql = "SELECT reclamation.id_rec, reclamation.objet, reclamation.message
        FROM reclamation
        WHERE reclamation.idu = :idu"; 

try {
    $stmt = $conn->prepare($sql);
    $stmt->execute([':idu' => $idu]); // Récupère les données de l'utilisateur via idu
    $reclamations = $stmt->fetchAll(PDO::FETCH_ASSOC);  // Récupérer toutes les réclamations

    
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
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
  <link rel="stylesheet" href="css/style1.css?v=1.0">
  <link rel="stylesheet" href="css/style.css?">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  



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

    
    <div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image: url('images/bg_1.jpg')">
        <div class="container">
          <div class="row align-items-end">
            <div class="col-lg-7">
              <h2 class="mb-0">Reclamation</h2>
              <p>Comment pouvons-nous vous aider?.</p>
            </div>
          </div>
        </div>
      </div> 

    <div class="custom-breadcrumns border-bottom">
      <div class="container">
        <a href="index.html">Accueil</a>
        <span class="mx-3 icon-keyboard_arrow_right"></span>
        <span class="current">Reclamation</span>
        <div style="position: relative; display: inline-block;">
    <a href="afficher_reclamation.php" style="text-decoration: none;">
        <i class="fa fa-bell" style="font-size: 24px; color: orange;"></i>
        <?php if (isset($_SESSION['new_notification']) && $_SESSION['new_notification']): ?>
            <span style="position: absolute; top: -5px; right: -10px; background: red; color: white; 
                         border-radius: 50%; padding: 5px; font-size: 12px;">
                !
            </span>
        <?php endif; ?>
    </a>
</div>
      </div>
    </div>
    


    
    <div class="site-section">
    <div class="formulaire-conteneur">
    <div class="container">
        <h3 class="form-title">Formulaire de réclamation</h3>
        <form action="http://localhost/WebProject/View/front/contact.php" method="POST">
    <div class="row">
        <div class="col-md-6 form-group">
            
            <label for="fname">Nom</label>
            <input type="text" id="fname" name="nom" class="form-control form-control-lg" 
                   placeholder="Votre Nom" value="<?= htmlspecialchars($nom) ?>" readonly>
            <small id="nom_error" class="text-danger"></small>
        </div>
        <div class="col-md-6 form-group">
            <label for="lname">Prénom</label>
            <input type="text" id="lname" name="prenom" class="form-control form-control-lg" 
                   placeholder="Votre Prénom" value="<?= htmlspecialchars($prenom) ?>" readonly>
            <small id="prenom_error" class="text-danger"></small>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 form-group">
            <label for="eaddress">Email</label>
            <input type="email" id="eaddress" name="email" class="form-control form-control-lg" 
                   placeholder="exemple@gmail.com" value="<?= htmlspecialchars($email) ?>" readonly>
            <small id="email_error" class="text-danger"></small>
        </div>
        <div class="col-md-6 form-group">
            <label for="date">Date</label>
            <input type="date" id="date" name="date" class="form-control form-control-lg">
            <small id="date_error" class="text-danger"></small>
        </div>
        <div class="col-md-12 form-group">
            <label for="Objet">Objet</label>
            <input type="text" id="Objet" name="objet" class="form-control form-control-lg" placeholder="L'objet de votre réclamation">
            <small id="objet_error" class="text-danger"></small>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 form-group">
            <label for="message">Message</label>
            <textarea name="message" id="message" cols="30" rows="10" class="form-control" placeholder="Tapez votre message"></textarea>
            <small id="message_error" class="text-danger"></small>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <input type="submit" value="Envoyer" class="btn btn-primary btn-lg px-5">
        </div>
    </div>
</form>

    </div>
</div>

    </div>
    
  

<!-- Affichage des messages de succès ou d'erreur -->
<?php
// Affichage du message de succès ou d'erreur
if (isset($message_success)): ?>
    <div class="alert alert-success text-center" style="background-color: #28a745; color: white; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
        <?php echo $message_success; ?>
    </div>
<?php elseif (isset($message_error)): ?>
    <div class="alert alert-danger text-center" style="background-color: #dc3545; color: white; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
        <?php echo $message_error; ?>
    </div>
<?php endif; ?>


  
  
    <div class="section-bg style-1" style="background-image: url('images/hero_1.jpg');">
        <div class="container">
          <div class="row">
            <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
              <span class="icon flaticon-mortarboard"></span>
              <h3>Notre Philosphie</h3>
              <p>Nous croyons que chaque individu, quel que soit son parcours, mérite d'avoir accès à une éducation de qualité. C'est pourquoi nous nous efforçons de créer un environnement d'apprentissage respectueux et accessible à tous.</p>
            </div>
            <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
              <span class="icon flaticon-school-material"></span>
              <h3>Principe</h3>
              <p>Excellence académique.</p>
              <p>Respect de l'intégrité .</p>
              <p>Pédagogie centrée sur l'apprenant.</p>
            </div>
            <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
              <span class="icon flaticon-library"></span>
              <h3>Clés pour le Succès</h3>
              <p>La réussite commence par un engagement fort envers ses objectifs. Être assidu, respecter ses délais et maintenir une routine d’étude régulière sont des habitudes fondamentales pour avancer avec succès dans ses études..</p>
            </div>
          </div>
        </div>
      </div>
  
      

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

 ><script>

document.addEventListener("DOMContentLoaded", function () {
  // Récupérer les éléments du formulaire avec les IDs correspondants
  const emailInput = document.getElementById("eaddress");
  const fnameInput = document.getElementById("fname");
  const lnameInput = document.getElementById("lname");
  const messageInput = document.getElementById("message");
  const dateInput = document.getElementById("date"); // Champ date
  const submitButton = document.querySelector("input[type='submit']");

  // Fonction de validation d'email
  function validateEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
  }

  // Fonction de validation de la date
  function validateDate(date) {
    const currentDate = new Date();
    return date && new Date(date).getTime() >= currentDate.getTime(); // Vérifie si la date n'est pas dans le futur
  }

  // Fonction de validation du nom (au moins 3 caractères)
  function validateName(name) {
    const nameRegex = /^[A-Za-zÀ-ÖØ-öø-ÿ\s'-]{3,30}$/; // Lettres uniquement, avec accents, espaces, et longueurs entre 3 et 30
    return nameRegex.test(name);
  }

  // Vérifier si un champ est vide et afficher le message d'erreur
  function showError(input, message) {
    const errorElement = input.nextElementSibling; // Trouver le <small> associé à l'input
    errorElement.textContent = message;
    errorElement.style.display = "block"; // Affiche l'erreur
    errorElement.style.color = "#8B0000";
    
  }

  // Cacher les messages d'erreur
  function clearError(input) {
    const errorElement = input.nextElementSibling;
    errorElement.textContent = "";
    errorElement.style.display = "none";
    errorElement.style.color = ""; 
  }

  // Fonction de validation générale
  submitButton.addEventListener("click", function (event) {
    let isValid = true;

    // Vérifier le prénom (au moins 3 caractères)
    if (!lnameInput.value) {
      showError(lnameInput, "* Veuillez entrer votre prénom.");
      isValid = false;
    } else if (lnameInput.value.length < 3) {
      showError(lnameInput, "Le prénom doit comporter au moins 3 caractères.");
      isValid = false;
    } else {
      clearError(lnameInput);
    }

    // Vérifier le nom (au moins 3 caractères)
    if (!fnameInput.value) {
      showError(fnameInput, "* Veuillez entrer votre nom.");
      isValid = false;
    } else if (fnameInput.value.length < 3) {
      showError(fnameInput, "Le nom doit comporter au moins 3 caractères.");
      isValid = false;
    } else {
      clearError(fnameInput);
    }

    // Vérifier l'email
    if (!emailInput.value) {
      showError(emailInput, "* Veuillez entrer votre email.");
      isValid = false;
    } else if (!validateEmail(emailInput.value)) {
      showError(emailInput, "* Veuillez entrer un email valide.");
      isValid = false;
    } else {
      clearError(emailInput);
    }

    // Vérifier la date
    if (!dateInput.value) {
  showError(dateInput, "* Veuillez entrer une date.");
  isValid = false;
} else {
  const inputDate = new Date(dateInput.value);
  const currentDate = new Date();

  // Vérifier si la date saisie est dans le futur
  if (inputDate.getTime() > currentDate.getTime()) {
    showError(dateInput, "La date ne peut pas être dans le futur.");
    isValid = false;
  }
  // Vérifier si la date est valide
  else if (isNaN(inputDate.getTime())) {
    showError(dateInput, "* Veuillez entrer une date valide.");
    isValid = false;
  } else {
    clearError(dateInput);
  }
}

    // Vérifier le message
    if (!messageInput.value) {
      showError(messageInput, "* Veuillez écrire un message.");
      isValid = false;
    } else {
      clearError(messageInput);
    }

    // Si tout est valide, soumettre le formulaire, sinon empêcher l'envoi
    if (!isValid) {
      event.preventDefault(); // Empêche l'envoi du formulaire si un champ est vide
    }
  });
});

</script>

  






</body>

</html>