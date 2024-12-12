// Retrieve cart items
$query = "SELECT product_id, quantity FROM cart WHERE user_id = 1";
$result = $conn->query($query);

while ($row = $result->fetch_assoc()) {
    $product_id = $row['product_id'];
    $quantity_ordered = $row['quantity'];

    // Update product stock
    $conn->query("UPDATE produit SET quantity = quantity - $quantity_ordered WHERE product_id = $product_id");
}

// Clear the cart
$conn->query("DELETE FROM cart WHERE user_id = 1");
