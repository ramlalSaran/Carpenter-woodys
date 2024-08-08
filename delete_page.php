<?php
include_once('./includes/config.php');
include_once('login-valideter.php');
$id=$_GET['id'];

if ($id) {
    $delQuery="delete  from  `pages` where id ='$id'";
    $delete=$conn->query($delQuery);
    if ($delete) {
        $_SESSION['success']="Data Deleted SuccessFully...";
        header('location:show_all_page.php');

    }else{
        $_SESSION['error']= "Data is not delete";
    }
}else{
   $_SESSION['error'] = "id not found";
}


?>