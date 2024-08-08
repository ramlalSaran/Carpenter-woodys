<?php
include_once('./includes/config.php');
include_once('login-valideter.php');

if (isset($_GET['id']) ) {
    $id=$_GET['id'];
    $sel="select * from `sliders` where id = '$id'";
    $runQuery=$conn->query($sel);
    $row=mysqli_fetch_assoc($runQuery);
// dd($row['image']);
}
// if (isset($_POST['update'])) {

    if (isset($_POST['update'])) {
       
        $title=$_POST['title'];
        $ordering=$_POST['ordering'];
        $status=$_POST['status'];
        $image=$_FILES['image']['name'];
  
    if ($image!=='') {
      # code...
      $upQuery="update `sliders` set title='$title' , ordering='$ordering'  , status='$status' , image='$image' where id ='$id'";
    }else{
      $upQuery="update `sliders` set title='$title' , ordering='$ordering'  , status='$status' where id ='$id'";

    }


    $query_Run=$conn->query($upQuery);
    // dd($upQuery);
    if ($query_Run) {
        move_uploaded_file($_FILES['image']['tmp_name'],"./img/".$_FILES['image']['name']);
        
        $_SESSION['success']="Data is inserted successFully  ";
        header('location:slider-list.php');
    }else{
        $_SESSION['img']="image is not upload";
        header('location:add_slider.php');
    }

}

 
    
// }

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
            <div class="box box-primary">
                <div class="box-header center">
                    <h3 class="box-title">Slider Edit </h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form id="slider_edit_Form" role="form" action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?=$row['id']?>">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name">Title</label>
                            <input type="text" class="form-control" id="title" placeholder="title" name="title"
                                value="<?=$row['title']?>">
                        </div>
                        <div class="form-group">
                            <label for="ordering">ordering</label>
                            <input type="number" class="form-control" id="ordering" placeholder="Enter ordering"
                                name="ordering" value="<?=$row['ordering']?>">
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="">-- Select Status --</option>
                                <option value="1" <?=((($row['status']=='1')? 'selected' : ''))?>>Enable</option>
                                <option value="2" <?=((($row['status']=='2')? 'selected' : ''))?>>disable</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="image">Change image</label>
                            <input type="file" class="form-control" id="image" name="image">

                            <img src=<?="./img/".$row['image']?> alt="not found" width="120px" height="100px"
                                name="image">
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
        $('#slider_edit_Form').validate({
            rules: {
                title: {
                    required: true
                },
                ordering: {
                    required: true
                },
                status: {
                    required: true
                },
            },
            messages: {
                title: {
                    required: "Please enter title"
                },
                ordering: {
                    required: "Please enter ordering"
                },
                status: {
                    required: "Please select status"
                },

            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });
    </script>