<?php // Doit être en tout premier
require_once 'C:\xampp\htdocs\login6\controller\usercontroller.php';
session_start();
if (isset($_COOKIE['studyhub'])) {
    // Décoder les données du cookie
    $userData = json_decode($_COOKIE['studyhub'], true);

    $email = $userData['email'];
    $nom = $userData['nom'];
    $role = $userData['role'];
} else {
    header('Location: /login6/view/login.php');
    exit();
}
//error_reporting(E_ALL & ~E_WARNING);
$userC = new UserController();
$liste = $userC->listuser();
$key='00';
function decryptPassword($encryptedPassword, $key) {

    $cipherMethod = 'AES-256-CBC';

    // Decode the base64 encoded string
    $data = base64_decode($encryptedPassword);

    // Extract the initialization vector and encrypted password
    $ivLength = openssl_cipher_iv_length($cipherMethod);
    $iv = substr($data, 0, $ivLength);
    $encryptedPassword = substr($data, $ivLength);

    // Decrypt the password
    $decryptedPassword = openssl_decrypt($encryptedPassword, $cipherMethod, $key, 0, $iv);

    return $decryptedPassword;
}
?>
<!doctype html>
<html lang="en" dir="ltr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="icon" href="favicon.ico" type="image/x-icon"/>
<title>:: Ericsson :: Students</title>

<!-- Bootstrap Core and vandor -->
<link rel="stylesheet" href="../assets/plugins/bootstrap/css/bootstrap.min.css" />
<link rel="stylesheet" href="../assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">
<link rel="stylesheet" href="../assets/plugins/dropify/css/dropify.min.css">
<link rel="stylesheet" href="../assets/plugins/summernote/dist/summernote.css"/>
<link rel="stylesheet" href="../assets/plugins/sweetalert/sweetalert.css">

<!-- Core css -->
<link rel="stylesheet" href="../assets/css/style.min.css"/>
</head>

<body class="font-muli theme-blush">

<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
    </div>
