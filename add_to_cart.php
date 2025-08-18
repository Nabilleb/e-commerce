<?php
session_start();
include "connect.php";

if (!isset($_SESSION['UserID'])){
    header("Location: login.php");
    exit;
}

$userID = $_SESSION['UserID'];
$productID = intval($_GET['id']); 
$quantity = isset($_GET['qty']) ? intval($_GET['qty']) : 1

$cartCheck = $conn->prepare("SELECT CartID FROM Carts WHERE UserID = ?");
$cartCheck->bind_param("i", $userID);
$cartCheck->execute();
$cartCheck->bind_result($cartID);
$cartCheck->fetch();
$cartCheck->close();

if(!$cartID){
    $stmt = $conn->prepare("INSERT INTO Carts (UserID) VALUES (?)");
    $stmt->bind_param("i", $userID);
    $stmt->execute();
    $cartID = $stmt->insert_id;
    $stmt->close();
}

$itemCheck = $conn->prepare("SELECT CartItemID, Quantity FROM CartItems WHERE CartID = ? AND ProductID = ?");
$itemCheck->bind_param("ii", $cartID, $productID);
$itemCheck->execute();
$itemCheck->bind_result($cartItemID, $currentQty);

if ($itemCheck->fetch()) {
      $itemCheck->close();
    $newQty = $currentQty + $quantity;
    $update = $conn->prepare("UPDATE CartItems SET Quantity = ? WHERE CartItemID = ?");
    $update->bind_param("ii", $newQty, $cartItemID);
    $update->execute();
    $update->close();
    else{
     $itemCheck->close();
    $insert = $conn->prepare("INSERT INTO CartItems (CartID, ProductID, Quantity) VALUES (?, ?, ?)");
    $insert->bind_param("iii", $cartID, $productID, $quantity);
    $insert->execute();
    $insert->close();
    }
    header("Location: cart.php");
    exit;
}
?>