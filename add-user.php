<?php
include_once('./includes/config.php');
include_once('login-valideter.php');
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email=$_POST['email'];
    $password=md5($_POST['password']);
    $phone=$_POST['phone'];
    $gender=$_POST['gender']??'';
    $isError=false;
    if (empty($name)) {
        $isError=true;
        $_SESSION['name_error']="name is required";
    }
    if (empty($email)) {
        $isError=true;
        $_SESSION['email_error']="Email is required";
    }
    if (empty($_POST['password'])) {
        $isError=true;
        $_SESSION['password_error']="Password is required";
    }
    if (empty($_POST['repassword'])) {
        $isError=true;
        $_SESSION['repassword_error']="Repassword is required";
    }
    if ($_POST['password']!==$_POST['repassword']) {
        $isError=true;
       $_SESSION['repassword_error']="Repassword is not match";
    }
    if (empty($phone)) {
        $isError=true;
        $_SESSION['phone_error']="Phone is required";
    }

    if (empty($gender)) {
        $isError=true;
        $_SESSION['gender_error']="Gender is required";
    }
    if (empty($_POST['checkbox'])) {
        $_SESSION['checkbox_error']="Please Me!";
    }
    if ($isError) {
        $_SESSION['error']="All flied is required";
        header('location:add-user.php');
        exit();
    }

$sql="SELECT * from `woody_users` where email='$email'";

$result=$conn->query($sql);
if (mysqli_num_rows($result) > 0) {
    $_SESSION['error']= "email is alraedy taken $email";
}else{
    $insql="insert into `woody_users`(name,email,password,phone,gender)values('$name' , '$email' , '$password' , '$phone' , '$gender')";
    $result=$conn->query($insql);
    if ($result) {
        header('location:user-list.php');
        $_SESSION['success']="User is inserted SuccessFully...";
        exit;
    }else{
        $_SESSION['error']="Data is not inserted";
    }
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
                    <h3 class="box-title">Add New User</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form id="userForm" role="form" action="add-user.php" method="post">
                <?php
include_once('./includes/message.php');

?>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Name" name="name">
                            <div class="error name_error"><?=($_SESSION['name_error'])??''?></div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                            <div class="error email_error"><?=($_SESSION['email_error'])??''?></div>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Password"
                                name="password">
                                <div class="error password_error"><?=($_SESSION['password_error'])??''?></div>
                        </div>
                        <div class="form-group">
                            <label for="repassword">Repeat Password</label>
                            <input type="password" class="form-control" id="repassword" placeholder="RePassword"
                                name="repassword">
                                <div class="error repassword_error"><?=($_SESSION['repassword_error'])??''?></div>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="tel" name="phone" id="phone" class="form-control" placeholder="Phone Number">
                            <div class="error phone_error"><?=($_SESSION['phone_error'])??''?></div>

                        </div>

                        <div class="form-group">
                            <label>Gender</label>
                            <br>
                            <input type="radio" name="gender" id="gender_male" value="M">
                            <label>Male</label>
                            <input type="radio" name="gender" id="gender_female" value="F">
                            <label>Female</label>
                            <input type="radio" name="gender" id="gender_other" value="O">
                            <label>Other</label>
                            <div class="error gender_error"><?=($_SESSION['gender_error'])??''?></div>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="checkbox" name="checkbox"> Check me out
                            </label>
                            <div class="error checkbox_error"><?=($_SESSION['checkbox_error'])??''?></div>
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-success" name="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div><!-- /.content-wrapper -->
        <?php include_once('./includes/footer.php'); ?>
    </div><!-- ./wrapper -->
    <?php include_once('./includes/footer-js.php'); ?>
    <script>
    $(document).ready(function() {
        $("#userForm").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 2
                },
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 6
                },
                repassword: {
                    required: true,
                    equalTo: "#password"
                },
                phone: {
                    required: true,
                    maxlength: 12

                },
                gender: {
                    required: true
                },

                checkbox: {
                    required: true
                }
            },
            messages: {
                name: {
                    required: "Please enter your name",
                    minlength: "Your name must consist of at least 2 characters"
                },
                email: {
                    required: "Please enter a valid email address",
                    email: "Please enter a valid email address"
                },
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 6 characters long"
                },
                repassword: {
                    required: "Please confirm your password",
                    equalTo: "Passwords do not match"
                },
                phone: {
                    required: "Please enter your phone number",
                    maxlength: "Your phone number must be 12 digits long"

                },
                gender: {
                    required: "Please select your gender"
                },
                checkbox: {
                    required: "Please check this checkbox"
                }
            },

           errorElement: "div",
            errorPlacement: function(error, element) {
                if (element.is(":checkbox") || element.is(":radio")) {
                    error.appendTo(element.parent());
                } else {
                    error.insertAfter(element);
                }
            },

            submitHandler: function(form) {
                form.submit();
            }
        });
    });
    </script>


<?php
unset($_SESSION['name_error']);
unset($_SESSION['email_error']);
unset($_SESSION['phone_error']);
unset($_SESSION['password_error']);
unset($_SESSION['repassword_error']);
unset($_SESSION['gender_error']);
unset($_SESSION['checkbox_error']);

?>