<?php 
require_once '../config.php';
session_start();

if (isset($_COOKIE['studyhub'])) {
  // Décoder les données du cookie
  $userData = json_decode($_COOKIE['studyhub'], true);

  $email = $userData['email'];
  $nom = $userData['nom'];
  $role = $userData['role'];

  //echo "Bienvenue, " . $nom . " (" . $role . ")!"; // Afficher le nom et rôle
} else {
  header('Location: login.php');
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>StudyHub</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="icon" type="image/x-icon" href="images/StudyHub.ico" />

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
            <a href="#" class="small mr-3"><span class="icon-phone2 mr-2"></span> +216 22 200 616</a> 
            <a href="#" class="small mr-3"><span class="icon-envelope-o mr-2"></span> StudyHub@gmail.com</a> 
          </div>
          <div class="col-lg-3 text-right">
            <a href="profile.php" class="small mr-3"><span class="icon-user"></span> <?php echo $nom . " (" . $role . ")"; ?></a>
            <a href="logout.php" class="small btn btn-primary px-4 py-2 rounded-0"><span class="icon-lock"></span> Se Deconnecter</a>
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
                <li class="active">
                  <a href="index.html" class="nav-link text-left">Accueil</a>
                </li>
                <li class="has-children">
                  <a href="about.html" class="nav-link text-left">About Us</a>
                  <ul class="dropdown">
                    <li><a href="prof.php">Nos Proffesseurs</a></li>
                    <li><a href="chatgpt.php">Notre assistance AI</a></li>
                  </ul>
                </li>
                <li>
                  <a href="Offres.html" class="nav-link text-left">offres</a>
                </li>
                <li class="has-children">
                  <a href="courses.html" class="nav-link text-left">Courses</a>
                  <ul class="dropdown">
                    <li><a href="courses.html">cours</a></li>
                    <li><a href="evaluation.html">evaluation</a></li>
                  </ul>
                </li>
                <li>
                    <a href="contact.html" class="nav-link text-left">Reclamations</a>
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

    
    <div class="hero-slide owl-carousel site-blocks-cover">
      <div class="intro-section" style="background-image: url('images/hero_1.jpg');">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-12 mx-auto text-center" data-aos="fade-up">
              <h1>StudyHub Academy</h1>
            </div>
          </div>
        </div>
      </div>

      <div class="intro-section" style="background-image: url('images/hero_1.jpg');">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-12 mx-auto text-center" data-aos="fade-up">
              <h1>Vous pouvez tout apprendre</h1>
            </div>
          </div>
        </div>
      </div>

    </div>
    

    <div></div>

    <div class="site-section">
      <div class="container">
        <div class="row mb-5 justify-content-center text-center">
          <div class="col-lg-4 mb-5">
            <h2 class="section-title-underline mb-5">
              <span>Pourquoi choisir StudyHub ?</span>
            </h2>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">

            <div class="feature-1 border">
              <div class="icon-wrapper bg-primary">
                <span class="flaticon-mortarboard text-white"></span>
              </div>
              <div class="feature-1-content">
                <h2>Apprentissage personnalisé</h2>
                <p>Chaque utilisateur suit un parcours personnalisé qui correspond à son rythme, ses intérêts, et ses objectifs spécifiques.</p>
                <!--<p><a href="#" class="btn btn-primary px-4 rounded-0">Learn More</a></p>-->
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
            <div class="feature-1 border">
              <div class="icon-wrapper bg-primary">
                <span class="flaticon-school-material text-white"></span>
              </div>
              <div class="feature-1-content">
                <h2>Progrès mesurable</h2>
                <p>Avec un suivi régulier des progrès, les utilisateurs peuvent visualiser leurs améliorations, ce qui renforce leur motivation et leur confiance en eux.</p>
                <!--<p><a href="#" class="btn btn-primary px-4 rounded-0">Learn More</a></p>-->
              </div>
            </div> 
          </div>
          <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
            <div class="feature-1 border">
              <div class="icon-wrapper bg-primary">
                <span class="flaticon-library text-white"></span>
              </div>
              <div class="feature-1-content">
                <h2>Outils pour les etudiants</h2>
                <p> La plateforme propose des outils diversifiés (vidéos, quiz, exercices) permettant à chacun d’apprendre de manière engageante et efficace.</p>
                <!--<p><a href="#" class="btn btn-primary px-4 rounded-0">Learn More</a></p>-->
              </div>
            </div> 
          </div>
        </div>
      </div>
    </div>


    <div class="site-section">
      <div class="container">


        <div class="row mb-5 justify-content-center text-center">
          <div class="col-lg-6 mb-5">
            <h2 class="section-title-underline mb-3">
              <span>Popular Courses</span>
            </h2>
            <p>Les cours les plus demandés dans notre plateforme</p>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
              <div class="owl-slide-3 owl-carousel">
                  <div class="course-1-item">
                    <figure class="thumnail">
                      <a href="course-single.html"><img src="images/course_1.jpg" alt="Image" class="img-fluid"></a>
                      <div class="price">99DNT</div>
                      <div class="category"><h3>Programation C</h3></div>  
                    </figure>
                    <div class="course-1-content pb-4">
                      <h2>Comment devenir un genie en programmation C</h2>
                      <div class="rating text-center mb-3">
                        <span class="icon-star2 text-warning"></span>
                        <span class="icon-star2 text-warning"></span>
                        <span class="icon-star2 text-warning"></span>
                        <span class="icon-star2 text-warning"></span>
                        <span class="icon-star2 text-warning"></span>
                      </div>
                      <p class="desc mb-4">Devenez un expert en programmation C et maîtrisez les bases de la performance et de l’optimisation avec des exercices pratiques et des techniques avancées !</p>
                      <p><a href="course-single.html" class="btn btn-primary rounded-0 px-4">Voir ce cours</a></p>
                    </div>
                  </div>
      
                  <div class="course-1-item">
                    <figure class="thumnail">
                      <a href="course-single.html"><img src="images/course_2.jpg" alt="Image" class="img-fluid"></a>
                      <div class="price">99DNT</div>
                      <div class="category"><h3>Web Design</h3></div>  
                    </figure>
                    <div class="course-1-content pb-4">
                      <h2>Devenez le meilleur Web Designer</h2>
                      <div class="rating text-center mb-3">
                        <span class="icon-star2 text-warning"></span>
                        <span class="icon-star2 text-warning"></span>
                        <span class="icon-star2 text-warning"></span>
                        <span class="icon-star2 text-warning"></span>
                        <span class="icon-star2 text-warning"></span>
                      </div>
                      <p class="desc mb-4">Apprenez à créer des sites web professionnels et esthétiques en maîtrisant les principes du design, de l’UX/UI et des technologies modernes !</p>
                      <p><a href="course-single.html" class="btn btn-primary rounded-0 px-4">Voir ce cours</a></p>
                    </div>
                  </div>
      
                  <div class="course-1-item">
                    <figure class="thumnail">
                      <a href="course-single.html"><img src="images/course_3.jpg" alt="Image" class="img-fluid"></a>
                      <div class="price">99DNT</div>
                      <div class="category"><h3>Arithmetic</h3></div>  
                    </figure>
                    <div class="course-1-content pb-4">
                      <h2>Ameliorerez vos connaissances en arithmétique</h2>
                      <div class="rating text-center mb-3">
                        <span class="icon-star2 text-warning"></span>
                        <span class="icon-star2 text-warning"></span>
                        <span class="icon-star2 text-warning"></span>
                        <span class="icon-star2 text-warning"></span>
                        <span class="icon-star2 text-warning"></span>
                      </div>
                      <p class="desc mb-4">Maîtrisez les concepts fondamentaux de l'arithmétique et développez des compétences solides pour résoudre des problèmes complexes avec facilité !</p>
                      <p><a href="courses-single.html" class="btn btn-primary rounded-0 px-4">Voir ce cours</a></p>
                    </div>
                  </div>

                  <div class="course-1-item">
                    <figure class="thumnail">
                        <a href="course-single.html"><img src="images/course_4.jpg" alt="Image" class="img-fluid"></a>
                      <div class="price">99DNT</div>
                      <div class="category"><h3>Mobile Application</h3></div>  
                    </figure>
                    <div class="course-1-content pb-4">
                      <h2>Cree votre application mobile</h2>
                      <div class="rating text-center mb-3">
                        <span class="icon-star2 text-warning"></span>
                        <span class="icon-star2 text-warning"></span>
                        <span class="icon-star2 text-warning"></span>
                        <span class="icon-star2 text-warning"></span>
                        <span class="icon-star2 text-warning"></span>
                      </div>
                      <p class="desc mb-4">Apprenez à créer des applications mobiles performantes et intuitives, de la conception à la publication sur les plateformes Android et iOS !</p>
                      <p><a href="course-single.html" class="btn btn-primary rounded-0 px-4">Voir ce cours</a></p>
                    </div>
                  </div>
      
                  <div class="course-1-item">
                    <figure class="thumnail">
                        <a href="course-single.html"><img src="images/course_5.jpg" alt="Image" class="img-fluid"></a>
                      <div class="price">99DNT</div>
                      <div class="category"><h3>Web Development</h3></div>  
                    </figure>
                    <div class="course-1-content pb-4">
                      <h2>cree votre site web personalise</h2>
                      <div class="rating text-center mb-3">
                        <span class="icon-star2 text-warning"></span>
                        <span class="icon-star2 text-warning"></span>
                        <span class="icon-star2 text-warning"></span>
                        <span class="icon-star2 text-warning"></span>
                        <span class="icon-star2 text-warning"></span>
                      </div>
                      <p class="desc mb-4">Devenez un développeur web en maîtrisant les langages essentiels et en créant des sites interactifs et responsives, adaptés aux besoins modernes !</p>
                      <p><a href="course-single.html" class="btn btn-primary rounded-0 px-4">Voir ce cours</a></p>
                    </div>
                  </div>
      
                  <div class="course-1-item">
                    <figure class="thumnail">
                        <a href="course-single.html"><img src="images/course_6.jpg" alt="Image" class="img-fluid"></a>
                      <div class="price">99DNT</div>
                      <div class="category"><h3>Resaux informatiques</h3></div>  
                    </figure>
                    <div class="course-1-content pb-4">
                      <h2>comprenez les bases des reseaux</h2>
                      <div class="rating text-center mb-3">
                        <span class="icon-star2 text-warning"></span>
                        <span class="icon-star2 text-warning"></span>
                        <span class="icon-star2 text-warning"></span>
                        <span class="icon-star2 text-warning"></span>
                        <span class="icon-star2 text-warning"></span>
                      </div>
                      <p class="desc mb-4">Maîtrisez les fondamentaux des réseaux informatiques et apprenez à configurer, sécuriser et optimiser les infrastructures pour un monde connecté !</p>
                      <p><a href="course-single.html" class="btn btn-primary rounded-0 px-4">Voir ce cours</a></p>
                    </div>
                  </div>
      
              </div>
      
          </div>
        </div>

        
        
      </div>
    </div>

    


    <div class="section-bg style-1" style="background-image: url('images/about_1.jpg');">
      <div class="container">
        <div class="row">
          <div class="col-lg-4">
            <h2 class="section-title-underline style-2">
              <span>A propos StudyHub</span>
            </h2>
          </div>
          <div class="col-lg-8">
            <p class="lead">Chez StudyHub, notre mission est de rendre l'apprentissage accessible, flexible et personnalisé pour tous. Nous croyons que chaque apprenant mérite une expérience éducative qui s'adapte à ses besoins, son rythme et ses objectifs. C’est pourquoi nous proposons des cours interactifs et des ressources variées dans des domaines clés comme la programmation, le design web, les réseaux informatiques, et bien plus encore.</p>
            <p>Notre plateforme combine des outils modernes, des méthodes éprouvées et un suivi personnalisé pour aider chaque utilisateur à atteindre son plein potentiel. Rejoignez-nous et commencez votre parcours d’apprentissage avec nous, où que vous soyez !</p>
            <p><a href="about.html">Read more</a></p>
          </div>
        </div>
      </div>
    </div>

    <!-- // 05 - Block -->
  <div class="site-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-lg-4">
            <h2 class="section-title-underline">
              <span> Avis des utilisateurs</span>
            </h2>
          </div>
        </div>


        <div class="owl-slide owl-carousel">

          <div class="ftco-testimonial-1">
            <div class="ftco-testimonial-vcard d-flex align-items-center mb-4">
              <img src="images/person_1.jpg" alt="Image" class="img-fluid mr-3">
              <div>
                <h3>Lucas M.</h3>
                <span>Développeur logiciel</span>
              </div>
            </div>
            <div>
              <p>&ldquo;J'ai adoré l'expérience d'apprentissage sur ce site. Le contenu est bien structuré et les parcours personnalisés m'ont permis de progresser rapidement en programmation C. Je recommande vivement !&rdquo;</p>
            </div>
          </div>

          <div class="ftco-testimonial-1">
            <div class="ftco-testimonial-vcard d-flex align-items-center mb-4">
              <img src="images/person_2.jpg" alt="Image" class="img-fluid mr-3">
              <div>
                <h3>Sophie L.</h3>
                <span>Designer web</span>
              </div>
            </div>
            <div>
              <p>Le site offre une approche unique pour apprendre à son propre rythme. J'ai pu apprendre le design web tout en suivant un parcours adapté à mes besoins. Très satisfait des ressources proposées !</p>
            </div>
          </div>

          <div class="ftco-testimonial-1">
            <div class="ftco-testimonial-vcard d-flex align-items-center mb-4">
              <img src="images/person_4.jpg" alt="Image" class="img-fluid mr-3">
              <div>
                <h3>Alexandre R.</h3>
                <span>Administrateur réseau</span>
              </div>
            </div>
            <div>
              <p>&ldquo;Ce site a changé ma manière d'apprendre. Grâce aux cours interactifs et aux conseils personnalisés, j'ai pu améliorer mes compétences en réseaux informatiques en un temps record.&rdquo;</p>
            </div>
          </div>

          <div class="ftco-testimonial-1">
            <div class="ftco-testimonial-vcard d-flex align-items-center mb-4">
              <img src="images/person_3.jpg" alt="Image" class="img-fluid mr-3">
              <div>
                <h3>Camille P.</h3>
                <span>Développeuse mobile</span>
              </div>
            </div>
            <div>
              <p>J'ai suivi le module sur les applications mobiles et je suis impressionnée par la qualité du contenu. Les explications sont claires, et j'ai pu créer ma propre application sans difficulté.</p>
            </div>
          </div>

          <div class="ftco-testimonial-1">
            <div class="ftco-testimonial-vcard d-flex align-items-center mb-4">
              <img src="images/person_2.jpg" alt="Image" class="img-fluid mr-3">
              <div>
                <h3>Marc D. </h3>
                <span>Professeur de mathématiques</span>
              </div>
            </div>
            <div>
              <p>&ldquo;Un site qui rend l'apprentissage agréable et accessible. Le suivi personnalisé m'a permis de travailler sur mes faiblesses en arithmétique et d'améliorer ma compréhension des concepts clés.&rdquo;</p>
            </div>
          </div>

          <div class="ftco-testimonial-1">
            <div class="ftco-testimonial-vcard d-flex align-items-center mb-4">
              <img src="images/person_4.jpg" alt="Image" class="img-fluid mr-3">
              <div>
                <h3>Juliette V.</h3>
                <span>Étudiante en informatique</span>
              </div>
            </div>
            <div>
              <p>Le site est très intuitif et propose des cours variés. En tant que débutante en développement web, j'ai beaucoup apprécié l'approche progressive et les ressources pratiques proposées.</p>
            </div>
          </div>

        </div>
        
      </div>
    </div>
    

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
    
    <div class="news-updates">
      <div class="container">
         
        <div class="row">
          <div class="col-lg-9">
             <div class="section-heading">
              <h2 class="text-black">News &amp; Updates</h2>
              <a href="#">Read All News</a>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <div class="post-entry-big">
                  <a href="prof.html" class="img-link"><img src="images/blog_large_1.jpg" alt="Image" class="img-fluid"></a>
                  <div class="post-content">
                    <div class="post-meta"> 
                      <a href="#">June 6, 2019</a>
                      <span class="mx-1">/</span>
                      <a href="#">Admission</a>, <a href="#">Updates</a>
                    </div>
                    <h3 class="post-heading"><a href="prof.html">Campus Camping and Learning Session</a></h3>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="post-entry-big horizontal d-flex mb-4">
                  <a href="prof.html" class="img-link mr-4"><img src="images/blog_1.jpg" alt="Image" class="img-fluid"></a>
                  <div class="post-content">
                    <div class="post-meta">
                      <a href="#">June 6, 2019</a>
                      <span class="mx-1">/</span>
                      <a href="#">Admission</a>, <a href="#">Updates</a>
                    </div>
                    <h3 class="post-heading"><a href="prof.html">Campus Camping and Learning Session</a></h3>
                  </div>
                </div>

                <div class="post-entry-big horizontal d-flex mb-4">
                  <a href="prof.html" class="img-link mr-4"><img src="images/blog_2.jpg" alt="Image" class="img-fluid"></a>
                  <div class="post-content">
                    <div class="post-meta">
                      <a href="#">June 6, 2019</a>
                      <span class="mx-1">/</span>
                      <a href="#">Admission</a>, <a href="#">Updates</a>
                    </div>
                    <h3 class="post-heading"><a href="prof.html">Campus Camping and Learning Session</a></h3>
                  </div>
                </div>

                <div class="post-entry-big horizontal d-flex mb-4">
                  <a href="prof.html" class="img-link mr-4"><img src="images/blog_1.jpg" alt="Image" class="img-fluid"></a>
                  <div class="post-content">
                    <div class="post-meta">
                      <a href="#">June 6, 2019</a>
                      <span class="mx-1">/</span>
                      <a href="#">Admission</a>, <a href="#">Updates</a>
                    </div>
                    <h3 class="post-heading"><a href="prof.html">Campus Camping and Learning Session</a></h3>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="section-heading">
              <h2 class="text-black">Campus Videos</h2>
              <a href="#">View All Videos</a>
            </div>
            <a href="https://vimeo.com/45830194" class="video-1 mb-4" data-fancybox="" data-ratio="2">
              <span class="play">
                <span class="icon-play"></span>
              </span>
              <img src="images/course_5.jpg" alt="Image" class="img-fluid">
            </a>
            <a href="https://vimeo.com/45830194" class="video-1 mb-4" data-fancybox="" data-ratio="2">
                <span class="play">
                  <span class="icon-play"></span>
                </span>
                <img src="images/course_5.jpg" alt="Image" class="img-fluid">
              </a>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section ftco-subscribe-1" style="background-image: url('images/bg_1.jpg')">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-7">
            <h2>Abonnez-vous!</h2>
            <p>Abonnez-vous dès maintenant pour accéder à des cours personnalisés, des ressources exclusives et des outils de suivi pour booster votre apprentissage !</p>
          </div>
          <div class="col-lg-5">
            <form action="" class="d-flex">
              <input type="text" class="rounded form-control mr-2 py-3" placeholder="Enter your email">
              <button class="btn btn-primary rounded py-3 px-4" type="submit">Envoyer</button>
            </form>
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
                    Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" >111</a>
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