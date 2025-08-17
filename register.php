<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST"){
$email = $_POST['email'];
$fullname = $_POST['fullname'];
$password = $_POST['password'];
}

?>

<form method="post">
    <h2>Register</h2>
    Full Name: <input type="text" name="fullname" required><br>
    Email: <input type="email" name="email" required><br>
    Password: <input type="password" name="password" required><br>
    <button type="submit">Register</button>
</form>