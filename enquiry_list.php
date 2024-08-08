<?php
include_once('./includes/config.php');
include_once('login-valideter.php');
$sel="SELECT * FROM `enquiries`";
$select=$conn->query($sel);
$totalRows=$select->num_rows;
$perpage=5;
$pages=ceil($totalRows/$perpage);
$page=$_GET['page']??1;
$startpage=(--$page)*$perpage;
$query="SELECT * FROM `enquiries` LIMIT $startpage,$perpage";
// dd($query);
$select=$conn->query($query);

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
                <h1>
                    Dashboard
                    <small>Version 2.0</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Dashboard</li>
                </ol>
            </section>
            <?php
include_once('./includes/message.php');
?>
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title"><b>Enquiry List</b> </h3>
                                <div class="box-tools">
                                    <div class="input-group">
                                        <input type="text" name="table_search" class="form-control input-sm pull-right"
                                            style="width: 150px;" placeholder="Search" />
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-default"><i
                                                    class="fa fa-search"></i>Search</button>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.box-header -->
                            <div class="box-body table-responsive no-padding">
                                <table class="table table-hover text-center">
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Massege</th>
                                        <th>status</th>
                                        <th>Created_at</th>
                                        <th>Update_time</th>
                                    </tr>
                                    <?php
                                    $i=$startpage+1;
                                    while ($row=mysqli_fetch_assoc($select)) {
                                    ?>
                                        <tr>
                                        <td><?=$i++?></td>
                                        <td><?=$row['name']?></td>
                                        <td><?=$row['email']?></td>
                                        <td><?=$row['phone']?></td>
                                        <td><?=$row['message']?></td>
                                        <td><?= $row['status'] == 1 ? '<span class="label label-success">read</span>' : '<span class="label label-danger">unread</span>'; ?></td>
                                        <td><?=$row['created_at']?></td>
                                        <td><?=$row['updated_at']?></td>
                                    <?php
                                    }
                                        ?>
                                    </tr>
                                </table>
                                <ul class="pagination pagination-sm no-margin pull-right">
                                    <li><a>Previos</a></li>
                                    <?php
                                        for($i=1; $i<=$pages ; $i++) { 
                                    ?>
                                    <li><a href="?page=<?=$i?>"><?=$i?></a></li>
                                    <?php
                                    }
                                    ?>
                                    <li><a>Next</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>

        <?php include_once('./includes/footer.php'); ?>

    </div><!-- ./wrapper -->
    <?php include_once('./includes/footer-js.php'); ?>
</body>

</html>