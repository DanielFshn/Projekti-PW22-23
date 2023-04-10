<?php
session_start();
include("../dbContext.php");
if (isset($_SESSION["loggedin"])) {
    header("Location: ../index.php");
    exit;
}
$incorrect_email = $incorrect_password = "";
$email = $password = "";
$email_err = $password_err = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // validate username
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter email.";
    } else {
        $email = trim($_POST["email"]);
    }

    // validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    //$email = $_POST['email'];
    //$password = $_POST['password'];
    if ($email != '' && $password != '') {
        $sql = "SELECT * FROM users WHERE Email='$email'";
        $result = mysqli_query($conn, $sql);
        if ($result != null) {
            // Get user's password hash from database
            $row = mysqli_fetch_assoc($result);
            //$hash = $row['Password'];
            //$hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
            // Verify password
            if ($row != null) {
                if ($row['isActivated'] == false) {
                    echo ("<script>alert('Please verify your account!');</script>");
                    //header("Location: ../index.php");
                    exit;
                }
                if (password_verify($password, $row['Password_hash'])) {
                    // Start session and redirect to home page
                    //session_start();
                    $_SESSION['username'] = $row['Name'];
                    $_SESSION['surname'] = $row["Surname"];
                    $_SESSION['email'] = $row["Email"];
                    $_SESSION['loggedin'] = true;
                    header("Location: ../index.php");
                    exit;
                } else {
                    $incorrect_password = "Incorrect password!";
                    $password = '';
                }
            } else {
                $incorrect_email = "Email not found!";
                $email = '';
            }
        }
        // Close database connection
        mysqli_close($conn);
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

        <form class="form-default" action="../Authentication/login.php" method="post">

            <div class="login-form">
                <?php
                if (!empty($incorrect_password) || !empty($incorrect_email) || !empty($email_err) || !empty($password_err)) {
                    echo '<div class="alert alert-danger">' . $incorrect_password . "<br>" . $incorrect_email . "<br>" . $email_err . "<br>" . $password_err . '</div>';
                }
                ?>
                <!-- logo-login -->
                <div class="logo-login">
                    <a href="../index.php"><img src="../assets/img/logo/loder.png" alt=""></a>
                </div>
                <h2>Login Here</h2>
                <div class="form-input">
                    <label for="email">Email</label>
                    <input type="email" name="email" value="<?php echo $email; ?>">
                </div>
                <div class="form-input">
                    <label for="password">Password</label>
                    <input type="password" name="password">
                </div>
                <div class="form-input pt-30">
                    <input type="submit" name="submit" value="Login">
                </div>

                <a href="../Authentication/emailForReset.php" class="forget">Forget Password</a>
                <a href="../Authentication/register.php" class="registration">Registration</a>
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