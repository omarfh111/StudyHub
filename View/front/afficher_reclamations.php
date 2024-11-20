<?php
// Inclure le contrôleur des réclamations
require_once 'C:/xampp/htdocs/WebProject/Controller/reclamationC.php';  

$controller = new ReclamationController();
$reclamations = $controller->getAllReclamations();

// Vérifier si le message de succès est présent dans l'URL
/*$successMessage = '';
if (isset($_GET['success']) && $_GET['success'] === 'true') {
    $successMessage = 'Réclamation envoyée avec succès!';
}*/
?>

<!--
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Réclamations</title>
</head>
<body>

<!-- Afficher un message de succès si la réclamation a été envoyée
<?php if ($successMessage): ?>
    <p style="color: green;"><?php echo $successMessage; ?></p>
<?php endif; ?> -->

<!--<h2>Liste des Réclamations</h2>
<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Date</th>
            <th>Objet</th>
            <th>Message</th>
        </tr>
    </thead>
    <tbody>
       <!-- 
    <?php foreach ($reclamations as $reclamation): ?>
    <tr>
        <td><?php echo $reclamation->id_rec; ?></td>
        <td><?php echo $reclamation->nom; ?></td>
        <td><?php echo $reclamation->prenom; ?></td>
        <td><?php echo $reclamation->email; ?></td>
        <td><?php echo $reclamation->date; ?></td>
        <td><?php echo $reclamation->objet; ?></td>
        <td><?php echo $reclamation->message; ?></td>
    </tr>
    <?php endforeach; ?>
-->

    </tbody>
</table>

</body>
</html>
-->
    
