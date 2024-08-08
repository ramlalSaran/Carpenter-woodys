<?php
include_once('./includes/config.php');
include_once('login-valideter.php');





    $id=$_SESSION['id'];
    $email = $_SESSION['email'];
    $old_pass = md5($_POST['Old-password']);
    $new_pass = md5($_POST['New-password']);
    $sql = "SELECT * FROM woody_users WHERE id='$id' and  email='$email'  ";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result)>0) {
        $row = mysqli_fetch_assoc($result);
        // dd($row);
    if ($row['password']==$old_pass) {
        $updpass="update woody_users set password='$new_pass' where  id='$id' and email='$email'";
        $update=$conn->query($updpass);
   if ($update) {
    $_SESSION['success']="Password changed successfully";
    // include_once('logout.php');
    header('location:logout.php');
    }else{
        $_SESSION['error']="Password not changed";
        header('location:change_password_form');
    }
}else {
    $_SESSION['error']="Old password is incorrect";
    header('location:change_password_form.php');
 }

}
else{
    $_SESSION['error']="You are not login please first login ";
    header('location:change_password_form.php');
}
   

?>