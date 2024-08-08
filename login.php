<?php
include_once('./includes/config.php');
$email=$_POST['email'];
$password=md5($_POST['password']);

$sql="SELECT * FROM `woody_users` where email='$email' and password='$password'";

$res=$conn->query($sql);

if ($res->num_rows) {
    $user=mysqli_fetch_assoc($res);
    $_SESSION['id']=$user['id'];
    $_SESSION['email']=$user['email'];
    $_SESSION['name']=$user['name'];
    $_SESSION['loggedIn']=true;
   header('location:dashboard.php');
}else{
    $_SESSION['error']="Password / Email Not Creact";
    header('location:index.php');
}

?>