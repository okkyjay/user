<?php
session_start();
$dbServername = "localhost";
$dbUsername  = "root";
$dbPassword = "";
$dbName = "social";
$conn =new mysqli($dbServername, $dbUsername, $dbPassword, $dbName);
if ($conn->connect_errno){
    echo "Oops!! Connection failed";
    exit();
}
