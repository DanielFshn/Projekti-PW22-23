<?php
include('inc/ReviewHeader.php');

?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Clothing Store</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <!-- CSS here -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/css/progressbar_barfiller.css">
    <link rel="stylesheet" href="assets/css/gijgo.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/animated-headline.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="./Products/deleteScript.js"></script>
    <!-- ? Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <!--<img src="assets/img/logo/loder.png" alt="preloader">-->
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start -->
    <header>
        <!-- Header Start -->
        <div class="header-area header-transparent">
            <div class="main-header ">
                <div class="header-bottom  header-sticky">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <!-- Logo -->
                            <div class="col-xl-2 col-lg-2">
                                <div class="logo">
                                    <a href="index.php"><img src="assets/img/hero/OIP.jpg" alt="logoPhoto" class="fluid-image" style="width:20%;"></a>
                                    <?php
                                    session_start();
                                    //if (isset($_SESSION["role"])) {
                                    //  if ($_SESSION["role"] == "admin") {
                                    //    echo ("Useri eshte admin");
                                    //} else {
                                    //  echo ("Useri eshte i thjeshte");
                                    // }
                                    //}
                                    if (isset($_SESSION['username']) && $_SESSION['username'] != "") {
                                        echo ("Hello " . $_SESSION['username']);
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-xl-10 col-lg-10">
                                <div class="menu-wrapper d-flex align-items-center justify-content-end">
                                    <!-- Main-menu -->
                                    <div class="main-menu d-none d-lg-block">
                                        <nav>
                                            <ul id="navigation">
                                                <li class="active"><a href="index.php" class="text-secondary">Home</a></li>
                                                <li class="active"><a href="./Products/allProducts.php" class="text-secondary">Products</a></li>
                                                <?php
                                                if (isset($_SESSION["role"]) && $_SESSION["role"] != "") {
                                                    if ($_SESSION['role'] == "admin") {
                                                        $sizesStyle = "";
                                                        $categoryStyle = "";
                                                        $cardStyle = "display: none";
                                                    } else {
                                                        $sizesStyle = "display: none;";
                                                        $categoryStyle = "display: none;";
                                                        $cardStyle = "";
                                                    }
                                                } else {
                                                    $sizesStyle = "display: none;";
                                                    $cardStyle = "display: none";
                                                    $categoryStyle = "display: none;";
                                                }
                                                ?>
                                                <li class="active" style="<?php echo $cardStyle ?>"><a href="./Card/displayUserCard.php"  class="text-secondary">Card</a></li>
                                                <li class="active"><a href="./ProductSizes/allSizes.php" style="<?php echo $sizesStyle; ?>" class="text-secondary">Manage Sizes</a></li>
                                                <li class="active"><a href="./Categories/index.php" style="<?php echo $categoryStyle; ?>" class="text-secondary">Manage Categories</a></li>

                                                <!-- Button -->
                                                <?php
                                                if (isset($_SESSION["email"]) && $_SESSION["email"] != "") {
                                                    $buttonStyle = "display: none;";
                                                    $logOutButtonStyle = "";
                                                    $changePasswordStyle = "";
                                                    $joinForFree = "";
                                                } else {
                                                    $buttonStyle = "";
                                                    $logOutButtonStyle = "display: none;";
                                                    $changePasswordStyle = "display: none;";
                                                    $joinForFree = "display: none;";
                                                }
                                                ?>
                                                <li class="button-header margin-left" style="<?php echo $buttonStyle; ?>"><a href="./Authentication/register.php" class="btn">Join</a></li>
                                                <li class="button-header" style="<?php echo $buttonStyle; ?>"><a href="./Authentication/login.php" class="btn">Log in</a></li>
                                                <li class="button-header" style="<?php echo $logOutButtonStyle; ?>"><a href="./Authentication/logOut.php" class="btn">Log Out</a></li>
                                                <li class="button-header" style="<?php echo $changePasswordStyle; ?>"><a href="./Authentication/resetPassword.php" class="btn">Reset Password</a></li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                            <!-- Mobile Menu -->
                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->
    </header>
    <main>
        <!--? slider Area Start-->
        <section class="slider-area ">
            <div class="slider-active">
                <!-- Single Slider -->
                <div class="single-slider slider-height d-flex align-items-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-6 col-lg-7 col-md-12">
                                <div class="hero__caption">
                                    <h1 data-animation="fadeInLeft" data-delay="0.2s" class="text-secondary"><b>Online Clothing Store</b></h1>
                                    <a href="./Authentication/register.php" class="btn hero-btn" data-animation="fadeInLeft" data-delay="0.7s">Join for Free</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Courses area start -->
        <!--Partial VIEW-->
        <div class="courses-area section-padding40 fix">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-8">
                        <div class="section-tittle text-center mb-55">
                            <h2>The newest clothes</h2>

                        </div>
                    </div>
                </div>
                <div class="row properties__caption carousel slide ">
                    <?php
                    include("dbContext.php");

                    $sql = "SELECT * FROM products WHERE CreatedOn >= DATE_SUB(NOW(), INTERVAL 20 DAY) AND IsRelease = 1 ORDER BY CreatedOn DESC LIMIT 9;";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $product_id = $row["ProductId"];
                            $stmt = "SELECT categories.CategoryName FROM categories JOIN products ON categories.CategoryId = products.CategoryId WHERE products.ProductId = $product_id";
                            $resultJoin = $conn->query($stmt);
                            if ($resultJoin->num_rows > 0) {
                                while ($row2 = $resultJoin->fetch_assoc()) {
                                    $genderQuery = "SELECT genders.GenderName FROM genders JOIN products ON genders.GenderId = products.GenderId WHERE products.ProductId = $product_id";
                                    $resultGenderJoin = $conn->query($genderQuery);
                                    if ($resultGenderJoin->num_rows > 0) {
                                        while ($rowGender = $resultGenderJoin->fetch_assoc()) {
                                            $sizeQuery = "SELECT sizes.SizeName FROM sizes JOIN products ON sizes.SizeId = products.SizeId WHERE products.ProductId = $product_id";
                                            $resultSize = $conn->query($sizeQuery);

                                            if ($resultSize->num_rows > 0) {
                                                // Fetch a single row
                                                $rowSize = $resultSize->fetch_assoc();
                                                $editBtn = '';
                                                //echo("Test" . $_SESSION['role']);
                                                $deleteBtn = '';
                                                if (isset($_SESSION['role']) &&  $_SESSION['role'] === 'admin') {
                                                    $editBtn = '<a id="edit_btn" class="btn btn-outline-primary" href="../Products/edit.php?id=' . $row['ProductId'] . '" role="button">Edit</a>';
                                                    $deleteBtn = '<a id="delete_btn" class="btn btn-outline-primary" href="../Products/delete.php?id=' . $row['ProductId'] . '" role="button">Delete</a>';
                                                    //$deleteBtn = '<button type="button" value="' . $row['ProductId'] . '" class="btn btn-outline-primary delete_product_btn">Delete</button>';
                                                }
                                            


                                                echo '<div class="col-md-4">
                        <div class="properties properties2 mb-30">
                            <div class="properties__card">
                                <div class="properties__img overlay1">
                                    <img src="../Doc/img/' . $row["ImageUrl"] . '" />
                                </div>
                                <div class="properties__caption">
                                    <p>Product name: ' . $row["ProductName"] . '</p>
                                    <h3>Description: ' . $row["Description"] . '</h3>
                                    <h3>Category:' .  $row2["CategoryName"] . '</h3>
                                    <h3>Gender: ' . $rowGender["GenderName"] . '</h3>
                                    <h3>Size: ' . $rowSize["SizeName"] . '</h3>
                                    
                                    <div class="properties__footer d-flex justify-content-between align-items-center">
                                        <div class="restaurant-name">
                                            <div class="rating">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star-half"></i>
                                            </div>
                                            <p><span>(4.5)</span></p><br>
                                            <a href="show_rating.php?item_id=' . $row['ProductId'] . '" style="color:black;">Rating & Reviews</a>
                                        </div>
                                        <div class="price">
                                            <span>  ' . $row["Price"] . '$</span>
                                        </div>

                                    </div>

                                    <div style="width: 500px !important">
                                        <div class="input-group mb-3 w-100">
                                            <input type="hidden" value="' . $rowSize["SizeName"] . '" name="id" />
                                            <div class="input-group-append w-100">
                                            <button class="btn btn-outline-primary add-to-cart-btn" type="submit" data-product-id="' . $row['ProductId'] . '">
                                            Add
                                                    </button>&nbsp;'
                                                    . $editBtn .
                                                    '&nbsp;
                                                    ' . $deleteBtn . '
                                                    
                                                    </div>
                                        </div>
                                    </div>
                                	<a href="../Products/productDetails.php?id=' . $row['ProductId'] . '" class="border-btn border-btn2">Find Out More</a>

                                </div>
                            </div>
                        </div>
                    </div>

                
                ';
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    } else {
                        echo "<p>Nuk ka asnje produkt!</p>";
                    }
                    ?>
                </div>
                <div class="row properties__caption carousel slide ">
                </div>
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-8">
                        <div class="section-tittle text-center mt-40">
                            <a href="#" class="border-btn">Load More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ? services-area -->
        <!-- footer-bottom area -->
        <div class="footer-bottom-area">
            <div class="container">
                <div class="footer-border">
                    <div class="row d-flex align-items-center">
                        <div class="col-xl-12 ">
                            <div class="footer-copy-right text-center">
                                <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                    Copyright &copy;<script>
                                        document.write(new Date().getFullYear());
                                    </script>
                                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End-->
        </div>
        </footer>
        <!-- Scroll Up -->
        <div id="back-top">
            <a title="Go to Top" href="#"> <i class="fas fa-level-up-alt"></i></a>
        </div>
    </main>
    <script>
        // Listen for clicks on the Add to Cart button
        $('.add-to-cart-btn').click(function() {
            var productId = $(this).data('product-id');
            var button = $(this);
            console.log("Id e produktiti" + productId);
            // Send an AJAX request to add the product to the cart
            $.ajax({
                url: 'http://localhost:3000//Card/addToCard.php',
                method: 'POST',
                data: {
                    product_id: productId
                },
                success: function(response) {
                    // Change the button text to indicate that the product was added successfully
                    button.text('Product added successfully!');
                }
            });
        });
    </script>
    <!-- JS here -->
    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>



    <script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
    <!-- Jquery, Popper, Bootstrap -->
    <script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="./assets/js/popper.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <!-- Jquery Mobile Menu -->
    <script src="./assets/js/jquery.slicknav.min.js"></script>

    <!-- Jquery Slick , Owl-Carousel Plugins -->
    <script src="./assets/js/owl.carousel.min.js"></script>
    <script src="./assets/js/slick.min.js"></script>
    <!-- One Page, Animated-HeadLin -->
    <script src="./assets/js/wow.min.js"></script>
    <script src="./assets/js/animated.headline.js"></script>
    <script src="./assets/js/jquery.magnific-popup.js"></script>

    <!-- Date Picker -->
    <script src="./assets/js/gijgo.min.js"></script>
    <!-- Nice-select, sticky -->
    <script src="./assets/js/jquery.nice-select.min.js"></script>
    <script src="./assets/js/jquery.sticky.js"></script>
    <!-- Progress -->
    <script src="./assets/js/jquery.barfiller.js"></script>

    <!-- counter , waypoint,Hover Direction -->
    <script src="./assets/js/jquery.counterup.min.js"></script>
    <script src="./assets/js/waypoints.min.js"></script>
    <script src="./assets/js/jquery.countdown.min.js"></script>
    <script src="./assets/js/hover-direction-snake.min.js"></script>

    <!-- contact js -->
    <script src="./assets/js/contact.js"></script>
    <script src="./assets/js/jquery.form.js"></script>
    <script src="./assets/js/jquery.validate.min.js"></script>
    <script src="./assets/js/mail-script.js"></script>
    <script src="./assets/js/jquery.ajaxchimp.min.js"></script>

    <!-- Jquery Plugins, main Jquery -->
    <script src="./assets/js/plugins.js"></script>
    <script src="./assets/js/main.js"></script>

</body>

</html>