<?php
include("../conn.php");
if (!isset($_SESSION['adminDetails'])){
    header("location:index.php?error=You need to log in");
}
$adminUser = $_SESSION['adminDetails'];

$sql = "SELECT * FROM feeds";
$query = $conn->query($sql);
$feeds = $query->fetch_all(MYSQLI_ASSOC);

$sql = "SELECT * FROM users";
$query = $conn->query($sql);
$users = $query->fetch_all(MYSQLI_ASSOC);
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
    <div class="row">
        <div class="col-md-6">
            <span> Total registered users </span>
            <span> <?php echo count($users) ?> </span>
        </div>
        <div class="col-md-6">
            <span> Total Feed </span>
            <span> <?php echo count($feeds) ?> </span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <a href="users.php">Users</a>
        </div>
        <div class="col-md-6">
            <a href="feed.php">All Feed</a>
        </div>
    </div>
</div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.js"></script>
<script src="bootstrap-toastr/toastr.min.js"></script>
</html>
