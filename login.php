<?php
session_start();
include "connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $email =$_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT UserID, PasswordHash, FullName FROM Users WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0){
        $stmt->bind_result($userID, $hashedPassword, $fullname);
        $stmt->fetch();
        if ($password == $hashedPassword){
            $_SESSION['UserID'] = $userID;
            $_SESSION['FullName'] = $fullname;
            header("Location: profile.php");
            exit;        }
        else{
            echo "wrong password";
        }
    }else{
        echo "no account found";
    }
}
?>

<form method="post">
    <h2>Login</h2>
    Email: <input type="email" name="email" required><br>
    Password: <input type="password" name="password" required><br>
    <button type="submit">Login</button>
</form>