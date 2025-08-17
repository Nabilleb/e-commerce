<?php
session_start();
include "connect.php";

if(!isset($_SESSION['UserID'])){
      header("Location: login.php");
    exit;
}
?>