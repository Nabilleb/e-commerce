<?php
session_start();
include "connect.php";

if (!isset($_SESSION['UserID'])) {
    header("Location: login.php");
    exit;
}

$userID = $_SESSION['UserID'];

$sql = "SELECT ci.CartItemID, ci.ProductID, ci.Quantity, p.Price
        FROM Carts c
        JOIN CartItems ci ON c.CartID = ci.CartID
        JOIN Products p ON ci.ProductID = p.ProductID
        WHERE c.UserID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Your cart is empty. <a href='categories.php'>Shop now</a>";
    exit;
}
?>