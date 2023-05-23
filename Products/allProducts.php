<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

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
<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <?php
    include("../dbContext.php");

    include("../header.php");
    ?>

    <br>
    <br>
    <br>
    <br>
    <form action="allProducts.php" method="get">
        <label for="category">Filter by category:</label>
        <select name="category" id="category">
            <option value="">All Categories</option>
            <?php
            // Connect to database and fetch all unique product categories
            $sql = "SELECT * FROM categories";
            $result = mysqli_query($conn, $sql);

            // Loop through each category and add as an option to the dropdown
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<option value="' . $row['CategoryId'] . '">' . $row['CategoryName'] . '</option>';
            }
            ?>
        </select>
        <input type="submit" value="Filter">
    </form>


    <?php
    //session_start();
    $emptyList = "";
    $sql = "SELECT * FROM products";
    $result = $conn->query($sql);
    if (!$result) {
        $emptyList = "Nuk ka asnje kurs per momentin";
    }
    echo '
    <div class="courses-area section-padding40 fix">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-7 col-lg-8">
                    <div class="section-tittle text-center mb-55">
                        <h2>All Clothes</h2>
                    </div>
                </div>
            </div>
            <div class="flex-center-start">
                ' . $emptyList . '
                </div>
                ' ?>
    <div class="row properties__caption carousel slide ">
        <?php

        while ($row = $result->fetch_assoc()) {
            $prdId = $row['ProductId'];
            $sizeQuery = "SELECT sizes.SizeName FROM sizes JOIN products ON sizes.SizeId = products.SizeId WHERE products.ProductId = $prdId";
            $resultSize = $conn->query($sizeQuery);

            if ($resultSize->num_rows > 0) {
                // Fetch a single row
                $rowSize = $resultSize->fetch_assoc();

                $genderQuery = "SELECT genders.GenderName FROM genders JOIN products ON genders.GenderId = products.GenderId WHERE products.ProductId = $prdId";
                $resultGenderJoin = $conn->query($genderQuery);
                if ($resultGenderJoin->num_rows > 0) {
                    // Fetch a single row
                    $rowGender = $resultGenderJoin->fetch_assoc();
                    $stmt = "SELECT categories.CategoryName FROM categories JOIN products ON categories.CategoryId = products.CategoryId WHERE products.ProductId = $prdId";
                    $resultJoin = $conn->query($stmt);
                    if ($resultJoin->num_rows > 0) {
                        $rowCategory = $resultJoin->fetch_assoc();
                    }
                    $editBtn = '';
                    //echo("Test" . $_SESSION['role']);
                    $deleteBtn = '';
                    if (isset($_SESSION['role']) &&  $_SESSION['role'] === 'admin') {
                        $editBtn = '<a id="edit_btn" class="btn btn-outline-primary" href="../Products/edit.php?id=' . $row['ProductId'] . '" role="button">Edit</a>';
                        $deleteBtn = '<a id="delete_btn" class="btn btn-outline-primary" href="../Products/delete.php?id=' . $row['ProductId'] . '" role="button">Delete</a>';
                        //$deleteBtn = '<button type="button" value="' . $row['ProductId'] . '" class="btn btn-outline-primary delete_product_btn">Delete</button>';
                    }
                    echo '
                <div class="col-md-4">
                <div class="properties properties2 mb-30">
                <div class="properties__card">
                    <div class="properties__img overlay1">
                            <img src="../Doc/img/' . $row["ImageUrl"] . '" />
                    </div>
                    <div class="properties__caption">
                        <p>Product Name: ' . $row["ProductName"] . '</p>
                        <h3>Description: ' . $row["Description"] . '</h3>
                        <h3>Size: ' . $rowSize["SizeName"] . '</h3>
                        <h3>Gender: ' . $rowGender["GenderName"] . '</h3>
                        <h3>Category: ' . $rowCategory["CategoryName"] . '</h3>
                        <div class="properties__footer d-flex justify-content-between align-items-center">
                            <div class="restaurant-name">
                                <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half"></i>
                                </div>
                                <p><span>(4.5)</span> based on 120</p>
                            </div>
                            <div class="price">
                                <span>' . $row["Price"] . '</span>
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
        ?>
    </div>

    <div class="row justify-content-center">
        <div class="col-xl-7 col-lg-8">
            <div class="section-tittle text-center mt-40">
                <a href="/Course/Index" class="border-btn">Load More</a>
            </div>
        </div>
    </div>
    </div>
    </div>




    <?php
    include("../footer.php");
    ?>
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
    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>



    <script src="../assets/js/vendor/modernizr-3.5.0.min.js"></script>
    <!-- Jquery, Popper, Bootstrap -->
    <script src="../assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <!-- Jquery Mobile Menu -->
    <script src="../assets/js/jquery.slicknav.min.js"></script>

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
    <script src="../assets/js/jquery.barfiller.js"></script>

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