<?php
session_start();

if(!isset($_SESSION['UserID'])){
    header("Location: login.php");
    exit;
}
?>
<h2>Welcome, <?php echo $_SESSION['FullName']; ?> </h2>
<a href="logout.php">Logout</a>