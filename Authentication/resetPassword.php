<?php
session_start();
include("../dbContext.php");
$incorrect_old_pass = $incorrect_new_pass = "";
$incorrect_repeat_pass = "";
$oldPass = $newPass = $repeatPass = "";
$password_match_error = '';
$actual_pass_error = '';
if (isset($_SESSION["email"])) {
    $email = $_SESSION['email'];
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (empty(trim($_POST["actualPass"]))) {
            $incorrect_old_pass = "Please enter old password!";
        } else {
            $oldPass = trim($_POST["actualPass"]);
        }
        if (empty(trim($_POST["newPass"]))) {
            $incorrect_new_pass = "Please enter new password!";
        } else {
            $newPass = trim($_POST["newPass"]);
        }
        if (empty(trim($_POST["repeatPass"]))) {
            $incorrect_repeat_pass = "Please repeat password!";
        } else {
            $repeatPass = trim($_POST["repeatPass"]);
        }
        //check if password is correct
        $oldPassHash = password_hash($oldPass, PASSWORD_DEFAULT);
        $getActualPass = "SELECT * FROM users WHERE Email='$email'";
        $result = mysqli_query($conn, $getActualPass);
        $row = mysqli_fetch_assoc($result);
        if ($oldPass != '') {
            echo("Password_hash" . $row['Password_hash']);
            echo("old pass: " . $oldPassHash);
            if (password_verify($oldPass,PASSWORD_DEFAULT)) {
                $actual_pass_error = "Old password is wrong!";
                $oldPass = '';
                $newPass = '';
                $repeatPass = '';
            }
        } else {
            if ($newPass != '' && $repeatPass != '') {
                if ($newPass == $repeatPass) {
                    $sql = "SELECT * FROM users WHERE Email='$email'";
                    $result = mysqli_query($conn, $sql);
                    if ($result != null) {
                        // Get user's password hash from database
                        $row = mysqli_fetch_assoc($result);
                        //$hash = $row['Password'];
                        $hash = password_hash($_POST['newPass'], PASSWORD_DEFAULT);
                        $updateSql = "UPDATE `users` SET `Password_hash`='$hash' WHERE Email='$email'";
                        $sqlResult = mysqli_query($conn, $updateSql);
                    }
                } else {
                    $password_match_error = "Password doesn't match!";
                    $oldPass = '';
                    $newPass = '';
                    $repeatPass = '';
                }
            }
        }
    }
}



?>

<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> App landing</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.ico">

    <!-- CSS here -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../assets/css/slicknav.css">
    <link rel="stylesheet" href="../assets/css/flaticon.css">
    <link rel="stylesheet" href="../assets/css/progressbar_barfiller.css">
    <link rel="stylesheet" href="../assets/css/gijgo.css">
    <link rel="stylesheet" href="../assets/css/animate.min.css">
    <link rel="stylesheet" href="../assets/css/animated-headline.css">
    <link rel="stylesheet" href="../assets/css/magnific-popup.css">
    <link rel="stylesheet" href="../assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="../assets/css/themify-icons.css">
    <link rel="stylesheet" href="../assets/css/slick.css">
    <link rel="stylesheet" href="../assets/css/nice-select.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <!-- ? Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start-->


    <main class="login-body" data-vide-bg="../assets/img/hero/login.jpg">
        <!-- Login Admin -->

        <form class="form-default" action="../Authentication/resetPassword.php" method="post">

            <div class="login-form">
                <?php
                if (!empty($incorrect_old_pass) || !empty($incorrect_new_pass) || !empty($incorrect_repeat_pass)) {
                    echo '<div class="alert alert-danger">' . $incorrect_old_pass . "<br>" . $incorrect_new_pass . "<br>" . $incorrect_repeat_pass . "<br>" . '</div>';
                }
                ?>
                <?php
                if (!empty($password_match_error)) {
                    echo '<div class="alert alert-danger">' . $password_match_error . "<br>" . '</div>';
                }
                ?>
                <?php
                if (!empty($actual_pass_error)) {
                    echo '<div class="alert alert-danger">' . $actual_pass_error . "<br>" . '</div>';
                }
                ?>
                <!-- logo-login -->
                <div class="logo-login">
                    <a href="index.html"><img src="../assets/img/logo/loder.png" alt=""></a>
                </div>
                <h2>Reset Password</h2>
                <div class="form-input">
                    <label for="actualPass">Actual Password</label>
                    <input type="password" name="actualPass" value="<?php echo $oldPass; ?>">
                </div>
                <div class="form-input">
                    <label for="newPass">New Password</label>
                    <input type="password" name="newPass" value="<?php echo $newPass; ?>">
                </div>
                <div class="form-input">
                    <label for="repeatPass">Repeat New Password</label>
                    <input type="password" name="repeatPass" value="<?php echo $repeatPass; ?>">
                </div>
                <div class="form-input pt-30">
                    <input type="submit" name="submit" value="ResetPassword">
                </div>
                <a href="../index.php" class="registration">Home</a>
            </div>
        </form>
        <!-- /end login form -->
    </main>


    <script src="../assets/js/vendor/modernizr-3.5.0.min.js"></script>
    <!-- Jquery, Popper, Bootstrap -->
    <script src="../assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <!-- Jquery Mobile Menu -->
    <script src="../assets/js/jquery.slicknav.min.js"></script>

    <!-- Video bg -->
    <script src="../assets/js/jquery.vide.js"></script>

    <!-- Jquery Slick , Owl-Carousel Plugins -->
    <script src="../assets/js/owl.carousel.min.js"></script>
    <script src="../assets/js/slick.min.js"></script>
    <!-- One Page, Animated-HeadLin -->
    <script src="../assets/js/wow.min.js"></script>
    <script src="../assets/js/animated.headline.js"></script>
    <script src="../assets/js/jquery.magnific-popup.js"></script>

    <!-- Date Picker -->
    <script src="../assets/js/gijgo.min.js"></script>
    <!-- Nice-select, sticky -->
    <script src="../assets/js/jquery.nice-select.min.js"></script>
    <script src="../assets/js/jquery.sticky.js"></script>
    <!-- Progress -->
    <script src="./assets/js/jquery.barfiller.js"></script>

    <!-- counter , waypoint,Hover Direction -->
    <script src="../assets/js/jquery.counterup.min.js"></script>
    <script src="../assets/js/waypoints.min.js"></script>
    <script src="../assets/js/jquery.countdown.min.js"></script>
    <script src="../assets/js/hover-direction-snake.min.js"></script>

    <!-- contact js -->
    <script src="../assets/js/contact.js"></script>
    <script src="../assets/js/jquery.form.js"></script>
    <script src="../assets/js/jquery.validate.min.js"></script>
    <script src="../assets/js/mail-script.js"></script>
    <script src="../assets/js/jquery.ajaxchimp.min.js"></script>

    <!-- Jquery Plugins, main Jquery -->
    <script src="../assets/js/plugins.js"></script>
    <script src="../assets/js/main.js"></script>

</body>

</html>