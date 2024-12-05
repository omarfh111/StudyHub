<?php
require_once 'C:\xampp\htdocs\StudyHub\Model\certif.php';
require_once 'C:\xampp\htdocs\StudyHub\config.php';

class CertifController {

    // Méthode pour récupérer tous les cours
    public function getAllCertif() {
        $db = config::getConnexion();
        $sql = "SELECT * FROM certif";
        try {
            $stmt = $db->query($sql);
            return $stmt;
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la récupération des certifications : " . $e->getMessage());
        }
    }

    // Méthode pour ajouter une certification
   
    public function addCertif($detail, $certif_url) {
        $certif = new Certif($detail, $certif_url);
        

        return $certif->save();
    }


    // Méthode pour supprimer une certification
    public function deleteCertif($id_certif) {
        $sql = "DELETE FROM certif WHERE id_certif = :id_certif";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id_certif', $id_certif);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    // Méthode pour récupérer une certification par son ID
    public function getCertifById($id_certif) {
        $db = config::getConnexion();
        $sql = "SELECT * FROM certif WHERE id_certif = :id_certif";
        try {
            
            $stmt->bindParam(':id_certif', $id_certif, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la récupération de la certification : " . $e->getMessage());
        }
    }

    // Méthode pour mettre à jour une certification
    public function updateCertif($certif, $id_certif) {
        var_dump($certif);

        try {
            $db = config::getConnexion();

            $query = $db->prepare(
                'UPDATE certif SET 
                    detail = :detail,
                    certif_url = :certif_url
                WHERE id_certif = :id_certif'
            );
              

            $query->execute([
                'id_certif' => $id_certif,
                'detail' => $certif->getdetail(),
                'certif_url' => $certif->getcertif_url()
                
            ]);

            echo $query->rowCount();
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }
 
    

    // Méthode pour exporter les cours en Excel
    public function exportToExcel() {
        $list = $this->getAllCertif();

        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=certif_liste.xls");
        header("Pragma: no-cache");
        header("Expires: 0");

        if (!empty($list)) {
            echo "<table border='1'>";
            echo "<thead>
                    <tr>
                        <th>Details</th>
                        <th>URL de la certification</th>
                      
                    </tr>
                  </thead>";
            echo "<tbody>";
            foreach ($list as $certif) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($certif['detail']) . "</td>";
                echo "<td>" . htmlspecialchars($certif['certif_url']) . "</td>";
        
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
        } else {
            echo "Aucune certification trouvé.";
        }
    }
}
?>
