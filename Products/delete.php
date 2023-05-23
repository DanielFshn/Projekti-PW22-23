<?php
include("../dbContext.php");

$id = $_GET["id"];
$isRelease = false;
$userId = 1;
$sql = "UPDATE `products` SET `IsRelease`='$isRelease' , `UpdatedById` = $userId WHERE ProductId=$id";
$result = mysqli_query($conn, $sql);
if ($sql) {
    echo ("<script>alert('Product is deleted succesfully!');</script>");
    $url = "http://localhost:3000/index.php";
    header("refresh:0;url=$url");
    exit;
} else {
    echo "Fail" . mysqli_error($conn);
}
