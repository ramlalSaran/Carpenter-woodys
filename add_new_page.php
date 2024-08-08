<?php
include_once('./includes/config.php');
include_once('login-valideter.php');

if (isset($_POST['submit'])) {
    $title=$_POST['title'];
    $heading=$_POST['heading'];
    $description=$_POST['description'];
    $banner=$_FILES['image']['name'];
    // dd($banner);
    $ordering=$_POST['ordering'];
    $status=$_POST['status'];



    $url_key=strtolower($heading);
    $url_key=preg_replace('/[^a-zA-Z0-9-]+/', '-', $url_key);
$url_key=preg_replace('/-+/', '-', $url_key);
    $inQuery="INSERT INTO `pages`(`title`,`heading`,`description`,`banner_image`,`ordering`,`status`,`url_key`)VALUES('$title','$heading','$description','$banner','$ordering','$status','$url_key')";
    // echo $inQuery;
    // die;
    $result=$conn->query($inQuery);
    if ($result) {
       move_uploaded_file($_FILES['image']['tmp_name'],"./images/".$_FILES['image']['name']);
       
       $_SESSION['success']="New Page add successFully ....";
       header('location:show_all_page.php');
    }else{
        $_SESSION['error']="Data is not add ";
    }

}


?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>AdminLTE 2 | Dashboard</title>
    <?php include_once('./includes/head.php'); ?>
</head>
<style>
.error {
    color: red;
}
</style>

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
            <div class="box box-primary ">
                <div class="box-header center">
                    <h3 class="box-title">Add New Page </h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form id="Form" role="form" action="" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name">title</label>
                            <input type="text" class="form-control" id="title" placeholder="Title" name="title"
                                required>

                        </div>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name">Heading</label>
                            <input type="text" class="form-control" id="heading" placeholder="Heading" name="heading"
                                required>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name">Description</label>
                            <div class='box '>
                                <div class='box-header'>
                                    <h3 class='box-title'>CK Editor <small>Advanced and full of features</small></h3>
                                    <!-- tools box -->
                                    <div class="pull-right box-tools">
                                        <button class="btn  btn-sm" data-widget='collapse' data-toggle="tooltip"
                                            title="Collapse"><i class="fa fa-minus"></i></button>
                                        <button class="btn  btn-sm" data-widget='remove' data-toggle="tooltip"
                                            title="Remove"><i class="fa fa-times"></i></button>
                                    </div><!-- /. tools -->
                                </div><!-- /.box-header -->
                                <div class='box-body pad'>
                                    <textarea id="editor1" name="description" rows="" cols="50" required></textarea>
                                </div>
                            </div><!-- /.box -->
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="image">Banner image</label>
                            <input type="file" class="form-control" id="image" name="image" required>

                        </div>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name">Ordering</label>
                            <input type="number" class="form-control" id="ordering" placeholder="ordering"
                                name="ordering" required>

                        </div>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <select name="status" class="form-control" id="status" required>
                                <option value="">Select status</option>
                                <option value="1">Enable</option>
                                <option value="2">Disable</option>
                            </select>
                        </div>
                    </div>
            </div><!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-success" name="submit" id="btn">Submit</button>
            </div>

            </form>
        </div>
    </div><!-- /.content-wrapper -->
    <?php include_once('./includes/footer.php'); ?>
    </div><!-- ./wrapper -->
    <?php include_once('./includes/footer-js.php'); ?>
    <script>
    CKEDITOR.replace('editor1');

    $(document).ready(function() {
        $('#Form').validate({
            rules: {
                title: {
                    required: true
                },
                description: {
                    required: true
                },
                image: {
                    required: true
                },
                ordering: {
                    required: true,

                    digits: true;

                    minlength: 1


                },

                status: {
                    required: true
                }
            },
            messages: {
                title: {
                    required: "Please enter title"
                },
                description: {
                    required: "Please enter description"
                },
                image: {
                    required: "Please enter image"
                },
                ordering: {
                    required: "Please enter ordering",
                    digits: "Please enter a valid number",
                    minlength: "Please enter number"

                },
                status: {
                    required: "Please enter status"
                }
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });
    </script>