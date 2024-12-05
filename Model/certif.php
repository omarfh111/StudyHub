<?php
require_once 'C:\xampp\htdocs\StudyHub\config.php';

class Certif {
    //private $pdo;
    private $id_certif;
    private $detail;
    private $certif_url;
   

    public function __construct($detail = null, $certif_url = null) {
       // $this->pdo = config::getConnexion();
        //$this->idc = $idc;
        $this->detail= $detail;
        $this->certif_url = $certif_url;
      
        
    }

    public function getid_certif(){
        return $this->id_certif;
    }
    public function setid_certif($id_certif){
        $this->id_certif=$id_certif;
    }
    public function getdetail(){
        return $this->detail;
    }
    public function setdetail($detail){
        $this->detail=$detail;
    }
    public function getcertif_url(){
        return $this->certif_url;
    }
    public function setcertif_url($certif_url){
        $this->certif_url=$certif_url;
    }
    
    public function save() {
        $conn = Config::getConnexion();
        try {
            $sql = "INSERT INTO certif (detail, certif_url) 
                VALUES (:detail, :certif_url)";
            $stmt = $conn->prepare($sql);
            $result = $stmt->execute([
                'detail' => $this->detail,
                'certif_url' => $this->certif_url
            ]);
            

            if ($result) {
                return true;
            } else {
                $errorInfo = $stmt->errorInfo();
                echo "Error adding certification: " . $errorInfo[2];
                return false;
            }
        } catch (PDOException $e) {
            echo "Exception: " . $e->getMessage();
            return false;
        }
    }



    public function deleteCertif($id_certif) {
        $sql = "DELETE FROM certif WHERE id_certif = :id_certif";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id_certif' => $id_certif]);
            return true;
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la suppression de la certification : " . $e->getMessage());
        }
    }
    public function getCertifById($id_certif) {
        $sql = "SELECT * FROM certif WHERE id_certif = :id_certif";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id_certif' => $id_certif]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la récupération de la certification : " . $e->getMessage());
        }
    }

    public function getAllCertif() {
        $sql = "SELECT * FROM certif";
        try {
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la récupération des certifications : " . $e->getMessage());
        }
    }


    
}
?>




