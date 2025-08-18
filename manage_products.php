<?php
session_start();
include "connect.php";

if(!isset($_SESSION['UserID'])){
    header("Location: login.php");
    exit;
}

$result = $conn->query("SELECT * FROM Products WHERE IsActive = 1");
?>

<h2>Manage Products</h2>
<a href="add_product.php">Add Product</a>
<table border="1" cellpadding="5">
<tr>
    <th>ID</th><th>Name</th><th>Price</th><th>Stock</th><th>Actions</th>
</tr>
<?php while($row = $result->fetch_assoc()){ ?>
<tr>
    <td><?php echo $row['ProductID']; ?></td>
    <td><?php echo htmlspecialchars($row['ProductName']); ?></td>
    <td>$<?php echo $row['Price']; ?></td>
    <td><?php echo $row['Stock']; ?></td>
    <td>
        <a href="edit_product.php?id=<?php echo $row['ProductID']; ?>"> Edit</a> | 
        <a href="delete_product.php?id=<?php echo $row['ProductID']; ?>" onclick="return confirm('Delete this product?');">Delete</a>
    </td>
</tr>
<?php } ?>
</table>

<a href="profile.php">Back to Profile</a>