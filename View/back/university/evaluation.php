<?php
require_once 'C:\xampp\htdocs\login6\Controller\EvaluationController.php';
require_once 'C:\xampp\htdocs\login6\Controller\ReponseController.php';

// Vérifie que $db est initialisé dans config.php
if (!isset($db)) {
    require_once 'C:\xampp\htdocs\login6\config.php';
}
if (!isset($reponseController)) {
    $reponseController = new ReponseController($db);
}

// Instancier le contrôleur avec la connexion $db
$evaluationController = new EvaluationController($db);

// Action par défaut
$action = $_GET['action'] ?? 'listeEvaluations';

?>
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

<div id="main_content">
    <!-- Start Main top header -->
    <div id="header_top" class="header_top">
        <div class="container">
            <div class="hleft">
                <a class="header-brand" href="index.html"><i class="fa fa-graduation-cap brand-logo"></i></a>
                <div class="dropdown">
                    <a href="javascript:void(0)" class="nav-link icon menu_toggle"><i class="fe fe-align-center"></i></a>
                    <a href="page-search.html" class="nav-link icon"><i class="fe fe-search" data-toggle="tooltip" data-placement="right" title="Search..."></i></a>
                    <a href="app-email.html"  class="nav-link icon app_inbox"><i class="fe fe-inbox" data-toggle="tooltip" data-placement="right" title="Inbox"></i></a>
                    <a href="app-filemanager.html"  class="nav-link icon app_file xs-hide"><i class="fe fe-folder" data-toggle="tooltip" data-placement="right" title="File Manager"></i></a>
                    <a href="app-social.html"  class="nav-link icon xs-hide"><i class="fe fe-share-2" data-toggle="tooltip" data-placement="right" title="Social Media"></i></a>
                    <a href="javascript:void(0)" class="nav-link icon theme_btn"><i class="fe fe-feather"></i></a>
                    <a href="javascript:void(0)" class="nav-link icon settingbar"><i class="fe fe-settings"></i></a>
                </div>
            </div>
            <div class="hright">
                <a href="javascript:void(0)" class="nav-link icon right_tab"><i class="fe fe-align-right"></i></a>
                <a href="/login6/view/logout.php" class="nav-link icon settingbar"><i class="fe fe-power"></i></a>                
            </div>
        </div>
    </div>
    <!-- Start Rightbar setting panel -->
    <div id="rightsidebar" class="right_sidebar">
        <a href="javascript:void(0)" class="p-3 settingbar float-right"><i class="fa fa-close"></i></a>
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#Settings" aria-expanded="true">Settings</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#activity" aria-expanded="false">Activity</a></li>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane vivify fadeIn active" id="Settings" aria-expanded="true">
                <div class="mb-4">
                    <h6 class="font-14 font-weight-bold text-muted">Theme Color</h6>
                    <ul class="choose-skin list-unstyled mb-0">
                        <li data-theme="azure"><div class="azure"></div></li>
                        <li data-theme="indigo"><div class="indigo"></div></li>
                        <li data-theme="purple"><div class="purple"></div></li>
                        <li data-theme="orange"><div class="orange"></div></li>
                        <li data-theme="green"><div class="green"></div></li>
                        <li data-theme="cyan"><div class="cyan"></div></li>
                        <li data-theme="blush" class="active"><div class="blush"></div></li>
                    </ul>
                </div>
                <div class="mb-4">
                    <h6 class="font-14 font-weight-bold text-muted">Font Style</h6>
                    <div class="custom-controls-stacked font_setting">
                        <label class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" name="font" value="font-muli" checked="">
                            <span class="custom-control-label">Muli Google Font</span>
                        </label>
                        <label class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" name="font" value="font-montserrat">
                            <span class="custom-control-label">Montserrat Google Font</span>
                        </label>
                        <label class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" name="font" value="font-poppins">
                            <span class="custom-control-label">Poppins Google Font</span>
                        </label>
                        <label class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" name="font" value="font-ptsans">
                            <span class="custom-control-label">PT Sans Google Font</span>
                        </label>
                    </div>
                </div>
                <div>
                    <h6 class="font-14 font-weight-bold mt-4 text-muted">General Settings</h6>
                    <ul class="setting-list list-unstyled mt-1 setting_switch">
                        <li>
                            <label class="custom-switch">
                                <span class="custom-switch-description">Night Mode</span>
                                <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-darkmode">
                                <span class="custom-switch-indicator"></span>
                            </label>
                        </li>
                        <li>
                            <label class="custom-switch">
                                <span class="custom-switch-description">Fix Navbar top</span>
                                <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-fixnavbar">
                                <span class="custom-switch-indicator"></span>
                            </label>
                        </li>
                        <li>
                            <label class="custom-switch">
                                <span class="custom-switch-description">Header Dark</span>
                                <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-pageheader">
                                <span class="custom-switch-indicator"></span>
                            </label>
                        </li>
                        <li>
                            <label class="custom-switch">
                                <span class="custom-switch-description">Min Sidebar Dark</span>
                                <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-min_sidebar">
                                <span class="custom-switch-indicator"></span>
                            </label>
                        </li>
                        <li>
                            <label class="custom-switch">
                                <span class="custom-switch-description">Sidebar Dark</span>
                                <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-sidebar">
                                <span class="custom-switch-indicator"></span>
                            </label>
                        </li>
                        <li>
                            <label class="custom-switch">
                                <span class="custom-switch-description">Icon Color</span>
                                <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-iconcolor">
                                <span class="custom-switch-indicator"></span>
                            </label>
                        </li>
                        <li>
                            <label class="custom-switch">
                                <span class="custom-switch-description">Gradient Color</span>
                                <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-gradient">
                                <span class="custom-switch-indicator"></span>
                            </label>
                        </li>
                        <li>
                            <label class="custom-switch">
                                <span class="custom-switch-description">Box Shadow</span>
                                <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-boxshadow">
                                <span class="custom-switch-indicator"></span>
                            </label>
                        </li>
                        <li>
                            <label class="custom-switch">
                                <span class="custom-switch-description">RTL Support</span>
                                <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-rtl">
                                <span class="custom-switch-indicator"></span>
                            </label>
                        </li>
                        <li>
                            <label class="custom-switch">
                                <span class="custom-switch-description">Box Layout</span>
                                <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-boxlayout">
                                <span class="custom-switch-indicator"></span>
                            </label>
                        </li>
                    </ul>
                </div>
                <hr>
                <div class="form-group">
                    <label class="d-block">Storage <span class="float-right">77%</span></label>
                    <div class="progress progress-sm">
                        <div class="progress-bar" role="progressbar" aria-valuenow="77" aria-valuemin="0" aria-valuemax="100" style="width: 77%;"></div>
                    </div>
                    <button type="button" class="btn btn-primary btn-block mt-3">Upgrade Storage</button>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane vivify fadeIn" id="activity" aria-expanded="false">
                <ul class="new_timeline mt-3">
                    <li>
                        <div class="bullet pink"></div>
                        <div class="time">11:00am</div>
                        <div class="desc">
                            <h3>Attendance</h3>
                            <h4>Computer Class</h4>
                        </div>
                    </li>
                    <li>
                        <div class="bullet pink"></div>
                        <div class="time">11:30am</div>
                        <div class="desc">
                            <h3>Added an interest</h3>
                            <h4>“Volunteer Activities”</h4>
                        </div>
                    </li>
                    <li>
                        <div class="bullet green"></div>
                        <div class="time">12:00pm</div>
                        <div class="desc">
                            <h3>Developer Team</h3>
                            <h4>Hangouts</h4>
                            <ul class="list-unstyled team-info margin-0 p-t-5">                                            
                                <li><img src="../assets/images/xs/avatar1.jpg" alt="Avatar"></li>
                                <li><img src="../assets/images/xs/avatar2.jpg" alt="Avatar"></li>
                                <li><img src="../assets/images/xs/avatar3.jpg" alt="Avatar"></li>
                                <li><img src="../assets/images/xs/avatar4.jpg" alt="Avatar"></li>                                            
                            </ul>
                        </div>
                    </li>
                    <li>
                        <div class="bullet green"></div>
                        <div class="time">2:00pm</div>
                        <div class="desc">
                            <h3>Responded to need</h3>
                            <a href="javascript:void(0)">“In-Kind Opportunity”</a>
                        </div>
                    </li>
                    <li>
                        <div class="bullet orange"></div>
                        <div class="time">1:30pm</div>
                        <div class="desc">
                            <h3>Lunch Break</h3>
                        </div>
                    </li>
                    <li>
                        <div class="bullet green"></div>
                        <div class="time">2:38pm</div>
                        <div class="desc">
                            <h3>Finish</h3>
                            <h4>Go to Home</h4>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

        <!-- Barre de navigation -->
        <nav id="left-sidebar" class="sidebar">
            <h5 class="brand-name">Gestion des Évaluations</h5>
            <ul class="metismenu">
                        <li><a href="index.php"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>
                        <li><a href="professors.php"><i class="fa fa-black-tie"></i><span>Professors</span></a></li>
                        <li><a href="staff.php"><i class="fa fa-user-circle-o"></i><span>Staff</span></a></li>
                        <li><a href="students.php"><i class="fa fa-users"></i><span>Users</span></a></li>
                        <li><a href="departments.php"><i class="fa fa-users"></i><span>Students</span></a></li>
                                                <li><a href="listecoursB.php"><i class="fa fa-graduation-cap"></i><span>Courses</span></a></li> 
                        <li><a href="listecertif.php"><i class="fa fa-flag"></i><span>Certification</span></a></li>                         
                        <li><a href="library.php"><i class="fa fa-book"></i><span>offres</span></a></li>
                        <li><a href="holiday.php"><i class="fa fa-bullhorn"></i><span>commandes</span></a></li>
                        <li class="g_heading">Extra</li>
                        <li><a href="view-reponse.php"><i class="fa fa-comments-o"></i><span>Reponses Rec</span></a></li>
                        <li><a href="app-contact.php"><i class="fa fa-address-book"></i><span>Reclamations</span></a></li>
                        <li class="active"><a href="evaluation.php?action=listeEvaluations"><i class="fa fa-list"></i><span>Liste des Évaluations</span></a></li>
                        <li><a href="evaluation.php?action=addExercise"><i class="fa fa-plus"></i><span>Ajouter une Évaluation</span></a></li>
                        <li><a href="evaluation.php?action=listeReponses"><i class="fa fa-list"></i> Liste des Réponses</a>
                    </ul>
        </nav>

        <!-- Contenu principal -->
        <main class="page">
            <div class="section-body">
                <div class="container-fluid">
                    <?php
                    // Gestion des actions
                    switch ($action) {
                        case 'listeEvaluations':
                            include 'liste_evaluations.php';
                            break;
                            case 'deleteEvaluation':
                                include 'delete_evaluation.php';
                                break;
                        
                            case 'viewEvaluation':
                                include 'view_evaluation.php';
                                break;
                        
                            case 'updateEvaluation':
                                include 'update_evaluation.php';
                                break;
                                case 'listeEvaluationsUser':
                                    include 'liste_evaluations_user.php';
                                    break;
                        case 'addExercise':
                            include 'add_exercise.php';
                            break;
                        case 'createExercise':
                            include 'create_exercise.php';
                            break;
                        case 'submitExercise':
                            include 'submit_exercise.php';
                            break;
                            case 'listeReponses':
                                include 'liste_reponses.php';
                                break;
                        case 'correctReponse':
                            include 'correct_reponse.php';
                            break;
                            case 'deleteReponse':
                                include 'delete_reponse.php';
                                break;
                        default:
                            echo '<h4>Erreur : Action non reconnue</h4>';
                            break;
                    }
                    ?>
                </div>
            </div>
        </main>

        <!-- Pied de page -->
    </div>
</div>
    <!-- Scripts JS -->
    <script src="../../../assets/bundles/lib.vendor.bundle.js"></script>
    <script src="../../../assets/js/core.js"></script>
</body>
</html>
