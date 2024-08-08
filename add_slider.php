<?php
include_once('./includes/config.php');
include_once('login-valideter.php');
                // unset($_SESSION['img']);
if (isset($_POST['submit'])) {
    $title=$_POST['title'];
    $ordering=$_POST['ordering'];
    $status=$_POST['status'];
    $image=$_FILES['image']['name'];
    // dd($title);
   $isError=false;
   if (empty($title)) {
       $isError=true;
    $_SESSION['title_error']="This is ruquired";
   }
   if (empty($ordering)) {
       $isError=true;
    $_SESSION['ordering_error']="This is ruquired";
   }
   if (empty($status)) {
       $isError=true;
    $_SESSION['status_error']="This is ruquired";
   }
   if ($isError) {
    header('location:add_slider.php');
    exit();
   }
 
        
    $insql="INSERT INTO `sliders`( `title`, `image`, `ordering`, `status`) VALUES ('$title','$image','$ordering','$status')";
    
    $query_Run=$conn->query($insql);
    if ($query_Run) {
        move_uploaded_file($_FILES['image']['tmp_name'],"./img/".$_FILES['image']['name']);
        $_SESSION['success']="Data is inserted successFully Add ";
        header('location:slider-list.php');
    }else{
        $_SESSION['error']="image is not upload";
        header('location:add_slider.php');
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
                    <h3 class="box-title">Add Slider</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form id="SliderForm" role="form" action="" method="post" enctype="multipart/form-data">
                <?php
include_once('./includes/message.php');
?>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" placeholder="title" name="title" >
                            <div class="title_error error"><?=($_SESSION['title_error']??'')?></div>
                        </div>


                        <div class="form-group">
                            <label for="ordering">Order</label>
                            <input type="number" class="form-control" id="ordering" placeholder="ordering"
                                name="ordering">
                                <div class="ordering_error error"><?=($_SESSION['ordering_error']??'')?></div>
                        </div>
                        <div class="form-group">
                            <select name="status" id="status" class="form-control">
                                <option value="">Select status</option>
                                <option value="1">Enable</option>
                                <option value="2">disable</option>
                            </select>
                            <div class="status_error error"><?=($_SESSION['status_error']??'')?></div>

                        </div>

                        <div class="form-group">
                            <label for="image">image</label>
                            <input type="file" class="form-control" id="image" name="image">
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
    <?php include_once('./includes/footer-js.php'); 
    ?>
    <script>
    $(document).ready(function() {
        $('#SliderForm').validate({
            rules: {
                title: {
                    required: true,
                    minlength: 3,
                    maxlength: 100
                },
                ordering: {
                    required: true,
                    digits:true;
                },
                status: {
                    required: true
                },
                image: {
                    required: true
                }
            },
            messages: {
                title: {
                    required: "Please enter title",
                    minlength: "Your title must be at least 3 characters long.",
                    maxlength: "Your title must be at least 100 characters long."
                },
                ordering: {
                    required: "Please enter ordering",
                    digits: "Please enter digits only"
                },
                status: {
                    required: "Please enter status"
                },
                image: {
                    required: "Please select an image"
                }
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });
    </script>

    <?php
unset($_SESSION['title_error']);
unset($_SESSION['ordering_error']);
unset($_SESSION['status_error']);



?>