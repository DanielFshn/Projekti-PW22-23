<?php
include("../dbContext.php");
session_start();
if (!isset($_SESSION['role'])) {
    echo ("<script>alert('You are not loged in in the system!');</script>");
    //header("Location: ../index.php");
    $url = "http://localhost:3000/index.php";
    header("refresh:0;url=$url");
    exit;
}
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] != 'admin') {
        echo ("<script>alert('You are not aothorized to do this action!');</script>");
        //header("Location: ../index.php");
        $url = "http://localhost:3000/index.php";
        header("refresh:0;url=$url");
        exit;
    }
}
$id = $_GET["id"];
$sql = "DELETE FROM `categories` WHERE CategoryId = $id";
$result = mysqli_query($conn, $sql);
if ($sql) {
    echo ("<script>alert('Category is deleted succesfully!');</script>");
    $url = "http://localhost:3000/index.php";
    header("refresh:0;url=$url");
    exit;
} else {
    echo "Fail" . mysqli_error($conn);
}
