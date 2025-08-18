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
?>