<?php
include("conn.php");
unset($_SESSION['userDetails']);
session_destroy();
    header("location:index.php");

