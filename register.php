<?php
session_start();
include "connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
$email = $_POST['email'];
$fullname = $_POST['fullname'];
$password = $_POST['password'];


 $check = $conn->prepare("SELECT UserID FROM Users WHERE Email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();
    
    if($check->num_rows > 0){
        echo "Email already registered!";
    }else{
        $stmt = $conn->prepare("INSERT INTO Users (Email, PasswordHash, FullName) VALUES (?, ?, ?)");
        $stmt->bind_param("sss",$email,$password,$fullname);

        if($stmt->execute()){
            echo " Registration successful! <a href='login.php'>Login here</a>";
        } else{
            echo "Error". $stmt->error;
        }
    }

}
    ?>

<form method="post">
    <h2>Register</h2>
    Full Name: <input type="text" name="fullname" required><br>
    Email: <input type="email" name="email" required><br>
    Password: <input type="password" name="password" required><br>
    <button type="submit">Register</button>
</form>