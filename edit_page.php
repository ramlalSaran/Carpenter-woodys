<?php

include_once('./includes/config.php');
include_once('login-valideter.php');

$id=$_GET['id'];

if ($id) {
    $sel="SELECT * FROM `pages` where id = '$id'";
    $select=$conn->query($sel);
    $row=mysqli_fetch_assoc($select);
}
if (isset($_POST['submit'])) {
    // dd($_POST);
    $title=$_POST['title'];
    $heading=$_POST['heading'];
    $description=$_POST['description'];
    $image=$_FILES['image']['name'];
    $ordring=$_POST['ordering'];
    $status=$_POST['status'];

    $url_key=strtolower($heading);
    $url_key=preg_replace('/[^a-zA-Z0-9-]+/', '-', $url_key);
$url_key=preg_replace('/-+/', '-', $url_key);

if ($image!=='') {
    
    $upQuery="UPDATE `pages` SET title='$title', heading='$heading', description='$description', banner_image='$image', ordering='$ordring', status='$status', url_key='$url_key' where id ='$id' ";
}else{
    $upQuery="UPDATE `pages` SET title='$title', heading='$heading', description='$description', ordering='$ordring', status='$status', url_key='$url_key' where id ='$id' ";
    // dd($upQuery);
   
}

    $query_Run=$conn->query($upQuery);
    // dd($upQuery);
    if ($query_Run) {
        move_uploaded_file($_FILES['image']['tmp_name'],"./images/".$_FILES['image']['name']);
        $_SESSION['success']="Data is inserted successFully Add ";
        header('location:show_all_page.php');
    }else{

        $_SESSION['error']="image is not upload";
        // header('location:edit_page.php');

        
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
                <?php include_once('./includes/message.php'); ?>
                <form id="Form" role="form" action="" method="post" enctype="multipart/form-data">

                    <div class="box-body">
                        <div class="form-group">
                            <label for="name">title</label>
                            <input type="text" class="form-control" id="title" placeholder="Title" name="title"
                                value="<?=$row['title']?>" required>

                        </div>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name">Heading</label>
                            <input type="text" class="form-control" id="heading" placeholder="Heading" name="heading"
                                value="<?=$row['heading']?>" required>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <div class='box box-info'>
                                <div class='box-header'>
                                    <h3 class='box-title'>CK Editor <small>Advanced and full of features</small></h3>
                                    <!-- tools box -->
                                    <div class="pull-right box-tools">
                                        <button class="btn btn-info btn-sm" data-widget='collapse' data-toggle="tooltip"
                                            title="Collapse"><i class="fa fa-minus"></i>Collapse</button>
                                        <button class="btn btn-info btn-sm" data-widget='remove' data-toggle="tooltip"
                                            title="Remove"><i class="fa fa-times"></i>Remove</button>
                                    </div><!-- /. tools -->
                                </div><!-- /.box-header -->
                                <div class='box-body pad'>
                                    <textarea id="editor1" name="description" rows=""
                                        cols="50"><?=$row['description']?></textarea>
                                </div>
                            </div><!-- /.box -->
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="image">Banner image</label>
                            <input type="file" class="form-control" id="image" name="image"
                                value="<?=$row['banner_image']?>">
                            <img src=<?="./images/".$row['banner_image']?> alt="not found" width="120px" height="100px">


                        </div>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name">Ordering</label>
                            <input type="number" class="form-control" id="ordering" placeholder="ordering"
                                name="ordering" value="<?= $row['ordering']?>" required>

                        </div>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <select name="status" class="form-control" id="status" required>
                                <option value="">Select status</option>
                                <option value="1" <?=((($row['status']=='1')?'selected':''))?>>Enable</option>
                                <option value="2" <?=((($row['status']=='2')?'selected':''))?>>Disable</option>
                            </select>
                        </div>
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
               
                ordering: {
                    required: true,
                    digits:true,
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
                
                ordering: {
                    required: "Please enter ordering",
                    digits: "Please enter digits only",
                    minlength: "Please enter number"

                },
                status: {
                    required: "Please enter status"
                }
            },
            submitHandler: function(form) {
                form.submit();
            },
        });
    });
    </script>