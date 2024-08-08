<?php
include_once('./includes/config.php');


if (isset($_POST['send_message'])) {
    
    $name=$_POST['name'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $message=$_POST['message'];
    
    $sql = "INSERT INTO `enquiries` (name, email, phone, message) VALUES ('$name','$email','$phone','$message')";
    // echo $sql;
    // die;
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $_SESSION['success']="Message SuccessFully Send ";
        header('location: index.php');
    }

}


?>