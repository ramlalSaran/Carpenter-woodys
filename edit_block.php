<?php
include_once('./includes/config.php');
include_once('login-valideter.php');
$id=$_GET['id'];

if ($id) {
    $sel="SELECT * FROM `blocks` where id = '$id'";
    $select=$conn->query($sel);
    $row=mysqli_fetch_assoc($select);
}

if (isset($_POST['update'])) {
    $title=$_POST['title'];
    $heading=$_POST['heading'];
    $description=$_POST['description'];
    $banner_image=$_FILES['banner_image']['name'];
    $ordering=$_POST['ordering'];
    $status=$_POST['status'];

    $identifier=strtolower($heading);
    $identifier=preg_replace('/[^a-zA-Z0-9-]+/', '-', $identifier);
$identifier=preg_replace('/-+/', '-', $identifier);
    
    
    if ($banner_image !=='') {
       
        $update = "UPDATE `blocks` SET  `indentifier` = '$identifier', `title` = '$title', `heading` = '$heading', `description` = '$description', `banner-image` = '$banner_image', `ordering` = '$ordering', `status` = '$status' WHERE `id` = '$id'";
    }else{
    $update = "UPDATE `blocks` SET  `indentifier` = '$identifier', `title` = '$title', `heading` = '$heading', `description` = '$description',  `ordering` = '$ordering', `status` = '$status' WHERE `id` = '$id'";
    }
    // dd($inQuery);
    $result=$conn->query($update);
    if ($result) {
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
                            <label for="name">title</label>
                            <input type="text" class="form-control" id="title" placeholder="Title" name="title" value="<?=$row['title']?>" required>

                        </div>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name">Heading</label>
                            <input type="text" class="form-control" id="heading" placeholder="Heading" name="heading" value="<?=$row['heading']?>" required>
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
                                        <textarea id="editor1" name="description"  rows="" cols="50" required><?=$row['description']?></textarea>
                                  </div>
                            </div><!-- /.box -->
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="banner-image">Banner image</label>
                            <input type="file" class="form-control" id="banner_image" name="banner_image" >
                            <img src=<?="./blocks_image/".$row['banner-image']?> alt="not found" width="120px" height="100px">
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name">Ordering</label>
                            <input type="number" class="form-control" id="ordering" placeholder="ordering"
                                name="ordering" value="<?=$row['ordering']?>" required>

                        </div>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <select name="status" class="form-control" id="status"required>
                                <option value="">Select status</option>
                                <option value="1"<?=((($row['status']=='1')?'selected':''))?>>Enable</option>
                                <option value="2"<?=((($row['status']=='2')?'selected':''))?>>Disable</option>
                            </select>
                        </div>
                    </div>
            </div><!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-success" name="update" id="btn">Update</button>
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
 