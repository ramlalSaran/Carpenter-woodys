<?php
include_once('./includes/config.php');
include_once('login-valideter.php');

$id=$_GET['id'];
// dd($id);
if ($id) {
    $delete="delete from `blocks` where id = '$id'";
    $del=$conn->query($delete);
    if ($del) {
       $_SESSION['success']="Block Deleted SuccessFully..";
       header('location:Show_all_block.php');
    }else{
        $_SESSION['error']="Block is not delete please try again";
        header('location:Show_all_block.php');
    }
}


?>