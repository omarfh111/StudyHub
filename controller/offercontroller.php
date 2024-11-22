<?php

//use PSpell\Config;

require_once 'C:\xampp\htdocs\project\config.php';
require_once 'C:\xampp\htdocs\project\model\produitmodel.php';

class OfferController
{
    /*public function addProduct()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            // Handle invalid JSON error
            echo json_encode(['error' => 'Invalid JSON data']);
            exit;
        }

        $result = $ProductModel->addProduct($data);

        if ($result) {
            echo json_encode(['success' => 'Product added successfully']);
        } else {
            echo json_encode(['error' => 'Failed to add product']);
        }
    }*/

function deleteproduct($id)
    {    global  $pdo;
        $sql = "DELETE FROM produit WHERE idp = :idp";
        $req = $pdo->prepare($sql);
        $req->bindParam(':idp', $id);
        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
}