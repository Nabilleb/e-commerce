<?php
session_start();
include "connect.php";

if(!isset($_SESSION['UserID'])){
    header("Location: login.php");
    exit;
}

$result = $conn->query("SELECT * FROM Products WHERE IsActive = 1");
?>