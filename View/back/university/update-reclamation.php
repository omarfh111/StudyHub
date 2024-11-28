<?php
require_once 'C:\xampp\htdocs\WebProject\config.php';
require_once 'C:\xampp\htdocs\WebProject\Controller\reclamationC.php';


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $controller = new ReclamationController();
    $reclamation = $controller->getReclamationById($id);  // Récupérer la réclamation depuis la base de données
    if (!$reclamation) {
        // Si la réclamation n'existe pas, rediriger vers la page d'erreur
        header("Location: app-contact.php?message=notfound");
        exit();
    }
} else {
    // Rediriger si l'ID est manquant
    header("Location: app-contact.php?message=error");
    exit();
}

// Vérifier si les données du formulaire ont été envoyées
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Créer l'objet de réclamation et le remplir avec les données
    $reclamation = new Reclamation();
    $reclamation->setNom($_POST['nom']);
    $reclamation->setPrenom($_POST['prenom']);
    $reclamation->setEmail($_POST['email']);
    $reclamation->setDate(new DateTime($_POST['date']));
    $reclamation->setObjet($_POST['objet']);
    $reclamation->setMessage($_POST['message']);

    // Valider la réclamation avant de la mettre à jour
    try {
        $reclamation->validate();
        $controller->updateReclamation($reclamation, $id);
    } catch (InvalidArgumentException $e) {
        // Afficher un message d'erreur si la validation échoue
        echo $e->getMessage();
    }
}


?>

<!-- Formulaire de mise à jour -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mettre à jour la réclamation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJ6E+czn8YhI6+5QkDo3sqE9o4YfEgt1PnxM6QtcxQ5PCc2tqk1zGJW8jpzE" crossorigin="anonymous">
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Arial', sans-serif;
        }
        .container {
            max-width: 800px;
            margin-top: 50px;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        .form-group label {
            font-weight: bold;
            color: #333;
        }
        .form-control {
            border-radius: 5px;
            box-shadow: none;
            border: 1px solid #ccc;
        }
        .form-control:focus {
            border-color: #66afe9;
            box-shadow: 0 0 8px rgba(102, 175, 233, 0.6);
        }
        button[type="submit"] {
            background-color: #007bff;
            border: none;
            color: white;
            font-size: 16px;
            padding: 10px 20px;
            border-radius: 5px;
            width: 100%;
            cursor: pointer;
        }
        button[type="submit"]:hover {
            background-color: #0056b3;
        }
        .form-group {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Mettre à jour la réclamation</h2>
    <form action="update-reclamation.php?id=<?php echo $id; ?>" method="POST">
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" value="<?php echo isset($reclamation) ? $reclamation->getNom() : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="prenom">Prénom</label>
            <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo isset($reclamation) ? $reclamation->getPrenom() : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($reclamation) ? $reclamation->getEmail() : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" class="form-control" id="date" name="date" value="<?php echo isset($reclamation) && $reclamation->getDate() ? $reclamation->getDate()->format('Y-m-d') : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="objet">Objet</label>
            <input type="text" class="form-control" id="objet" name="objet" value="<?php echo isset($reclamation) ? $reclamation->getObjet() : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="message">Message</label>
            <textarea class="form-control" id="message" name="message" rows="4" required><?php echo isset($reclamation) ? $reclamation->getMessage() : ''; ?></textarea>
        </div>
        <button type="submit">Mettre à jour</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>