<?php
include_once('./includes/config.php');
include_once('login-valideter.php');
if (isset($_POST['submit'])) {
    # code...

$fname=$_POST['fname'];
$role=$_POST['role'];
$timage=$_FILES['timage']['name'];
$ord=$_POST['ord'];
$status=$_POST['status'];
$insertTeam="insert into `team` (fullname,role,team_image,ordering,status)values('$fname','$role','$timage','$ord','$status')";
$res=$conn->query($insertTeam);
if ($res) {
    move_uploaded_file($_FILES['timage']['tmp_name'],'./team_image/'.$timage);
    $_SESSION['success']="New Member Add SuccessFully";
    header('location:show_team.php');
}else{
    echo "Data is not insert";
}

}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>AdminLTE 2 | Dashboard</title>
    <?php include_once('./includes/head.php'); ?>
    <style>
    .error {
        color: red;
    }
    </style>
</head>

<body class="skin-blue">

    <div class="wrapper">
        <?php include_once('./includes/header.php'); ?>
        <?php include_once('./includes/nav.php'); ?>
        <div class="content-wrapper">
            <section class="content-header">
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Dashboard</li>
                </ol>
            </section>
            <div class="box box-primary">
                <div class="box-header center">
                    <h3 class="box-title">Add New Team Member</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form id="userForm" role="form" action="" method="post"enctype="multipart/form-data">
                <?php
include_once('./includes/message.php');

?>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name">FullName</label>
                            <input type="text" class="form-control" id="fname" placeholder="Full Name" name="fname">
                            
                        </div>
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select name="role" id="role"  class="form-control">
                                <option value="">Select Role</option>
                                <option value="1">Admin</option>
                                <option value="2">ui/ux designer</option>
                                <option value="3">Web designer</option>
                                <option value="4">Web Developer</option>
                                <option value="5">HR</option>
                                <option value="6">Manager</option>
                                <option value="7">Onner</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="image">Team image</label>
                            <input type="file" class="form-control" id="image" 
                                name="timage">
                        </div>
                        <div class="form-group">
                            <label for="ord">Ordering</label>
                            <input type="number" class="form-control" id="ord" placeholder="ordering"
                                name="ord">
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status"  class="form-control">
                                <option value="">Select Status</option>
                                <option value="1">Enable</option>
                                <option value="2">Disable</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success" name="submit">Add Member</button>
                        </div>
                    </div><!-- /.box-body -->
                </form>
            </div>
        </div><!-- /.content-wrapper -->
        <?php include_once('./includes/footer.php'); ?>
    </div><!-- ./wrapper -->
    <?php include_once('./includes/footer-js.php'); ?>