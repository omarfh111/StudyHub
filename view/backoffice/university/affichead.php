<?php

require_once 'C:\xampp\htdocs\project\config.php';
require_once 'C:\xampp\htdocs\project\model\produitmodel.php';

$produits = [];

try {
    $sql = "SELECT idp,nomp as product,quantite as quantity,prix_p as price,reduction as discount,types FROM produit";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Could not fetch products: " . $e->getMessage());
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Product List</title>
    <style>
        table {
            border-collapse: collapse;
        }

        th, td {
            
            padding: 16px;
        }
    </style>
</head>
<body>
    <h1>Product List</h1>
    <table>
        <thead>
            <tr>
                <th>idp</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Reduction</th>
                <th>types</th>
                
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produits as $produit) : ?>
                <tr>
                    <td><?php echo $produit['idp']; ?>  </td>
                    <td><?php echo $produit['product']; ?> </td>
                    <td><?php echo $produit['quantity']; ?> </td>
                    <td><?php echo $produit['price']; ?> </td>
                    <td><?php echo $produit['discount']; ?> </td>
                    <td><?php echo $produit['types']; ?> </td>
                    <td><a title="delete" href="/project/view/backoffice/ericsson-admin-template-for-university-school-2024-09-23-12-22-44-utc/university/delete.php?idp=<?php echo $produit['idp']; ?>">Delete</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>