<?php
// Démarre la capture de sortie pour éviter les erreurs de sortie prématurée
ob_start();

require_once('libs/fpdf.php');
require_once 'C:\xampp\htdocs\StudyHub\Controller\CoursController.php';

// Vérifier si l'ID du cours est passé en paramètre GET et récupérer les données du cours
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int) $_GET['id'];
    
    $coursController = new CoursController();
    $cours = $coursController->getCoursById($id);

    if ($cours === null) {
        ob_end_clean(); // Arrêter la capture de sortie avant d'envoyer une réponse
        echo "<p>Aucun cours trouvé pour l'ID : " . htmlspecialchars($id) . ".</p>";
        exit;
    }

    // Informations du cours à afficher
    $titre_c = htmlspecialchars($cours['titre_c']); // Titre du cours
    $id_certif = strtoupper(uniqid('CERTIF_')); // Génération d'un identifiant unique
    
} else {
    ob_end_clean(); // Arrêter la capture de sortie avant d'envoyer une réponse
    echo "<p>Paramètre 'id' invalide ou manquant.</p>";
    exit;
}

// Créer un objet FPDF
class PDF extends FPDF
{
    // En-tête
    function Header()
    {
        // Ajouter un arrière-plan (image)
        $this->Image('images/certificat_background.png', 0, 0, 210, 297); // Ajustez à la taille A4
    }
}

$pdf = new PDF();
$pdf->AddPage();

// Ajouter le logo
$pdf->Image('images/logo.jpg', 85, 15, 40); // Centré horizontalement

// Titre principal "CERTIFICAT"
$pdf->SetFont('Arial', 'B', 32);
$pdf->SetTextColor(0, 153, 102);
$pdf->Cell(0, 70, utf8_decode('CERTIFICAT DE FORMATION'), 0, 1, 'C');

// Texte secondaire
$pdf->SetFont('Arial', 'B', 20);
$pdf->SetTextColor(33, 37, 41);
$pdf->Cell(0, 10, utf8_decode('POUR LE COURS DE :'), 0, 1, 'C');

// Nom du cours
$pdf->SetFont('Arial', '', 18);
$pdf->Ln(5); // Espacement
$pdf->Cell(0, 10, utf8_decode($titre_c), 0, 1, 'C');

// Message de félicitations
$pdf->Ln(20);
$pdf->SetFont('Arial', '', 14);
$pdf->SetTextColor(33, 37, 41);
$pdf->MultiCell(0, 10, utf8_decode("Nous vous félicitons pour votre engagement exemplaire et pour avoir suivi avec succès l'encadrement que nous avons eu l'honneur de vous présenter."), 0, 'C');

// Signature et autres éléments
$pdf->Ln(20);

// Signature
$pdf->Image('images/signature.png', 35, 180, 40); // Exemple de signature
$pdf->SetFont('Arial', 'I', 12);
$pdf->Cell(75, 10, utf8_decode('STUDYHUB'), 0, 0, 'C');

// Badge ou médaille
$pdf->Image('images/badge.png', 95, 190, 40);

// Informations additionnelles
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, utf8_decode('SITE DE FORMATION EN LIGNE'), 0, 1, 'C');
$pdf->Cell(170, 100, '2024-2025', 0, 0, 'R');

// Spécifier le nom du fichier
$filename = 'certificate_' . $id_certif . '.pdf';

// Arrêter la capture de sortie
ob_end_clean();

// Forcer le téléchargement du fichier PDF
$pdf->Output('D', $filename); // 'D' pour télécharger
?>