</div>

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
            </div>
        </div>
    </div>
    <!-- Start Theme panel do not add in project -->
    <div class="theme_div">
        <div class="card">
            <div class="card-body">
                <ul class="list-group list-unstyled">
                    <li class="list-group-item mb-2">
                        <p>Light Version</p>
                        <a href="../university/index.html"><img src="../assets/images/themes/default.png" class="img-fluid" alt="" /></a>
                    </li>
                    <li class="list-group-item mb-2">
                        <p>Dark Version</p>
                        <a href="../university-dark/index.html"><img src="../assets/images/themes/dark.png" class="img-fluid" alt="" /></a>
                    </li>
                    <li class="list-group-item mb-2">
                        <p>RTL Version</p>
                        <a href="../university-rtl/index.html"><img src="../assets/images/themes/rtl.png" class="img-fluid" alt="" /></a>
                    </li>
                </ul>
            </div>
        </div>        
    </div>
    <!-- Start Quick menu with more functio -->
    <!-- Start Main leftbar navigation -->
    <div id="left-sidebar" class="sidebar">
        <h5 class="brand-name">Ericsson<a href="javascript:void(0)" class="menu_option float-right"><i class="icon-grid font-16" data-toggle="tooltip" data-placement="left" title="Grid & List Toggle"></i></a></h5>
        <ul class="nav nav-tabs">
            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#menu-uni">University</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#menu-admin">Admin</a></li>
        </ul>
        <div class="tab-content mt-3">
            <div class="tab-pane fade show active" id="menu-uni" role="tabpanel">
                <nav class="sidebar-nav">
                    <ul class="metismenu">
                        <li><a href="index.php"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>
                        <li><a href="professors.php"><i class="fa fa-black-tie"></i><span>Professors</span></a></li>
                        <li><a href="staff.php"><i class="fa fa-user-circle-o"></i><span>Staff</span></a></li>
                        <li class="active"><a href="students.php"><i class="fa fa-users"></i><span>Users</span></a></li>
                        <li><a href="departments.php"><i class="fa fa-users"></i><span>Students</span></a></li>
                        <li><a href="courses.html"><i class="fa fa-graduation-cap"></i><span>Courses</span></a></li>                        
                        <li><a href="library.html"><i class="fa fa-book"></i><span>Library</span></a></li>
                        <li><a href="holiday.html"><i class="fa fa-bullhorn"></i><span>Holiday</span></a></li>
                        <li class="g_heading">Extra</li>
                        <li><a href="events.html"><i class="fa fa-calendar"></i><span>Calender</span></a></li>
                        <li><a href="app-chat.html"><i class="fa fa-comments-o"></i><span>Chat App</span></a></li>
                        <li><a href="app-contact.html"><i class="fa fa-address-book"></i><span>Contact</span></a></li>
                        <li><a href="app-filemanager.html"><i class="fa fa-folder"></i><span>FileManager</span></a></li>
                        <li><a href="our-centres.html"><i class="fa fa-map"></i><span>OurCentres</span></a></li>
                        <li><a href="gallery.html"><i class="fa fa-camera-retro"></i><span>Gallery</span></a></li>
                    </ul>
                </nav>
            </div>
            <div class="tab-pane fade" id="menu-admin" role="tabpanel">
                <nav class="sidebar-nav">
                    <ul class="metismenu">
                        <li><a href="payments.html"><i class="fa fa-credit-card"></i><span>Payments</span></a></li>
                        <li><a href="noticeboard.html"><i class="fa fa-dashboard"></i><span>Noticeboard</span></a></li>
                        <li><a href="taskboard.html"><i class="fa fa-list-ul"></i><span>Taskboard</span></a></li>
                        <li><a href="hostel.html"><i class="fa fa-bed"></i><span>Hostel</span></a></li>
                        <li><a href="transport.html"><i class="fa fa-truck"></i><span>Transport</span></a></li>
                        <li><a href="attendance.html"><i class="fa fa-calendar-check-o"></i><span>Attendance</span></a></li>
                        <li><a href="leave.html"><i class="fa fa-flag"></i><span>Leave</span></a></li>
                        <li><a href="setting.html"><i class="fa fa-gear"></i><span>Settings</span></a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <!-- Start project content area -->
    <div class="page">
        <!-- Start Page header -->
        <div class="section-body" id="page_top" >
            <div class="container-fluid">
                <div class="page-header">
                    <div class="left">                        
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="What you want to find">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button">Search</button>
                            </div>
                        </div>
                    </div>
                    <div class="right">
                        <div class="notification d-flex">
                            <div class="dropdown d-flex">
                                <a class="nav-link icon d-none d-md-flex btn btn-default btn-icon ml-1" data-toggle="dropdown"><i class="fa fa-language"></i></a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                    <a class="dropdown-item" href="#"><img class="w20 mr-2" src="../assets/images/flags/us.svg" alt="">English</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#"><img class="w20 mr-2" src="../assets/images/flags/es.svg" alt="">Spanish</a>
                                    <a class="dropdown-item" href="#"><img class="w20 mr-2" src="../assets/images/flags/jp.svg" alt="">japanese</a>
                                    <a class="dropdown-item" href="#"><img class="w20 mr-2" src="../assets/images/flags/bl.svg" alt="">France</a>
                                </div>
                            </div>
                            <div class="dropdown d-flex">
                                <a href="javascript:void(0)" class="chip ml-3" data-toggle="dropdown">
                                    <span class="avatar" style="background-image: url(../assets/images/xs/avatar5.jpg)"></span> <?php echo $nom . " (" . $role . ")"; ?></a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                    <a class="dropdown-item" href="page-profile.html"><i class="dropdown-icon fe fe-user"></i> Profile</a>
                                    <a class="dropdown-item" href="app-setting.html"><i class="dropdown-icon fe fe-settings"></i> Settings</a>
                                    <a class="dropdown-item" href="app-email.html"><span class="float-right"><span class="badge badge-primary">6</span></span><i class="dropdown-icon fe fe-mail"></i> Inbox</a>
                                    <a class="dropdown-item" href="javascript:void(0)"><i class="dropdown-icon fe fe-send"></i> Message</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="javascript:void(0)"><i class="dropdown-icon fe fe-help-circle"></i> Need help?</a>
                                    <a class="dropdown-item" href="login.html"><i class="dropdown-icon fe fe-log-out"></i> Sign out</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Start Page title and tab -->
        <div class="section-body">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center ">
                    <div class="header-action">
                        <h1 class="page-title">Students</h1>
                        <ol class="breadcrumb page-breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Ericsson</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Students</li>
                        </ol>
                    </div>
                    <ul class="nav nav-tabs page-header-tab">
                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#Student-all">List View</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Student-profile">Profile</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Student-add">Add</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <?php
