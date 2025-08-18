<a href="profile.php">Back to Profile</a>
<?php
session_start();
include "connect.php";

if (!isset($_SESSION['UserID'])) {
    header("Location: login.php");
    exit;
}

$userID = $_SESSION['UserID'];

$sql = "SELECT OrderID, OrderDate, Status, TotalAmount 
        FROM Orders 
        WHERE UserID = ? 
        ORDER BY OrderDate DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userID);
$stmt->execute();
$result = $stmt->get_result();

echo "<h2>Your Orders</h2>";

while ($row = $result->fetch_assoc()) {
    echo "<div style='border:1px solid #ccc; padding:10px; margin:10px;'>";
    echo "Order #" . $row['OrderID'] . "<br>";
    echo "Date: " . $row['OrderDate'] . "<br>";
    echo "Status: " . $row['Status'] . "<br>";
    echo "Total: $" . $row['TotalAmount'] . "<br>";
    echo "<a href='order_details.php?id=" . $row['OrderID'] . "'>View Details</a>";
    echo "</div>";
}
?>
