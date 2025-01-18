<?php

//use PSpell\Config;

require_once 'C:\xampp\htdocs\login6\config.php';
require_once 'C:\xampp\htdocs\login6\model\produitmodel.php';

class OfferController
    
{
    
    public function addproduct($nomp,$quantite,$prix_p,$fin_prix,$descri,$types) {
        $produit = new ProductModel($nomp,$quantite,$prix_p,$fin_prix,$descri,$types);
        return $produit->save();
    }
    public function afficheb($page = 1, $limit = 6){
        $offers = [];
        $offset = ($page - 1) * $limit;
    
        try {
            $pdo = Config::getConnexion();
    
            // Count total records
            $totalStmt = $pdo->query("SELECT COUNT(*) FROM produit where types='bureaux'");
            $totalRecords = $totalStmt->fetchColumn();
    
            // Fetch records for the current page
            $sql = "SELECT * FROM produit where types='bureaux' LIMIT :limit OFFSET :offset";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            $offers = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            return [
                'data' => $offers,
                'totalRecords' => $totalRecords,
                'totalPages' => ceil($totalRecords / $limit),
            ];
        } catch (PDOException $e) {
            die("Could not find the offer you're looking for");
            echo 'a href="affichage.php">go back</a>';
        }

    }
    public function affichesc($page = 1, $limit = 6){
        $offers = [];
        $offset = ($page - 1) * $limit;
    
        try {
            $pdo = Config::getConnexion();
    
            // Count total records
            $totalStmt = $pdo->query("SELECT COUNT(*) FROM produit where types='scolaire'");
            $totalRecords = $totalStmt->fetchColumn();
    
            // Fetch records for the current page
            $sql = "SELECT * FROM produit where types='scolaire' LIMIT :limit OFFSET :offset";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            $offers = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            return [
                'data' => $offers,
                'totalRecords' => $totalRecords,
                'totalPages' => ceil($totalRecords / $limit),
            ];
        } catch (PDOException $e) {
            die("Could not fetch offers: " . $e->getMessage());
        }

    }
    public function afficheti($page = 1, $limit = 6){
        $offers = [];
        $offset = ($page - 1) * $limit;
    
        try {
            $pdo = Config::getConnexion();
    
            // Count total records
            $totalStmt = $pdo->query("SELECT COUNT(*) FROM produit where types='info'");
            $totalRecords = $totalStmt->fetchColumn();
    
            // Fetch records for the current page
            $sql = "SELECT * FROM produit where types='info' LIMIT :limit OFFSET :offset";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            $offers = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            return [
                'data' => $offers,
                'totalRecords' => $totalRecords,
                'totalPages' => ceil($totalRecords / $limit),
            ];
        } catch (PDOException $e) {
            die("Could not fetch offers: " . $e->getMessage());
        }

    }
    public function affiches($page = 1, $limit = 6){
        $offers = [];
        $offset = ($page - 1) * $limit;
    
        try {
            $pdo = Config::getConnexion();
    
            // Count total records
            $totalStmt = $pdo->query("SELECT COUNT(*) FROM produit where quantite > 0");
            $totalRecords = $totalStmt->fetchColumn();
    
            // Fetch records for the current page
            $sql = "SELECT * FROM produit where quantite > 0 LIMIT :limit OFFSET :offset";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            $offers = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            return [
                'data' => $offers,
                'totalRecords' => $totalRecords,
                'totalPages' => ceil($totalRecords / $limit),
            ];
        } catch (PDOException $e) {
            die("Could not fetch offers: " . $e->getMessage());
        }

    }
    public function affichead()
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
    public function affichaa()
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
    public function affichee($page = 1, $limit = 6)
    {
        $offers = [];
        $offset = ($page - 1) * $limit;
    
        try {
            $pdo = Config::getConnexion();
    
            // Count total records
            $totalStmt = $pdo->query("SELECT COUNT(*) FROM produit");
            $totalRecords = $totalStmt->fetchColumn();
    
            // Fetch records for the current page
            $sql = "SELECT * FROM produit LIMIT :limit OFFSET :offset";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            $offers = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            return [
                'data' => $offers,
                'totalRecords' => $totalRecords,
                'totalPages' => ceil($totalRecords / $limit),
            ];
        } catch (PDOException $e) {
            die("Could not fetch offers: " . $e->getMessage());
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
                    fin_prix = :fin_prix,
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
                'fin_prix' => $produit->getfin_prix(),
                'descri'=>$produit->getdescri(),
                'types' => $produit->gettypes()
            ]);
    
