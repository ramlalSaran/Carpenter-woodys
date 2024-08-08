<?php
include_once('./includes/config.php');
include_once('login-valideter.php');
$id=$_GET['id'];
if ($id) {
$sel="select * from `team` where id='$id'";
$result = mysqli_query($conn, $sel);
$teamSel=mysqli_fetch_assoc($result);
}
if (isset($_POST['submit'])) {
    $fname=$_POST['fname'];
    $role=$_POST['role'];
    $timage=$_FILES['timage']['name'];
    $ord=$_POST['ord'];
    $status=$_POST['status'];
    if ($timage!=='') {
        $upteam="update `team` set fullname='$fname',role='$role',team_image='$timage',ordering='$ord',status='$status' where id='$id'";
        
    }else{
        $upteam="update `team` set fullname='$fname',role='$role',ordering='$ord',status='$status' where id='$id'";
    }
   $res=$conn->query($upteam);
   if ($res) {
    move_uploaded_file($_FILES['timage']['tmp_name'],'./team_image/'.$timage);
    $_SESSION['success']="Member is updated";
    header('location:show_team.php');
   }
else{
    echo "id not found";
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
                <form id="userForm" role="form" action="" method="post"enctype="multipart/form-data">
                    <input type="hidden" name="id">
                <?php
include_once('./includes/message.php');

?>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name">FullName</label>
                            <input type="text" class="form-control" id="fname" placeholder="Full Name" name="fname" value="<?=$teamSel['fullname']?>">
                            
                        </div>
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select name="role" id="role"  class="form-control">
                                <option value="">Select Role</option>
                                <option value="1"<?=((($teamSel['role']=='1')?'selected':''))?>>Admin</option>
                                <option value="2"<?=((($teamSel['role']=='2')?'selected':''))?>>ui/ux designer</option>
                                <option value="3"<?=((($teamSel['role']=='3')?'selected':''))?>>Web designer</option>
                                <option value="4"<?=((($teamSel['role']=='4')?'selected':''))?>>Web Developer</option>
                                <option value="5"<?=((($teamSel['role']=='5')?'selected':''))?>>HR</option>
                                <option value="6"<?=((($teamSel['role']=='6')?'selected':''))?>>Manager</option>
                                <option value="7"<?=((($teamSel['role']=='7')?'selected':''))?>>Onner</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="image">Team image</label>
                            <input type="file" class="form-control" id="image" 
                                name="timage">
                                <img src="./team_image/<?=$teamSel['team_image']?>" alt="not found" width=80px height=80px>
                        </div>
                        <div class="form-group">
                            <label for="ord">Ordering</label>
                            <input type="number" class="form-control" id="ord" placeholder="ordering" value="<?=$teamSel['ordering']?>"
                                name="ord">
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status"  class="form-control">
                                <option value="">Select Status</option>
                                <option value="1" <?=((($teamSel['status']=='1')?'selected':''))?>>Enable</option>
                                <option value="2" <?=((($teamSel['status']=='2')?'selected':''))?>>Disable</option>
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