<?php
include("conn.php");
if ($_POST && isset($_POST['register'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];
    $errorMsg = "";
    $successMsg = "";
    if (empty($name) || empty($email) || empty($password) || empty($gender)){
        $errorMsg = "Some fields are empty";
    }else{
        $password = md5($password);
        $time = time();
        $sql = "INSERT INTO users (`name`, `email`, `password`, `gender`, `date`) VALUES ('{$name}', '{$email}', '{$password}', '{$gender}', '{$time}')";
        $query = $conn->query($sql);
        if ($query){
            $successMsg = "Successfully Registered!!! <br> Login with your credentials";
        }
    }
}

if ($_POST && isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $errorMsg = "";

    if (empty($email) || empty($password)){
        $errorMsg = "Some fields are empty";
    }else{
        $password = md5($password);
        $sql = "SELECT * FROM users WHERE email='{$email}' AND password ='{$password}'";
        $query = $conn->query($sql);
        if ($query->num_rows > 0){
            $userRecord = $query->fetch_assoc();
            $_SESSION['userDetails'] = $userRecord;
            header("location:feed.php?success=Successfully logged in");
        }else{
            $errorMsg = "User no found";
        }
    }
}
?>
<html>
    <head>
        <title>Home page</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />
        <link href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" rel="stylesheet" />
    </head>
    <body>
        <div style="margin-top: 10px" class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <form class="form-horizontal" method="post" action="">
                        <div class="row form-group">
                            <div class="col-md-4">
                                <label class="control-label"> Full Name</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" name="name" placeholder="Enter Full Name" class="form-control" id="fullname">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-4">
                                <label class="control-label"> Email</label>
                            </div>
                            <div class="col-md-8">
                                <input type="email" name="email" placeholder="Enter email" class="form-control" id="email">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-4">
                                <label class="control-label"> Password</label>
                            </div>
                            <div class="col-md-8">
                                <input type="password" name="password" placeholder="Enter email" class="form-control" id="password">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-4">
                                <label class="control-label"> </label>
                            </div>
                            <div class="col-md-8">
                                <span>Male</span><input type="radio" name="gender" value="male" >
                                <span>Female</span><input type="radio" name="gender" value="female">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-4">
                                <label class="control-label"> </label>
                            </div>
                            <div class="col-md-8">
                                <button type="submit" name="register">Register</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <form method="post" action="" class="form-horizontal">
                        <div class="row form-group">
                            <div class="col-md-4">
                                <label class="control-label"> Email</label>
                            </div>
                            <div class="col-md-8">
                                <input type="email" name="email" placeholder="Enter email" class="form-control" id="email">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-4">
                                <label class="control-label"> Password</label>
                            </div>
                            <div class="col-md-8">
                                <input type="password" name="password" placeholder="Enter email" class="form-control" id="password">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-4">
                                <label class="control-label"> </label>
                            </div>
                            <div class="col-md-8">
                                <button type="submit" name="login">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.js"></script>
</html>
