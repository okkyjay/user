<?php
include("conn.php");
if (!isset($_SESSION['userDetails'])){
    header("location:index.php?error=You need to log in");
}
$user = $_SESSION['userDetails'];


if ($_POST && isset($_POST['post'])){
    $content = $_POST['content'];
    $time = time();
     $sql = "INSERT INTO feeds (`content`, `user_id`, `date`) VALUES ('{$content}', '{$user['id']}', '{$time}')";
     $conn->query($sql);
}

if ($_GET && isset($_GET['delete'])){

    $result = [
        'status' => 0,
        'message' => 'Oops something went wrong'
    ];
    $id = $_GET['feed_id'];
    if ($id){
        $sql = "DELETE FROM feeds WHERE id='{$id}' AND user_id ='{$user['id']}'";
        $g = $conn->query($sql);
        if ($g){
            $result['status'] = 1;
            $result['message'] = "Successfully deleted";
        }
    }
    return json_encode($result);
}
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
        <div class="col-md-4">
            Left Menu
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <form action="" method="post" class="">
                        <div class="form-group">
                            <textarea id="feed-editor" name="content" class="form-control" placeholder="What's on your mind"></textarea>
                        </div>
                        <div class="form-group">
                            <button id="feed-submit-button" name="post" class="btn btn-primary pull-right">Post</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="content">
                        <hr>
                        <?php
                        $sql = "SELECT * FROM feeds WHERE user_id = '{$user['id']}'";
                        $query = $conn->query($sql);
                        $feeds = $query->fetch_all(MYSQLI_ASSOC);
                        ?>
                        <?php foreach ($feeds as $feed): ?>
                            <div id="feed-content-<?php echo $feed['id'] ?>" class="feed-content">
                                <div class="card" style="width: 18rem;">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <?php echo $user['name']?>
                                            <span style="font-size: 10px" class="pull-right">
                                                <?php echo date('d-m-Y h:i:s') ?>
                                            </span>
                                        </h5>
                                        <p class="card-text"><?php echo $feed['content'] ?></p>
                                        <a style="color: red" data-id="<?php echo $feed['id'] ?>" id="delete-feed-<?php echo $feed['id'] ?>" href="#" class="pull-right delete-feed">delete</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <a href="logout.php"><i class="fa fa-off"></i>Logout</a>
        </div>
    </div>
</div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.js"></script>
<script src="bootstrap-toastr/toastr.min.js"></script>

<script>
    $(document).on('click', '#feed-submit-button', function () {
        let content = $('#feed-editor').val();
        if (content ==""){
            alert('Editor cannot be empty')
            return false;
        }
    });

    $(document).on('click', '.delete-feed', function (event) {
        event.preventDefault();
        let d = $(this);
        let feedId = d.data('id');
        $.ajax({
            url:'feed.php?delete=1&feed_id='+feedId,
            success: function (res) {
                toastr.success("Successfully Deleted", "Request Response");

                $('#feed-content-'+feedId).hide()

                // let r = JSON.parse(res);
                // if (r.status == '0'){
                //     toastr.warning(r.message);
                // }
                // if (r.status == '1'){
                //     toastr.success(r.message)
                // }
            }

        })
        return false;
    });
</script>
</html>
