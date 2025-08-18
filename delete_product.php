<?php
session_start();
include "connect.php";

if(!isset($_SESSION['UserID'])){
    header("Location: login.php");
    exit;
}

$id = intval($_GET['id']);
$stmt = $conn->prepare("UPDATE Products SET IsActive=0 WHERE ProductID=?"); 
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo " Product deleted! <a href='manage_products.php'>Back to Manage</a>";
} else {
    echo "Error: " . $stmt->error;
}
