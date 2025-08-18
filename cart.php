<a href="profile.php">Back to Profile</a>
<?php
session_start();
include "connect.php";

if(!isset($_SESSION['UserID'])){
     header("Location: login.php");
     exit;
}
$userID = $_SESSION['UserID'];

$sql = "SELECT ci.CartItemID, p.ProductName, p.Price, ci.Quantity, (p.Price * ci.Quantity) as Subtotal
        FROM Carts c
        JOIN CartItems ci ON c.CartID = ci.CartID
        JOIN Products p ON ci.ProductID = p.ProductID
        WHERE c.UserID = ?";

 $stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userID);
$stmt->execute();
$result = $stmt->get_result();

echo "<h2>Your Cart</h2>";

$total = 0;
while ($row = $result->fetch_assoc()) {
    echo "<div style='border:1px solid #ccc; margin:10px; padding:10px;'>";
    echo "<h3>" . htmlspecialchars($row['ProductName']) . "</h3>";
    echo "Price: $" . $row['Price'] . "<br>";
    echo "Quantity: " . $row['Quantity'] . "<br>";
    echo "Subtotal: $" . $row['Subtotal'] . "<br>";
    echo "<a href='remove_from_cart.php?id=" . $row['CartItemID'] . "'>Remove</a>";
    echo "</div>";
    $total += $row['Subtotal'];
}
echo "<h3>Total: $" . $total . "</h3>";

if ($total > 0) {
    echo "<a href='checkout.php'>Proceed to Checkout</a>";
}
?>