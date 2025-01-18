<?php
require_once 'C:\xampp\htdocs\login6\Model\cours.php';
require_once 'C:\xampp\htdocs\login6\config.php';

class CoursController {
 

    // Méthode pour récupérer tous les cours
    public function getAllCours() {
        $db = config::getConnexion();
        $sql = "SELECT * FROM cours";
        try {
            $stmt = $db->query($sql);
            return $stmt;
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la récupération des cours : " . $e->getMessage());
        }
    }

    // Méthode pour ajouter un cours
   
    public function addCours($titre_c, $description_c, $niveau, $nombre_consultation, $duree, $contenu, $position,$id_certif) {
        $course = new Cours($titre_c, $description_c, $niveau, $nombre_consultation, $duree, $contenu, $position,$id_certif
        );

        return $course->save();
    }


    // Méthode pour supprimer un cours
    public function deleteCourse($idc) {
        $sql = "DELETE FROM cours WHERE idc = :idc";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':idc', $idc);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

         public function getCoursById($idc) {
        $db = Config::getConnexion();
        $sql = "SELECT * FROM cours WHERE idc = :idc";
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':idc', $idc, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ?: null; // Retourne null si aucun cours n'est trouvé
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la récupération du cours : " . $e->getMessage());
        }
    }
    
    

    // Méthode pour mettre à jour un cours
    public function updateCours($cours, $idc) {
        var_dump($cours);

        try {
            $db = config::getConnexion();

            $query = $db->prepare(
                'UPDATE cours SET 
                    titre_c = :titre_c,
                    description_c = :description_c,
                    niveau = :niveau,
                    nombre_consultation = :nombre_consultation,
                    duree = :duree,
                    contenu = :contenu,
                    position = :position,
                    id_certif = :id_certif
                WHERE idc = :idc'
            );

            $query->execute([
                'idc' => $idc,
                'titre_c' => $cours->gettitre_c(),
                'description_c' => $cours->getdescription_c(),
                'niveau' => $cours->getniveau(),
                'nombre_consultation' => $cours->getnombre_consultation(),
                'duree' => $cours->getduree(),
                'contenu' => $cours->getcontenu(),
                'position' => $cours->getposition(),
                'id_certif' => $cours->getid_certif()
            ]);

            echo $query->rowCount();
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }
    public function getAllCertifications() {
        $db = config::getConnexion();
        $sql = "SELECT id_certif, detail FROM certif";  // Récupérer uniquement les certificats
        try {
            $stmt = $db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);  // Retourne toutes les certifications
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la récupération des certifications : " . $e->getMessage());
        }
    }
    // Méthode pour exporter les cours en Excel
    public function exportToExcel() {
        $list = $this->getAllCours();

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
    }


    
}
?>
