<?php

require_once 'C:\xampp\htdocs\login6\config.php';

class CartModel
{
    private $idp;
    private $nompp;
    //private $user_id=1;
    private $price;
    private $quantite;

    // Constructeur pour initialiser les propriétés
    public function __construct($idp,$nompp,$user_id ,  $price, $quantite)
    {
        $this->idp = $idp;
        $this->nompp = $nompp;
        //$this->user_id = $user_id;
        $this->price = $price;
        $this->quantite = $quantite;
    }

    // Fonction pour sauvegarder le produit dans le panier
    public function save()
    {
        // Connexion à la base de données
        $conn = Config::getConnexion();

        try {
            // Préparer la requête d'insertion dans la table 'cart'
            $sql = "INSERT INTO cart (idp, nompp,user_id , price, quantite) 
                    VALUES (:idp, :nompp,:user_id  ,:price, :quantite)";
            $stmt = $conn->prepare($sql);

            // Exécuter la requête avec les paramètres
            $stmt->execute([
                ':idp' => $this->idp,
                ':nompp' => $this->nompp,
                //':user_id' => $this->user_id,
                ':price' => $this->price,
                ':quantite' => $this->quantite
            ]);

            // Si l'insertion a réussi, retourner true
            return true;
        } catch (PDOException $e) {
            // Si une erreur survient, l'afficher
            echo "Erreur lors de l'ajout au panier: " . $e->getMessage();
            return false;
        }
    }
}