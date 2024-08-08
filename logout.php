<?php
include_once('./includes/config.php');
unset($_SESSION['name']);
unset($_SESSION['loggedIn']);
header('location:index.php');
$_SESSION['success']="You are logout";
?>