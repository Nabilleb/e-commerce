<?php
session_start();
include "connect.php";

if(!isset($_SESSION['UserID'])){
      header("Location: login.php");
    exit;
}

$result = $conn->query("SELECT * FROM Categories");

echo "<h2>Categories</h2>";
while ($row = $result->fetch_assoc()) {
    echo "<a href='products.php?category=" . $row['CategoryID'] . "'>" 
         . htmlspecialchars($row['CategoryName']) . "</a><br>";
}
?>
<a href="profile.php">Back to Profile</a>