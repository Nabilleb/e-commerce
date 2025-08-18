<?php
session_start();
include "connect.php";

if(!isset($_SESSION['UserID'])){
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

}

?>

<h2>Add Product</h2>
<form method="post">
    Name: <input type="text" name="name" required><br>
    Description: <textarea name="description"></textarea><br>
    Price: <input type="number" step="0.01" name="price" required><br>
    Stock: <input type="number" name="stock" required><br>
    Category ID: <input type="number" name="category" required><br>
    <button type="submit">Add Product</button>
</form>

<a href="profile.php">Back to Profile</a>