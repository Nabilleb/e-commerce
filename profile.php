<?php
session_start();
include "connect.php";

if(!isset($_SESSION['UserID'])){
    header("Location: login.php");
    exit;
}
$stmt = $conn->prepare("SELECT Email, CreatedAt FROM Users WHERE UserID = ?");
$stmt->bind_param("i", $_SESSION['UserID']);
$stmt->execute();
$stmt->bind_result($email, $createdAt);
$stmt->fetch();
$stmt->close();
?>
<h2>Welcome, <?php echo htmlspecialchars($_SESSION['FullName']); ?> !</h2>
<p>Email: <?php echo htmlspecialchars($email); ?></p>
<p>Member since: <?php echo $createdAt; ?></p>

<h3>Shop</h3>
<ul>
    <li><a href="categories.php">Browse Categories</a></li>
    <li><a href="products.php">All Products</a></li>
    <li><a href="cart.php">View Cart</a></li>
    <li><a href="orders.php">My Orders</a></li>
</ul>

<h3>Product Management</h3>
<ul>
    <li><a href="add_product.php">Add Product</a></li>
    <li><a href="manage_products.php">Manage Products</a></li>
</ul>

<a href="logout.php">Logout</a>
