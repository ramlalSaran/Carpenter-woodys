<?php
include_once('./includes/config.php');


    $id=$_GET['id'];
    if ($id) {
        $sql = "SELECT * FROM `woody_users` WHERE id = '$id'";
        $result=$conn->query($sql);
        $user=mysqli_fetch_assoc($result);
        
        
        
        
        if (isset($_POST['update'])) {
            $id=$_POST['id'];
   
            $name=$_POST['name'];
            $email=$_POST['email'];
            $phone=$_POST['phone'];
            $gender=$_POST['gender'];
            $sql="update `woody_users` set name='$name' , email='$email' , phone='$phone' , gender='$gender' where id='$id'";
          
            $res=$conn->query($sql);
            if ($res) {
            $_SESSION['success']="Updated successfully";
            header('location:user-list.php');
             
            }else{
                $_SESSION="Data is not updated";
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

    .success {
        background: green;
        display: inline-block;
        font-size: 20px;
        color: black;
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
                    <h3 class="box-title">edit user</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form id="userForm" role="form" action="" method="post">
                    <input type="hidden" name="id" value="<?=$user['id']?>">
                    <?php
include_once('./includes/message.php');
?>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Name" name="name"
                                value="<?=$user['name']?>">
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email"
                                value="<?=$user['email']?>">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="tel" name="phone" id="phone" class="form-control" placeholder="Phone Number"
                                value="<?=$user['phone']?>">

                        </div>

                        <div class="form-group">
                            <label>Gender</label>
                            <br>
                            <input type="radio" name="gender" id="gender_male" value="M"
                                <?=((($user['gender']=='M')? 'checked' :'' ))?>>
                            <label>Male</label>
                            <input type="radio" name="gender" id="gender_female" value="F"
                                <?=((($user['gender']=='F')? 'checked' :'' ))?>>
                            <label>Female</label>
                            <input type="radio" name="gender" id="gender_other" value="O"
                                <?=((($user['gender']=='O')? 'checked' :'' ))?>>
                            <label>Other</label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="checkbox" name="checkbox"> Check me out
                            </label>
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-success" name="update" value="update">Update</button>
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