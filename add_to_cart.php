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
?>