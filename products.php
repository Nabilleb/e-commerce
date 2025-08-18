<?php
include "connect.php";

$categoryID = isset($_GET['category']) ? intval($_GET['category']) : 0;
$keyword = isset($_GET['search']) ? $_GET['search'] : "";

$sql = "SELECT * FROM Products WHERE IsActive = 1";
if ($categoryID > 0){
    $sql .= "AND CategoryID = $categoryID";
}

if (!empty($keyword)){
        $keywordEscaped = $conn->real_escape_string($keyword);
        $sql .= " AND (ProductName LIKE '%$keywordEscaped%' OR Description LIKE '%$keywordEscaped%')"
}
?>