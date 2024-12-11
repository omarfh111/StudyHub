<?php
require_once 'C:\xampp\htdocs\StudyHub\config.php';

class Cours {
    //private $pdo;
    private $idc;
    private $titre_c;
    private $description_c;
    private $niveau;
    private $nombre_consultation;
    private $duree;
    private $contenu;
    private $position;
    private $id_certif;

    public function __construct($titre_c = null, $description_c = null, $niveau = null, $nombre_consultation = null, $duree = null, $contenu = null, $position, $id_certif) {
       // $this->pdo = config::getConnexion();
        //$this->idc = $idc;
        $this->titre_c = $titre_c;
        $this->description_c = $description_c;
        $this->niveau = $niveau;
        $this->nombre_consultation = $nombre_consultation;
        $this->duree = $duree;
        $this->contenu = $contenu;
        $this->position = $position;
        $this->id_certif = $id_certif;
        
    }

    public function getidc(){
        return $this->idc;
    }
    public function setidc($idc){
        $this->idc=$idc;
    }
    public function gettitre_c(){
        return $this->titre_c;
    }
    public function settitre_c($titre_c){
        $this->titre_c=$titre_c;
    }
    public function getdescription_c(){
        return $this->description_c;
    }
    public function setdescription_c($description_c){
        $this->description_c=$description_c;
    }
    public function getniveau(){
        return $this->niveau;
    }
    public function setniveau($niveau){
        $this->niveau=$niveau;
    }
    public function getnombre_consultation(){
        return $this->nombre_consultation;
    }
    public function setnombre_consultation($nombre_consultation){
        $this->nombre_consultation=$nombre_consultation;
    }
    public function getduree(){
        return $this->duree;
    }
    public function setduree($duree){
        $this->duree=$duree;
    }
    public function getcontenu(){
        return $this->contenu;
    }
    public function setcontenu($contenu){
        $this->contenu=$contenu;
    }
    public function getposition(){
        return $this->position;
    }
    public function setposition($position){
        $this->position=$position;
    }
    public function getid_certif(){
        return $this->id_certif;
    }
    public function setid_certif($id_certif){
        $this->id_certif=$id_certif;
    }
    public function save() {
        $conn = Config::getConnexion();
        try {
            $sql = "INSERT INTO cours (titre_c, description_c, niveau, nombre_consultation, duree, contenu, position,id_certif) 
                VALUES (:titre_c, :description_c, :niveau, :nombre_consultation, :duree, :contenu, :position , :id_certif)";
            $stmt = $conn->prepare($sql);
            $result = $stmt->execute([
                'titre_c' => $this->titre_c,
                'description_c' => $this->description_c,
                'niveau' => $this->niveau,
                'nombre_consultation' => $this->nombre_consultation,
                'duree' => $this->duree,
                'contenu' => $this->contenu,
                'position' => $this->position,
                'id_certif' => $this->id_certif
            ]);

            if ($result) {
                return true;
            } else {
                $errorInfo = $stmt->errorInfo();
                echo "Error adding cours: " . $errorInfo[2];
                return false;
            }
        } catch (PDOException $e) {
            echo "Exception: " . $e->getMessage();
            return false;
        }
    }



    public function deleteCours($idc) {
        $sql = "DELETE FROM cours WHERE idc = :idc";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['idc' => $idc]);
            return true;
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la suppression du cours : " . $e->getMessage());
        }
    }
    public function getCoursById($idc) {
        $sql = "SELECT * FROM cours WHERE idc = :idc";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['idc' => $idc]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la récupération du cours : " . $e->getMessage());
        }
    }

    public function getAllCourses() {
        $sql = "SELECT * FROM cours";
        try {
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la récupération des cours : " . $e->getMessage());
        }
    }


    
}
?>




