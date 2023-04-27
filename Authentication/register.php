<?php
session_start();
if (isset($_SESSION["loggedin"])) {
    header("Location: ../index.php");
    exit;
}
include("../dbContext.php");
$name = $surname = $email =  $password = $cpassword = $password_to_compare =  "";
$name_err = $surname_err = $email_err =  $password_err =  $cpassword_error = "";
$registration_success = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //see if this email exist in database
    $checkExist = "SELECT * FROM `users` WHERE Email = '$_POST[email]'";
    $checkResult = mysqli_query($conn, $checkExist);
    if (mysqli_num_rows($checkResult) == 1) {
        echo ("<script>alert('This email is registeret before!');</script>");
        //header("Location: ../index.php");
        $url = "http://localhost:3000/index.php";
        header("refresh:0;url=$url");
        exit;
    }
    //processing form data when form is submitted
    if (empty(trim($_POST["name"]))) {
        $name_err = "Please enter name.";
    } else {
        $name = trim($_POST["name"]);
        $name_err = "";
    }
    if (empty(trim($_POST["surname"]))) {
        $surname_err = "Please enter surname.";
    } else {
        $surname = trim($_POST["surname"]);
        $surname_err = '';
    }
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter email.";
    } else {
        $email = trim($_POST["email"]);
        $_SESSION['firstEmail'] = $email;
        //echo ("email : " . $_SESSION['firstEmail']);
        $email_err = '';
    }

    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        if (preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/", $_POST["password"])) {
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $password_to_compare = $_POST['password'];
            $password_err = '';
        } else {
            $password_err = 'Please enter a valid password!';
        }
    }
    if (empty(trim($_POST["cpassword"]))) {
        $cpassword_error = "Please enter your confirm password.";
    } else {
        $cpassword = $_POST["cpassword"];
        $cpassword_error = '';
    }

    if (!empty($password_to_compare) && !empty($cpassword)) {
        if ($password_to_compare != $cpassword) {
            $cpassword_error = "Passwords doesn't match!";
            //$password = '';
            //$cpassword = '';
        }
    }

    // Prepare the SQL statement to insert user
    if (!empty($name) && !empty($surname) && !empty($email) && !empty($password) && !empty($cpassword)) {
        $sql = "INSERT INTO `users`(`Name`, `Surname`, `Email`, `Password_hash`,`isActivated`) VALUES ('$name','$surname','$email','$password','0')";
        $sqlResult = mysqli_query($conn, $sql);
        $getInsertetUser = "SELECT * FROM `users` WHERE Email = '$email'";
        $userResult = mysqli_query($conn, $getInsertetUser);
        $row = mysqli_fetch_assoc($userResult);
        $insertUserRole = "INSERT INTO `user_roles`(`User_Id`, `Role_Id`) VALUES ('$row[Id]','2')";
        $insertetRoleResult = mysqli_query($conn, $insertUserRole);
        echo ("<script>alert('User is register succesfully! Please go to your email to verify account!');</script>");
        include("emailSender.php");
        //header("Location: ../index.php");
        $registration_success = true;
        $url = "http://localhost:3000/index.php";
        header("refresh:0;url=$url");
        exit;
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


    <!-- Register -->

    <main class="login-body" data-vide-bg="../assets/img/hero/login.jpg">

        <!-- Login Admin -->
        <form class="form-default" action="../Authentication/register.php" method="POST">

            <div class="login-form">
                <?php
                if (!empty($name_err) || !empty($password_err) || !empty($email_err) || !empty($surname_err) || !empty($cpassword_error)) {
                    echo '<div class="alert alert-danger">' . $name_err . "<br>" . $surname_err .
                        "<br>" . $email_err . "<br>" .  $password_err . "<br>" . $cpassword_error . '</div>';
                }
                ?>
                <!-- logo-login -->
                <div class="logo-login">
                    <a href="../index.php"><img src="../assets/img/logo/loder.png" alt=""></a>
                </div>
                <h2>Registration Here</h2>

                <div class="form-input">
                    <label for="name">Name <span style="color: red;">*</span></label>
                    <input type="text" name="name" value="<?php echo $name; ?>">
                </div>
                <div class="form-input">
                    <label for="name">Surname <span style="color: red;">*</span></label>
                    <input type="text" name="surname" value="<?php echo $surname; ?>">
                </div>
                <div class="form-input">
                    <label for="name">Email Address <span style="color: red;">*</span></label>
                    <input type="email" name="email" value="<?php echo $email; ?>">
                </div>
                <div class="form-input">
                    <label for="name">Password <span style="color: red;">*</span></label>
                    <input type="password" name="password" value="<?php echo $password; ?>">
                </div>
                <div class="form-input">
                    <label for="name">Confirm Password <span style="color: red;">*</span></label>
                    <input type="password" name="cpassword" value="<?php echo $password; ?>">
                </div>
                <div class="form-input pt-30">
                    <input type="submit" name="submit" value="Registration">
                </div>
                <!-- Forget Password -->
                <a href="../Authentication/login.php">Login</a>
                <a href="../index.php">Home</a>
            </div>
        </form>
        <!-- /end login form -->
    </main>
    <script>
        // Check if registration was successful
        <?php if ($registration_success) : ?>
            // Create popup element
            var popup = document.createElement('div');
            popup.innerHTML = 'Registration successful!';
            popup.style.position = 'fixed';
            popup.style.bottom = '0';
            popup.style.right = '0';
            popup.style.backgroundColor = '#555';
            popup.style.color = '#fff';
            popup.style.padding = '10px';
            popup.style.borderRadius = '5px';

            // Add popup element to the page
            document.body.appendChild(popup);

            // Automatically close popup after 3 seconds
            setTimeout(function() {
                popup.parentNode.removeChild(popup);
            }, 3000);
        <?php endif; ?>
    </script>

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