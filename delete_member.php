<?php
include_once('./includes/config.php');
include_once('login-valideter.php');

$id=$_GET['id'];
$delete="delete from `team` where id = '$id'";
$run=$conn->query($delete);
if ($run) {
    $_SESSION['success']="Member is deleted ";
    header('location:show_team.php');

}else{
    echo "Query is not Run ";
}

?>