require_once 'C:\xampp\htdocs\login6\config.php';

// Initialiser $filters
$filters = [
    'nom' => '',
    'prenom' => '',
    'email' => '',
    'tel' => '',
];

// Récupérer les données GET si elles existent
if (isset($_GET['nom']) || isset($_GET['prenom']) || isset($_GET['email']) || isset($_GET['tel'])) {
    $filters['nom'] = $_GET['nom'] ?? '';
    $filters['prenom'] = $_GET['prenom'] ?? '';
    $filters['email'] = $_GET['email'] ?? '';
    $filters['tel'] = $_GET['tel'] ?? '';
}

// Appeler une fonction (fetchUsers) pour récupérer les utilisateurs en fonction des filtres
$liste = fetchUsers($filters);

function fetchUsers($filters)
{
    $db = config::getConnexion();

    // Construire la requête SQL avec des conditions dynamiques
    $conditions = [];
    $params = [];

    if (!empty($filters['nom'])) {
        $conditions[] = "nom LIKE :nom";
        $params[':nom'] = "%" . $filters['nom'] . "%";
    }

    if (!empty($filters['prenom'])) {
        $conditions[] = "prenom LIKE :prenom";
        $params[':prenom'] = "%" . $filters['prenom'] . "%";
    }

    if (!empty($filters['email'])) {
        $conditions[] = "email LIKE :email";
        $params[':email'] = "%" . $filters['email'] . "%";
    }

    if (!empty($filters['tel'])) {
        $conditions[] = "tel LIKE :tel";
        $params[':tel'] = "%" . $filters['tel'] . "%";
    }

    // Ajouter les conditions à la requête SQL
    $sql = "SELECT * FROM user";
    if (count($conditions) > 0) {
        $sql .= " WHERE " . implode(" AND ", $conditions);
    }

    try {
        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
        return [];
    }
}
?>
        <div class="section-body mt-4">
            <div class="container-fluid">
                <div class="tab-content">
                    <div class="tab-pane active" id="Student-all">
                        <div class="card">
                            <div class="card-body">
                            <div class="row">
                    <form method="GET" action="students.php" class="d-flex flex-wrap">
                        <div class="col-lg-2 col-md-4 col-sm-6">
                            <div class="input-group">
                                <input type="text" name="nom" class="form-control" placeholder="Nom">
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6">
                            <div class="input-group">
                                <input type="text" name="prenom" class="form-control" placeholder="Prénom">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <div class="input-group">
                                <input type="text" name="email" class="form-control" placeholder="Email">
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6">
                            <div class="input-group">
                                <input type="text" name="tel" class="form-control" placeholder="Téléphone">
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6">
                            <button type="submit" class="btn btn-sm btn-primary btn-block">Rechercher</button>
                        </div>
                    </form>
                </div>

                            </div>
                        </div>
                        <div class="table-responsive card">
                        <div class="mb-3">
                            <a href="/login6/view/back/university/pdf.php" class="btn btn-success btn-sm">
                                telecharger en format PDF
                            </a>
                        </div>
                            <table class="table table-hover table-vcenter table-striped mb-0 text-nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nom</th>
                                        <th>Prénom</th>
                                        <th>Email</th>
                                        <th>Date de naissance</th>
                                        <th>Téléphone</th>
                                        <th>Status</th>
                                        <th>Rôle</th>
                                        <th>Mot de passe</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($liste)): ?>
                                        <?php foreach ($liste as $user):
                                            $decryptedPassword = decryptPassword($user['mdp'], $key); ?>
                                            <tr>
                                                <td><?= htmlspecialchars($user['idu']); ?></td>
                                                <td><?= htmlspecialchars($user['nom']); ?></td>
                                                <td><?= htmlspecialchars($user['prenom']); ?></td>
                                                <td><?= htmlspecialchars($user['email']); ?></td>
                                                <td><?= htmlspecialchars($user['naissance']); ?></td>
                                                <td><?= htmlspecialchars($user['tel']); ?></td>
                                                <td><?= htmlspecialchars($user['metier']); ?></td>
                                                <td><?= htmlspecialchars($user['rol']); ?></td>
                                                <td><?= htmlspecialchars($decryptedPassword); ?></td>
                                                <td>
                                                <?php if ($user['metier'] === 'ban'): ?>
                                                    <a href="/login6/view/update_status.php?idu=<?= $user['idu']; ?>&action=unban" class="btn btn-success btn-sm">
                                                        Unban
                                                    </a>
                                                <?php else: ?>
                                                    <a href="/login6/view/update_status.php?idu=<?= $user['idu']; ?>&action=ban" class="btn btn-danger btn-sm">
                                                        Ban
                                                    </a>
                                                <?php endif; ?>
                                            </td>
                                            <td class="actions">
                                                <a class="btn btn-icon btn-sm" title="Edit" href="/login6/view/edit.php?idu=<?= $user['idu']; ?>"><i class="fa fa-edit"></i></a>
                                                <a class="btn btn-icon btn-sm js-sweetalert" title="Delete" href="/login6/view/deluser.php?idu=<?php echo $user['idu']; ?>"><i class="fa fa-trash-o text-danger"></i></a>
                                            </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="9" class="text-center">Aucun utilisateur trouvé</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="tab-pane" id="Student-profile">
                        <div class="row">
                            <div class="col-xl-4 col-md-12">
                                <div class="card">
                                    <div class="card-body w_user">
                                        <div class="user_avtar">
                                            <img class="rounded-circle" src="../assets/images/sm/avatar2.jpg" alt="">
                                        </div>
                                        <div class="wid-u-info">
                                            <h5>Dessie Parks</h5>
                                            <p class="text-muted m-b-0">119 Peepee Way, Hilo, HI, 96720</p>
                                            <ul class="list-unstyled">
                                                <li>
                                                    <h5 class="mb-0">270</h5>
                                                    <small>Followers</small>
                                                </li>
                                                <li>
                                                    <h5 class="mb-0">310</h5>
                                                    <small>Following</small>
                                                </li>
                                                <li>
                                                    <h5 class="mb-0">908</h5>
                                                    <small>Liks</small>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">About Me</h3>
                                        <div class="card-options ">
                                            <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                                            <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                                        </div>
                                    </div>
									<div class="card-body">
										<p>Hello I am Celena Anderson a Clerk in Xyz College USA. I love to work with all my college staff and seniour professors.</p>
										<ul class="list-group">
                                            <li class="list-group-item">
                                                <b>Gender </b>
                                                <div class="pull-right">Female</div>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Department</b>
                                                <div class="pull-right">Mechanical</div>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Email </b>
                                                <div class="pull-right">test@example.com</div>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Phone</b>
                                                <div class="pull-right">1234567890</div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="clearfix">
                                                    <div class="float-left"><strong>Study</strong></div>
                                                    <div class="float-right"><small class="text-muted">35%</small></div>
                                                </div>
                                                <div class="progress progress-xxs">
                                                    <div class="progress-bar bg-pink" role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="clearfix">
                                                    <div class="float-left"><strong>Cricket</strong></div>
                                                    <div class="float-right"><small class="text-muted">72%</small></div>
                                                </div>
                                                <div class="progress progress-xxs">
                                                    <div class="progress-bar bg-blue" role="progressbar" style="width: 72%" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="clearfix">
                                                    <div class="float-left"><strong>Music</strong></div>
                                                    <div class="float-right"><small class="text-muted">60%</small></div>
                                                </div>
                                                <div class="progress progress-xxs">
                                                    <div class="progress-bar bg-green" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="row">
											<div class="col-md-4 col-sm-4 col-6">
												<div class="font-18 font-weight-bold">37</div>
												<div>Projects</div>
											</div>
											<div class="col-md-4 col-sm-4 col-6">
												<div class="font-18 font-weight-bold">51</div>
												<div>Tasks</div>
											</div>
											<div class="col-md-4 col-sm-4 col-6">
												<div class="font-18 font-weight-bold">61</div>
												<div>Uploads</div>
											</div>
										</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-8 col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Timeline Activity</h3>
                                        <div class="card-options">
                                            <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                                            <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
                                            <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                                            <div class="item-action dropdown ml-2">
                                                <a href="javascript:void(0)" data-toggle="dropdown"><i class="fe fe-more-vertical"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-eye"></i> View Details </a>
                                                    <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-share-alt"></i> Share </a>
                                                    <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-cloud-download"></i> Download</a>                                            
                                                    <div class="dropdown-divider"></div>
                                                    <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-copy"></i> Copy to</a>
                                                    <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-folder"></i> Move to</a>
                                                    <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-edit"></i> Rename</a>
                                                    <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-trash"></i> Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="summernote">
                                            Hello there,
                                            <br/>
                                            <p>The toolbar can be customized and it also supports various callbacks such as <code>oninit</code>, <code>onfocus</code>, <code>onpaste</code> and many more.</p>
                                            <p>Please try <b>paste some texts</b> here</p>
                                        </div>
                                        <div class="timeline_item ">
                                            <img class="tl_avatar" src="../assets/images/xs/avatar1.jpg" alt="" />
                                            <span><a href="javascript:void(0);">Elisse Joson</a> San Francisco, CA <small class="float-right text-right">20-April-2024 - Today</small></span>
                                            <h6 class="font600">Hello, 'Im a single div responsive timeline without media Queries!</h6>
                                            <div class="msg">
                                                <p>I'm speaking with myself, number one, because I have a very good brain and I've said a lot of things. I write the best placeholder text, and I'm the biggest developer on the web card she has is the Lorem card.</p>
                                                <a href="javascript:void(0);" class="mr-20 text-muted"><i class="fa fa-heart text-pink"></i> 12 Love</a>
                                                <a class="text-muted" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-comments"></i> 1 Comment</a>
                                                <div class="collapse p-4 section-gray mt-2" id="collapseExample">
                                                    <form class="well">
                                                        <div class="form-group">
                                                            <textarea rows="2" class="form-control no-resize" placeholder="Enter here for tweet..."></textarea>
                                                        </div>
                                                        <button class="btn btn-primary">Submit</button>
                                                    </form>
                                                    <ul class="recent_comments list-unstyled mt-4 mb-0">
                                                        <li>
                                                            <div class="avatar_img">
                                                                <img class="rounded img-fluid" src="../assets/images/xs/avatar4.jpg" alt="">
                                                            </div>
                                                            <div class="comment_body">
                                                                <h6>Donald Gardner <small class="float-right font-14">Just now</small></h6>
                                                                <p>Lorem ipsum Veniam aliquip culpa laboris minim tempor</p>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>                                
                                        </div>
                                        <div class="timeline_item ">
                                            <img class="tl_avatar" src="../assets/images/xs/avatar4.jpg" alt="" />
                                            <span><a href="javascript:void(0);" title="">Dessie Parks</a> Oakland, CA <small class="float-right text-right">19-April-2024 - Yesterday</small></span>
                                            <h6 class="font600">Oeehhh, that's awesome.. Me too!</h6>
                                            <div class="msg">
                                                <p>I'm speaking with myself, number one, because I have a very good brain and I've said a lot of things. on the web by far... While that's mock-ups and this is politics, are they really so different? I think the only card she has is the Lorem card.</p>
                                                <div class="timeline_img mb-20">
                                                    <img class="width100" src="../assets/images/gallery/1.jpg" alt="Awesome Image">
                                                    <img class="width100" src="../assets/images/gallery/2.jpg" alt="Awesome Image">
                                                </div>
                                                <a href="javascript:void(0);" class="mr-20 text-muted"><i class="fa fa-heart text-pink"></i> 23 Love</a>
                                                <a class="text-muted" role="button" data-toggle="collapse" href="#collapseExample1" aria-expanded="false" aria-controls="collapseExample1"><i class="fa fa-comments"></i> 2 Comment</a>
                                                <div class="collapse p-4 section-gray mt-2" id="collapseExample1">
                                                    <form class="well">
                                                        <div class="form-group">
                                                            <textarea rows="2" class="form-control no-resize" placeholder="Enter here for tweet..."></textarea>
                                                        </div>
                                                        <button class="btn btn-primary">Submit</button>
                                                    </form>
                                                    <ul class="recent_comments list-unstyled mt-4 mb-0">
                                                        <li>
                                                            <div class="avatar_img">
                                                                <img class="rounded img-fluid" src="../assets/images/xs/avatar4.jpg" alt="">
                                                            </div>
                                                            <div class="comment_body">
                                                                <h6>Donald Gardner <small class="float-right font-14">Just now</small></h6>
                                                                <p>Lorem ipsum Veniam aliquip culpa laboris minim tempor</p>
                                                                <div class="timeline_img mb-20">
                                                                    <img class="width150" src="../assets/images/gallery/7.jpg" alt="Awesome Image">
                                                                    <img class="width150" src="../assets/images/gallery/8.jpg" alt="Awesome Image">
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="avatar_img">
                                                                <img class="rounded img-fluid" src="../assets/images/xs/avatar3.jpg" alt="">
                                                            </div>
                                                            <div class="comment_body">
                                                                <h6>Dessie Parks <small class="float-right font-14">1min ago</small></h6>
                                                                <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking</p>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>                                    
                                            </div>
                                        </div>
                                        <div class="timeline_item ">
                                            <img class="tl_avatar" src="../assets/images/xs/avatar7.jpg" alt="" />
                                            <span><a href="javascript:void(0);" title="" >Rochelle Barton</a> San Francisco, CA <small class="float-right text-right">12-April-2024</small></span>
                                            <h6 class="font600">An Engineer Explains Why You Should Always Order the Larger Pizza</h6>
                                            <div class="msg">
                                                <p>I'm speaking with myself, number one, because I have a very good brain and I've said a lot of things. I write the best placeholder text, and I'm the biggest developer on the web by far... While that's mock-ups and this is politics, is the Lorem card.</p>
                                                <a href="javascript:void(0);" class="mr-20 text-muted"><i class="fa fa-heart text-pink"></i> 7 Love</a>
                                                <a class="text-muted" role="button" data-toggle="collapse" href="#collapseExample2" aria-expanded="false" aria-controls="collapseExample2"><i class="fa fa-comments"></i> 1 Comment</a>
                                                <div class="collapse p-4 section-gray mt-2" id="collapseExample2">
                                                    <form class="well">
                                                        <div class="form-group">
                                                            <textarea rows="2" class="form-control no-resize" placeholder="Enter here for tweet..."></textarea>
                                                        </div>
                                                        <button class="btn btn-primary">Submit</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="Student-add">
                        <div class="row clearfix">
                            <div class="col-lg-8 col-md-12 col-sm-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Basic Information</h3>
                                        <div class="card-options ">
                                            <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                                            <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                                        </div>
                                    </div>
                                    <form action="/view/edit.php" method="post" class="card-body">
                                        <div class="form-group row">
                                            <label for="nom" class="col-md-3 col-form-label">Nom <span class="text-danger">*</span></label>
                                            <div class="col-md-9">
                                                <input  type="text" id="nom" name="nom" value="<?= htmlspecialchars($user['nom']); ?>" class="form-control" placeholder="Enter non a change">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="prenom" class="col-md-3 col-form-label">Prenom <span class="text-danger">*</span></label>
                                            <div class="col-md-9">
                                                <input type="text" id="prenom" name="prenom" value="<?= htmlspecialchars($user['prenom']); ?>" class="form-control" placeholder="Enter prenom a change">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="email" class="col-md-3 col-form-label">Email <span class="text-danger">*</span></label>
                                            <div class="col-md-9">
                                                <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']); ?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="naissance" class="col-md-3 col-form-label">Date de naissance</label>
                                            <div class="col-md-9">
                                                <input type="date" id="naissance" name="naissance" value="<?= htmlspecialchars($user['naissance']); ?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="tel" class="col-md-3 col-form-label">Téléphone <span class="text-danger">*</span></label>
                                            <div class="col-md-9">
                                                <input data-provide="datepicker" data-date-autoclose="true" class="form-control" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="metier" class="col-md-3 col-form-label">Metier <span class="text-danger">*</span></label>
                                            <div class="col-md-9">
                                                <input type="text" id="metier" name="metier" value="<?= htmlspecialchars($user['metier']); ?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="newmdp" class="col-md-3 col-form-label">Nouveau Mot de Passe <span class="text-danger">*</span></label>
                                            <div class="col-md-9">
                                                <input type="password" id="mdp" name="mdp"  value="<?= htmlspecialchars($user['mdp']); ?>" placeholder="Laissez vide pour conserver l'ancien mot de passe" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for ="role" class="col-md-3 col-form-label">Role <span class="text-danger">*</span></label>
                                            <div class="col-md-9">
                                                <select id="role" class="form-control input-height" name="role">
                                                    <option value="">Select...</option>
                                                    <option value="admin" <?= $user['rol'] === 'admin' ? 'selected' : ''; ?>>Admin</option>
                                                    <option value="prof" <?= $user['rol'] === 'prof' ? 'selected' : ''; ?>>Prof</option>
                                                    <option value="etudiant" <?= $user['rol'] === 'etudiant' ? 'selected' : ''; ?>>Etudiant</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">Profile Picture</label>
                                            <div class="col-md-9">
                                                <input type="file" class="dropify">
                                                <small id="fileHelp" class="form-text text-muted">This is some placeholder block-level help text for the above input. It's a bit lighter and easily wraps to a new line.</small>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12 col-sm-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Account Information</h3>
                                        <div class="card-options ">
                                            <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                                            <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row clearfix">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>User Name</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Password</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Confirm Password</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                <button type="submit" class="btn btn-outline-secondary">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Account Information</h3>
                                        <div class="card-options ">
                                            <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                                            <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Facebook</label>
                                            <input type="text" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Twitter</label>
                                            <input type="text" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>LinkedIN</label>
                                            <input type="text" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Behance</label>
                                            <input type="text" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>dribbble</label>
                                            <input type="text" class="form-control">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <button type="submit" class="btn btn-outline-secondary">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Start main footer -->
        <div class="section-body">
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            Copyright © 2024 <a href="https://themeforest.net/user/puffintheme/portfolio">PuffinTheme</a>.
                        </div>
                        <div class="col-md-6 col-sm-12 text-md-right">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item"><a href="../doc/index.html">Documentation</a></li>
                                <li class="list-inline-item"><a href="javascript:void(0)">FAQ</a></li>
                                <li class="list-inline-item"><a href="javascript:void(0)" class="btn btn-outline-primary btn-sm">Buy Now</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>    
</div>

<!-- Start Main project js, jQuery, Bootstrap -->
<script src="../assets/bundles/lib.vendor.bundle.js"></script>

<!-- Start Plugin Js -->
<script src="../assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="../assets/plugins/dropify/js/dropify.min.js"></script>
<script src="../assets/bundles/summernote.bundle.js"></script>
<script src="../assets/plugins/sweetalert/sweetalert.min.js"></script>

<!-- Start project main js  and page js -->
<script src="../assets/js/core.js"></script>
<script src="assets/js/form/dropify.js"></script>
<script src="assets/js/page/summernote.js"></script>
<script src="assets/js/page/dialogs.js"></script>
</body>
</html>
