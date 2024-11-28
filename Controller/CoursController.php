<?php
require_once 'C:\xampp\htdocs\StudyHub_nouv\Model\cours.php';
require_once 'C:\xampp\htdocs\StudyHub_nouv\config.php';
require_once 'C:\xampp\htdocs\StudyHub_nouv\Model\cours.php';

class CoursController {
    private $Model;
    private $titre_c;
    private $description_c;
    private $niveau;
    private $nombre_consultation;
    private $duree;
    private $contenu;
    private $position;
    

    public function __construct() {
        $this->Model = new Cours();
    }

    // Méthode pour récupérer tous les cours
    public function getAllCours() {
        $db = config::getConnexion();
        $sql = "SELECT * FROM cours";
        try {
            $stmt = $db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la récupération des cours : " . $e->getMessage());
        }
    }

    // Méthode pour ajouter un cours
    public function addCourse($titre_c, $description_c, $niveau, $nombre_consultation, $duree, $contenu, $position) {
        $course = new Cours(
            config::getConnexion(),
            null,
            htmlspecialchars(strip_tags($titre_c)),
            htmlspecialchars(strip_tags($description_c)),
            htmlspecialchars(strip_tags($niveau)),
            (int) $nombre_consultation,
            (int) $duree,
            htmlspecialchars(strip_tags($contenu)),
            htmlspecialchars(strip_tags($position))
        );

        return $course->addCours();
    }

    // Méthode pour mettre à jour un cours
   /* public function updateCours($cours,$idc) {
        var_dump($cours);*/
       /* $sql = "UPDATE cours SET titre_c = :titre_c, description_c = :description_c, niveau = :niveau, 
                nombre_consultation = :nombre_consultation, duree = :duree, contenu = :contenu, position = :position
                WHERE idc = :idc";*/
      /*  try {
            $db= config::getConnexion();
            $stmt = $db->prepare("UPDATE cours SET titre_c = :titre_c, description_c = :description_c, niveau = :niveau, 
            nombre_consultation = :nombre_consultation, duree = :duree, contenu = :contenu, position = :position
            WHERE idc = :idc");
            $stmt->execute([
                ':idc' => $idc,
                ':titre_c' => $this->titre_c,
                ':description_c' => $this->description_c,
                ':niveau' => $this->niveau,
                ':nombre_consultation' => $this->nombre_consultation,
                ':duree' => $this->duree,
                ':contenu' => $this->contenu,
                ':position' => $this->position
            ]);
            return true;
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la mise à jour du cours : " . $e->getMessage());
        }
    }*/

    // Méthode pour supprimer un cours
    function deleteCourse($idc)
    {
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
    // Méthode pour récupérer un cours par son ID
    public function getCoursById($idc) {
        $db = config::getConnexion();
        $sql = "SELECT * FROM cours WHERE idc = :idc";
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':idc', $idc, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la récupération du cours : " . $e->getMessage());
        }
    }


    public function updateCours($cours, $idc) 
    {
        // Vérifiez que $cours est un objet valide
        if (!$cours) {
            throw new Exception("L'objet cours est invalide ou manquant.");
        }
    
        try {
            $db = config::getConnexion();
            
    
            // Préparation de la requête SQL
            $query = $db->prepare(
                'UPDATE cours SET 
                    titre_c = :titre_c,
                    description_c = :description_c,
                    niveau = :niveau,
                    nombre_consultation = :nombre_consultation,
                    duree = :duree,
                    contenu = :contenu,
                    position = :position
                WHERE idc = :idc',
            );
    
            // Débogage : Afficher les valeurs des getters
            var_dump([
                'titre_c' => $cours->gettitre_c(),
                'description_c' => $cours->getdescription_c(),
                'niveau' => $cours->getniveau(),
                'nombre_consultation' => $cours->getnombre_consultation(),
                'duree' => $cours->getduree(),
                'contenu' => $cours->getcontenu(),
                'position' => $cours->getposition(),
                'idc' => $idc
            ]);
            
        
    
            // Exécution de la requête avec les valeurs
            $query->execute([
                'idc' => $idc,
                'titre_c' => $cours->gettitre_c(),
                'description_c' => $cours->getdescription_c(),
                'niveau' => $cours->getniveau(),
                'nombre_consultation' => $cours->getnombre_consultation(),
                'duree' => $cours->getduree(),
                'contenu' => $cours->getcontenu(),
                'position' => $cours->getposition()
            ]);
    
            $affectedRows = $query->rowCount();
    
            if ($affectedRows > 0) {
                echo "$affectedRows enregistrement(s) mis à jour avec succès.<br>";
            } else {
                echo "Aucune ligne mise à jour. Vérifiez l'ID ou les données fournies.<br>";
            }
    
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }
    
}

    
?>
