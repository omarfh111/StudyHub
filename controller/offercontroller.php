<?php

//use PSpell\Config;

require_once 'C:\xampp\htdocs\project\config.php';
require_once 'C:\xampp\htdocs\project\model\produitmodel.php';

class OfferController
{
    public function addproduct($nomp,$quantite,$prix_p,$reduction,$descri,$types) {
        $produit = new ProductModel($nomp,$quantite,$prix_p,$reduction,$descri,$types);
        return $produit->save();
    }
    public function affichee()
    {
        $sql = "SELECT * FROM produit";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    function deleteOffer($idp)
    {
        $sql = "DELETE FROM produit WHERE idp = :idp";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':idp', $idp);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
   public function proddetails($idp)
    {
        $sql = "SELECT nomp , FROM produit WHERE idp = :idp";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(array(':idp' => $idp));
            $produit = $query->fetch();
            return $produit;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
   }
    public function updateOffer($produit, $id)
    {
        // Debugging: Output the product object to check the values
        var_dump($produit);  
    
        try {
            // Get database connection
            $db = config::getConnexion();
    
            // Prepare the UPDATE query
            $query = $db->prepare(
                'UPDATE produit SET 
                    nomp = :nomp,
                    quantite = :quantite,
                    prix_p = :prix_p,
                    reduction = :reduction,
                    descri = :descri,
                    types = :types
                WHERE idp = :idp'
            );
    
            // Debugging: Output the values being passed to the query
            var_dump([
                'idp' => $id,
                'nomp' => $produit->getnomp(),
                'quantite' => $produit->getquantite(),
                'prix_p' => $produit->getprix_p(),
                'reduction' => $produit->getreduction(),
                'descri'=>$produit->getdescri(),
                'types' => $produit->gettypes()
            ]);
    
            // Execute the query with actual values
            $query->execute([
                'idp' => $id,
                'nomp' => $produit->getnomp(),
                'quantite' => $produit->getquantite(),
                'prix_p' => $produit->getprix_p(),
                'reduction' => $produit->getreduction(),
                'descri'=>$produit->getdescri(),
                'types' => $produit->gettypes()
                
            ]);
    
            // Check how many rows were updated
            $affectedRows = $query->rowCount();
    
            if ($affectedRows > 0) {
                echo "$affectedRows record(s) UPDATED successfully.<br>";
            } else {
                echo "No rows were updated. This could be because the data is identical to the existing values, or the ID doesn't exist.<br>";
            }
    
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage(); 
        }
    }
    

}