<a href="profile.php">Back to Profile</a>
<?php
include "connect.php";
if (!isset($_GET['id'])) {
    echo "Product not found!";
    exit;
}

$id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT * FROM Products WHERE ProductID = ? AND IsActive = 1");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0){
    echo "product not found";
    exit;
}

$product = $result->fetch_assoc();

echo "<h2>" . htmlspecialchars($product['ProductName']) . "</h2>";
echo "<p>" . htmlspecialchars($product['Description']) . "</p>";
echo "<p>Price: $" . $product['Price'] . "</p>";
echo "<p>Stock: " . $product['Stock'] . "</p>";
echo "<a href='add_to_cart.php?id=" . $product['ProductID'] . "'>Add to Cart</a>";
?>

