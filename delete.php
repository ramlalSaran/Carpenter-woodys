<?php
include_once('./includes/config.php');
$id=$_GET['id'];
if ($id) {
    $sql="DELETE FROM `woody_users` where id = '$id'";
$res=$conn->query($sql);
if ($res) {
    header('location: user-list.php');
    $_SESSION['success']="Data is Dalete Successfully...";
}else{
    $_SESSION['error']="Data is not Delete!";
}
}


?>