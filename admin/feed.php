<?php
include("../conn.php");
if (!isset($_SESSION['adminDetails'])){
    header("location:index.php?error=You need to log in");
}
$adminUser = $_SESSION['adminDetails'];

$sql = "SELECT * FROM feeds";
$query = $conn->query($sql);
$feeds = $query->fetch_all(MYSQLI_ASSOC);

?>
<html>
<head>
    <title>Feed</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" rel="stylesheet" />
    <link href="bootstrap-toastr/toastr.min.css" rel="stylesheet" />
</head>
<style>
    .feed-content{
        margin: 5px 0px 10px 0px;
    }
    .pull-right{
        float: right;
    }
</style>
<body>
<div style="margin-top: 10px" class="container">
    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success">
            <?php echo $_GET['success']?>
        </div>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table table-stripped">
            <thead>
                <tr>
                    <th> S/N</th>
                    <th> Name</th>
                    <th> Email</th>
                    <th> Date </th>
                    <th> Action</th>
                </tr>
            </thead>
            <tbody>
            <?php $sn = 1 ?>
                <?php foreach ($feeds as $feed): ?>
                    <tr>
                        <td><?php $sn; $sn++ ?></td>
                        <?php
                        $sql = "SELECT * FROM users WHERE id ='{$feed['user_id']}'";
                        $query = $conn->query($sql);
                        $user = $query->fetch_assoc();
                        ?>
                        <td><?php $user['name'] ?></td>
                        <td><?php  $user['email'] ?></td>
                        <td><?php  date('d-m-y', $feed['date']) ?></td>
                        <td>
                            <a class="btn btn-default btn-sm" href="">Edit</a>
                            <a class="btn btn-danger btn-sm" href="">Deleted</a>
                        </td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.js"></script>
<script src="bootstrap-toastr/toastr.min.js"></script>
</html>