            // Execute the query with actual values
            $query->execute([
                'idp' => $id,
                'nomp' => $produit->getnomp(),
                'quantite' => $produit->getquantite(),
                'prix_p' => $produit->getprix_p(),
                'fin_prix' => $produit->getfin_prix(),
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
    //navbar fucntions
    public function affichinf($page = 1, $limit = 6)
    {
        $offers = [];
        $offset = ($page - 1) * $limit;
    
        try {
            $pdo = Config::getConnexion();
    
            // Count total records
            $totalStmt = $pdo->query("SELECT COUNT(*) FROM produit where types ='info'");
            $totalRecords = $totalStmt->fetchColumn();
    
            // Fetch records for the current page
            $sql = "SELECT * FROM produit where types='info' LIMIT :limit OFFSET :offset";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            $offers = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            return [
                'data' => $offers,
                'totalRecords' => $totalRecords,
                'totalPages' => ceil($totalRecords / $limit),
            ];
        } catch (PDOException $e) {
            die("Could not fetch offers: " . $e->getMessage());
        }
        
    }
    public function affichsco($page = 1, $limit = 6)
    {
        $offers = [];
        $offset = ($page - 1) * $limit;
    
        try {
            $pdo = Config::getConnexion();
    
            // Count total records
            $totalStmt = $pdo->query("SELECT COUNT(*) FROM produit where types ='scorlaire'");
            $totalRecords = $totalStmt->fetchColumn();
    
            // Fetch records for the current page
            $sql = "SELECT * FROM produit where types='scolaire' LIMIT :limit OFFSET :offset";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            $offers = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            return [
                'data' => $offers,
                'totalRecords' => $totalRecords,
                'totalPages' => ceil($totalRecords / $limit),
            ];
        } catch (PDOException $e) {
            die("Could not fetch offers: " . $e->getMessage());
        }
        
    }
    public function affichbu($page = 1, $limit = 6)
    {
        $offers = [];
        $offset = ($page - 1) * $limit;
    
        try {
            $pdo = Config::getConnexion();
    
            // Count total records
            $totalStmt = $pdo->query("SELECT COUNT(*) FROM produit where types ='bureaux'");
            $totalRecords = $totalStmt->fetchColumn();
    
            // Fetch records for the current page
            $sql = "SELECT * FROM produit where types='bureaux' LIMIT :limit OFFSET :offset";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            $offers = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            return [
                'data' => $offers,
                'totalRecords' => $totalRecords,
                'totalPages' => ceil($totalRecords / $limit),
            ];
        } catch (PDOException $e) {
            die("Could not fetch offers: " . $e->getMessage());
        }
        
    }
    public function affichen($page = 1, $limit = 6)
    {
        $offers = [];
        $offset = ($page - 1) * $limit;
    
        try {
            $pdo = Config::getConnexion();
    
            // Count total records
            $totalStmt = $pdo->query("SELECT COUNT(*) FROM produit where quantite >0");
            $totalRecords = $totalStmt->fetchColumn();
    
            // Fetch records for the current page
            $sql = "SELECT * FROM produit where quantite>0  LIMIT :limit OFFSET :offset";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            $offers = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            return [
                'data' => $offers,
                'totalRecords' => $totalRecords,
                'totalPages' => ceil($totalRecords / $limit),
            ];
        } catch (PDOException $e) {
            die("Could not fetch offers: " . $e->getMessage());
        }
        
    }




    

}

?>