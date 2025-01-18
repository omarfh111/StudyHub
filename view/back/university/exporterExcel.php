<?php
include 'C:\xampp\htdocs\login6\Controller\CoursController.php';

$CoursController = new CoursController();
$list = $CoursController->getAllCours();

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=cours_liste.xls");
header("Pragma: no-cache");
header("Expires: 0");

if (!empty($list)) {
    echo "<table border='1'>";
    echo "<thead>
            <tr>
                <th>Titre</th>
                <th>Description</th>
                <th>Niveau</th>
                <th>Nombre de consultations</th>
                <th>Durée</th>
                <th>Contenu</th>
                <th>Position</th>
            </tr>
          </thead>";
    echo "<tbody>";
    foreach ($list as $course) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($course['titre_c']) . "</td>";
        echo "<td>" . htmlspecialchars($course['description_c']) . "</td>";
        echo "<td>" . htmlspecialchars($course['niveau']) . "</td>";
        echo "<td>" . htmlspecialchars($course['nombre_consultation']) . "</td>";
        echo "<td>" . htmlspecialchars($course['duree']) . "</td>";
        echo "<td>" . htmlspecialchars($course['contenu']) . "</td>";
        echo "<td>" . htmlspecialchars($course['position']) . "</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
} else {
    echo "Aucun cours trouvé.";
}
?>
