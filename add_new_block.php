<?php
include_once('./includes/config.php');
include_once('login-valideter.php');

if (isset($_POST['submit'])) {
   
    $title=$_POST['title'];
    $heading=$_POST['heading'];
    $description=$_POST['description'];
    $banner_image=$_FILES['banner_image']['name'];
    $ordering=$_POST['ordering'];
    $status=$_POST['status'];

    $identifier=strtolower($heading);
    $identifier=preg_replace('/[^a-zA-Z0-9-]+/', '-', $identifier);
$identifier=preg_replace('/-+/', '-', $identifier);

    $insert="INSERT INTO `blocks` (`indentifier`,	`title`,`heading`,`description`,`banner-image`,`ordering`,`status`)VALUES('$identifier','$title','$heading','$description','$banner_image','$ordering','$status')";
    $insertQuery=$conn->query($insert);
    if ($insertQuery) {
        move_uploaded_file($_FILES['banner_image']['tmp_name'],"./blocks_image/".$banner_image);
        $_SESSION['success']="New Block Add SuccessFully... ";
        header('location:Show_all_block.php');
    }else{
        $_SESSION['error']="image is not upload";
        header('location:add_new_block.php');
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
                <form id="userForm" role="form" action="" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="title">title</label>
                            <input type="text" class="form-control" id="title" placeholder="title" name="title" required>

                        </div>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name">Heading</label>
                            <input type="text" class="form-control" id="heading" placeholder="Heading" name="heading" required>
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
                                            title="Collapse"><i class="fa fa-minus"></i>Collapse</button>
                                        <button class="btn  btn-sm" data-widget='remove' data-toggle="tooltip"
                                            title="Remove"><i class="fa fa-times"></i>Remove</button>
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
                            <label for="banner_image">Banner image</label>
                            <input type="file" class="form-control" id="banner_image" name="banner_image" required>

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
                            <select name="status" class="form-control" id="status"required>
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


</script>