<?php
session_start();
include "connect.php";

if(!isset($_SESSION['UserID'])){
    header("Location: login.php");
    exit;
}

?>


<h2>Edit Product</h2>
<form method="post">
    Name: <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>" required><br>
    Description: <textarea name="description"><?php echo htmlspecialchars($desc); ?></textarea><br>
    Price: <input type="number" step="0.01" name="price" value="<?php echo $price; ?>" required><br>
    Stock: <input type="number" name="stock" value="<?php echo $stock; ?>" required><br>
    Category ID: <input type="number" name="category" value="<?php echo $category; ?>" required><br>
    <button type="submit">Update Product</button>
</form>