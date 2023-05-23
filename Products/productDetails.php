<?php
include("../dbContext.php");
include("../header.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details</title>
</head>
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
<style>
    body {
        background-image: url("../assets/img/hero/login.jpg");
        background-size: cover;
    }
</style>

<body>
    <br>
    <br>
    <br>
    <br>
    <h1 class="mx-auto" style="width: 200px;">Details</h1>
    <br />
    <br />
    <?php
    // Retrieve the product ID from the query parameter
    $id = $_GET["id"];

    $sql = "SELECT `ProductId`, `ProductName`, `Description`, `Price`, `ImageUrl`, `UpdatedById`, `DeletedById`, `CreatedOn`, `UpdatedOn`, `IsRelease`, `CategoryId`, `GenderId`, `SizeId` FROM `products` WHERE ProductId= $id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $sizeQuery = "SELECT sizes.SizeName FROM sizes JOIN products ON sizes.SizeId = products.SizeId WHERE products.ProductId = $id";
            $resultSize = $conn->query($sizeQuery);

            if ($resultSize->num_rows > 0) {
                // Fetch a single row
                $rowSize = $resultSize->fetch_assoc();

                $genderQuery = "SELECT genders.GenderName FROM genders JOIN products ON genders.GenderId = products.GenderId WHERE products.ProductId = $id";
                $resultGenderJoin = $conn->query($genderQuery);
                if ($resultGenderJoin->num_rows > 0) {
                    // Fetch a single row
                    $rowGender = $resultGenderJoin->fetch_assoc();

                    echo '<div class="container">
    <div class="card">
        <div class="container-fliud">
            <div class="wrapper row">
                <div class="preview col-md-6">

                    <div class="preview-pic tab-content">
                        <div class="tab-pane active" id="pic-1"><img src="../Doc/img/' . $row["ImageUrl"] . '" style="width:50%;height:50%;" /></div>

                    </div>


                </div>
                <div class="details col-md-6">
                    <h3 class="product-title">' . $row["ProductName"] . '</h3>
                    <div class="rating">
                        <div class="stars">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                        </div>
                        <span class="review-no">41 reviews</span>
                    </div>
                    <p class="product-description"><b>Description: </b>' . $row["Description"] . '</p>
                    <p class="product-description"><b>Size: </b>' . $rowSize["SizeName"] . '</p>
                    <h4 class="price">Price: <span>$' . $row["Price"]  . '</span></h4>
                    <h4 class="product-description">Gender: <span>' . $rowGender["GenderName"]  . '</span></h4>';

                    echo '<div class="action">
                            <div style="width: 500px !important" onclick="window.event.cancelBubble=\'true\'">
                                <form class="form-inline" method="POST" action="#">
                                    
                                    <input type="hidden" value="' . $row["ProductName"] . '" name="id" />
                                    <div class="input-group-append w-100">
                                        
                                    </div>
                                </form>
                            </div>
                        </div>';

                    echo '</div>
            </div>
        </div>
    </div>
</div>';
                }
            }
        }
    }

    ?>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <?php

    include("../footer.php");
    ?>
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