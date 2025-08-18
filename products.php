<?php
include "connect.php";

$categoryID = isset($_GET['category']) ? intval($_GET['category']) : 0;
$keyword = isset($_GET['search']) ? $_GET['search'] : "";

?>