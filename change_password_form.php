<?php
include_once('./includes/config.php');
include_once('login-valideter.php');
$select="SELECT * FROM woody_users ";
$run=$conn->query($select);
$row=mysqli_fetch_assoc($run);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>AdminLTE 2 | Log in</title>
    <style>
    .error {
        color: red;
    }
    </style>
    <?php
include_once('includes/head.php');
?>

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
                    <h3 class="box-title">Add New User</h3>
                </div><!-- /.box-header -->
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>Admin</b>LTE</a>
        </div><!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Change Password</p>
            <form action="change_password.php" method="post" id="change" >
            <?php include_once('./includes/message.php'); ?>
                <input type="hidden" name="id">
     
                <div class="form-group has-feedback">
                    <input type="email" class="form-control"  name="email" value="<?=$row['email']?>" disabled>
                    <span class="glyphicon glyphicon- form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Old-password" name="Old-password" />
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="New Password" name="New-password" id="New-password" />
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Confirm Password" name="confirm-password" />
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary" name="chage_pass">Change Password</button>
                    </div><!-- /.col -->
                </div>
              
            </form>


        </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
</div><!-- /.login-box -->
</div><!-- ./wrapper -->
<?php include_once('./includes/footer.php'); ?>
    <?php include_once('./includes/footer-js.php'); ?>
</body>

</html>
<script>
$('document').ready(function() {
    $('#change').validate({
    rules: {
    "Old-password": {
    required: true,
    minlength: 2
    },
    "New-password": {
    required: true,
    minlength: 2
    },
    "confirm-password": {
    required: true,
    equalTo: "#New-password"
    }
    },
    messages: {
    "Old-password": {
    required: "Please enter your old password",
    minlength: "Your password must be at least 2 characters long"
    },
    "New-password": {
    required: "Please enter your new password",
    },
    "confirm-password": {
        required: "Please enter your confirm password",
        equalTo: "Password do not match"
        }
        }
    });
});
</script>