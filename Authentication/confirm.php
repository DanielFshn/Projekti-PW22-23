<?php
session_start();
include("../dbContext.php");
if (isset($_SESSION['code'])) {
    $code = $_GET['code'];
    $email = $_SESSION['firstEmail'];
   
    $sql = "SELECT * FROM users WHERE Email='$email'";
    $result = mysqli_query($conn, $sql);
    if ($result != null) {
        $row = mysqli_fetch_assoc($result);
        $updateSql = "UPDATE `users` SET `isActivated`='1' WHERE Email='$email'";
        $sqlResult = mysqli_query($conn, $updateSql);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.14.0/jquery.validate.min.js"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <form id="resetPassword">
            <h6 style="color: white;">Your account is activated!</h6>
            <div class="btn-group">
                <button id="goHome" class="btn btn-primary active">Go Home</button>
            </div>
        </form>

        <script src="authenticationScript.js"></script>
</body>

</html>