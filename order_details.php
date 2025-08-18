<?php
session_start();
include "connect.php";

if (!isset($_SESSION['UserID'])) {
    header("Location: login.php");
    exit;
}

$userID = $_SESSION['UserID'];
$orderID = intval($_GET['id']);

$orderCheck = $conn->prepare("SELECT OrderID, OrderDate, Status, TotalAmount FROM Orders WHERE OrderID = ? AND UserID = ?");
$orderCheck->bind_param("ii", $orderID, $userID);
$orderCheck->execute();
$orderResult = $orderCheck->get_result();

if ($orderResult->num_rows === 0) {
    echo "Order not found!";
    exit;
}

$order = $orderResult->fetch_assoc();

echo "<h2>Order #" . $order['OrderID'] . "</h2>";
echo "Date: " . $order['OrderDate'] . "<br>";
echo "Status: " . $order['Status'] . "<br>";
echo "Total: $" . $order['TotalAmount'] . "<br><br>";

$itemSql = "SELECT p.ProductName, oi.Quantity, oi.UnitPrice, (oi.Quantity * oi.UnitPrice) as Subtotal
            FROM OrderItems oi
            JOIN Products p ON oi.ProductID = p.ProductID
            WHERE oi.OrderID = ?";
$itemStmt = $conn->prepare($itemSql);
$itemStmt->bind_param("i", $orderID);
$itemStmt->execute();
$itemResult = $itemStmt->get_result();

echo "<h3>Items:</h3>";
while ($row = $itemResult->fetch_assoc()) {
    echo $row['ProductName'] . " - " . $row['Quantity'] . " x $" . $row['UnitPrice'] . " = $" . $row['Subtotal'] . "<br>";
}
?>
