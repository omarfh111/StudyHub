<?php

require_once 'C:\xampp\htdocs\project\config.php';
class ProductModel
{
    private $pdo;
    private $nomp;
    private $quantite;
    private $prix_p;
    private $reduction;
    private $types;
    public function __construct($pdo,$nomp,$quantite,$prix_p,$reduction,$types)
    {
        $this->pdo =$pdo;
        $this->nomp =$nomp;
        $this->quantite =$quantite;
        $this->prix_p =$prix_p;
        $this->reduction =$reduction;    
        $this->types=$types;

    }

    public function addProduct()
    {
        try {
            $sql = "INSERT INTO produit (nomp, quantite, prix_p, reduction,types) VALUES (?, ?, ?, ?,?)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$this->nomp, $this->quantite, $this->prix_p, $this->reduction,$this->types]);
            return true;
        } catch (PDOException $e) {
            die("Could not add product: " . $e->getMessage());
        }
    }
}