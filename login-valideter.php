<?php
include_once('./includes/config.php');
// $login=$_SESSION['loggedIn'];

if (!$_SESSION['loggedIn']) {
    header('location:index.php');
    $_SESSION['error']="You are not logged in please first login ";
}else {
  
}


?>