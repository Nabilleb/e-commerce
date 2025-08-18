<?php
session_start();
include "db_connect.php";

if (!isset($_SESSION['UserID'])) {
    header("Location: login.php");
    exit;
}

$cartItemID = intval($_GET['id']);

$stmt = $conn->prepare("DELETE FROM CartItems WHERE CartItemID = ?");
$stmt->bind_param("i", $cartItemID);
$stmt->execute();
$stmt->close();

header("Location: cart.php");
exit;
?>
