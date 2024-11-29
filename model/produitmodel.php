<?php

require_once 'C:\xampp\htdocs\project\config.php';
class ProductModel
{
    private $nomp;
    private $quantite;
    private $prix_p;
    private $reduction;
    private $descri;
    private $types;
    public function __construct($nomp,$quantite,$prix_p,$reduction,$descri,$types)
    {
        $this->nomp =$nomp;
        $this->quantite =$quantite;
        $this->prix_p =$prix_p;
        $this->reduction =$reduction; 
        $this->descri=$descri;   
        $this->types=$types;

    }
    public function getnomp() {
        return $this->nomp; 
    }
    public function setnomp($nomp) {
        $this->nomp = $nomp;
    }

    public function getquantite() {
        return $this->quantite; 
    }
    public function setquantite($quantite) {
        $this->quantite = $quantite;
    }    
    public function getprix_p() {
        return $this->prix_p; 
    }
    public function setprix_p($prix_p) {
        $this->prix_p = $prix_p;
    }
    public function getreduction() {
        return $this->reduction; 
    }
    public function setreduction($reduction) {
        $this->reduction = $reduction;
    }
    public function getdescri() {
        return $this->descri;
    }
    public function setdescri($descri) {
        $this->descri = $descri;
    }
  
    public function gettypes() {
        return $this->types; 
    }
    public function settypes($types) {
        $this->types = $types;
    }

    public function save() {
        $conn = Config::getConnexion();
        try {
            $sql = "INSERT INTO produit (nomp, quantite, prix_p,reduction,descri, types) 
                    VALUES (:nomp, :quantite, :prix_p, :reduction,:descri, :types)";
            $stmt = $conn->prepare($sql);
            $result = $stmt->execute([
                ':nomp' => $this->nomp,
                ':quantite' => $this->quantite,
                ':prix_p' => $this->prix_p,
                ':reduction' => $this->reduction,
                ':descri' => $this->descri,
                ':types' => $this->types,
                

            ]);

            if ($result) {
                return true;
            } else {
                $errorInfo = $stmt->errorInfo();
                echo "Error adding user: " . $errorInfo[2];
                return false;
            }
        } catch (PDOException $e) {
            echo "Exception: " . $e->getMessage();
            return false;
        }
    }

}