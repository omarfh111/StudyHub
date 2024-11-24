<?php
    // Vérifiez si un cookie "user_name" existe pour préremplir le champ email
    $email = isset($_COOKIE['user_name']) ? $_COOKIE['user_name'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudyHub</title>
    <link rel="icon" type="image/x-icon" href="images/StudyHub.ico" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
<div class="from-container">
        <div class="col col-1">
            <div class="image-layer">
                <!--<img src="img/white-outline.png" class="form-image-main">-->
                <!--<img src="img/dots.png" class="from-image dots">-->
                <!--<img src="img/coin.png" class="from-image coins">-->
                <!--<img src="img/spring.png" class="from-image spring">-->
                <img src="images/rocket.png" class="from-image-main">
                <!--<img src="img/cloud.png" class="from-image cloud">-->
                <!--<img src="img/stars.png" class="from-image stars">-->

            </div>
            <p class="featured-words">vivez le mode d education en ligne avec <span>StudyHub</span></p>
        </div>
        <div class="col col-2">
            <div class="btn-box">
                <button class="btn btn-1" id="login">S'identifier</button>
                <button class="btn btn-2" id="register">S'inscrire</button>
            </div>
            <div class="login-form">
                <div class="form-title">
                    <span>S'identifier</span>
                </div>
                <div class="alert-box">
                    <?php if (!empty($alert)) : ?>
                        <div class="alert alert-danger custom-alert" role="alert">
                            <i class="bx bx-error-circle"></i>
                            <?= htmlspecialchars($alert); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <form action="acces.php" method="post" class="form-inputs" id="loginform">
                <div class="form-inputs">
                    <div class="input-box">
                        <input type="text" class="input-field" placeholder="Nom d'utilisateur" name="email" required>
                        <i class="bx bx-user icon"></i>
                     </div>
                        <div class="input-box">
                            <input type="password" class="input-field" placeholder="Mot de passe" name="mdp" required>
                            <i class="bx bx-lock-alt icon"></i>
                        </div>
                    <div class="forgot-pass">
                        <a href="#">Mot de passe oublié ?</a>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="remember" id="remember" value="1">
                        <label for="remember" class="form-check-label">Se souvenir de moi</label>
                    </div>
                    <div class="input-box">
                        <button type="submit" class="input-submit">
                            <span>S'identifier</span>
                            <i class="bx bx-right-arrow-alt"></i>
                        </button>
                    </div>
                </div>
                </form>
            </div>
            <div class="register-form">
                <div class="form-title">
                    <span>S'inscrire</span>
                </div>
                <form action="adduser.php" method="post" class="form-inputs" id="registerform">
                    <div class="form-inputs">
                        <div classe="input-box">
                            <input type="text" class="name" placeholder="Nom" id="nom" name = "nom" required>
                            <input type="text" class="name2" placeholder="Prenom" id="prenom" name="prenom" required>
                        </div>
                        <div class="input-box">
                            <input type="text" class="input-field" placeholder="Email" id="email" name="email" required>
                        </div>
                        <div classe="input-box">
                            <input type="date" class="name" placeholder="Date de Naissance" id="naissance" name="naissance" required>
                            <input type="text" class="name2" placeholder="Numero tel" id ="tel" name="tel" required>
                        </div>
                        <div class="input-box">
                            <input type="password" class="input-field" placeholder="Mot de passe" id ="mdp" name="mdp" required>
                        </div>
                        <div class="input-box">
                            <input type="password" class="input-field" placeholder="Confirmer Mot de passe" id="confirmermdp" name="confirmermdp" required>
                        </div>
                        <div class="input-box">
                            <input type="submit" value ="S'inscrire" class="input-submit">
                                <i class="bx bx-right-arrow-alt"></i>
                        </div>
                    </div>
                </form>
            </div>
        </div> 
    
    </div>
    <script src="js/check.js"></script>
    <script src="js/login.js"></script>
</body>
</html>

