<?php
require_once 'C:\xampp\htdocs\project\config.php';
require_once 'C:\xampp\htdocs\project\model\produitmodel.php';
$OfferController = new OfferController();
$list = $OfferController->affichee();
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
                <th>Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Reduction</th>
                <th>types</th>
                
            </tr>
        </thead>
        <tbody>
            <?php foreach ($list as $produit) : ?>
                <tr>
                    <td><?php echo $produit['nomp']; ?> </td>
                    <td><?php echo $produit['quantite']; ?> </td>
                    <td><?php echo $produit['prix_p']; ?> </td>
                    <td><?php echo $produit['reduction']; ?> </td>
                    <td><?php echo $produit['types']; ?> </td>
                    <td><a title="delete" href="delete.php?idp=<?php echo $produit['idp']; ?>">Delete</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>