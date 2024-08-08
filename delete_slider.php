<?php
include_once('./includes/config.php');
if (isset($_GET['id'])) {
    $id=$_GET['id'];
    if($id){
        $deleteQuery="DELETE  FROM `sliders` WHERE id='$id'";
        $action=$conn->query($deleteQuery);
        if ($action) {
            $_SESSION['success']="Data Successfully deleted....🥲";
            header('location:slider-list.php');

        }else{
            $_SESSION['error']="Data is not delete please try again!";
            header('location:delete_slider.php');
        }
    }
}

?>