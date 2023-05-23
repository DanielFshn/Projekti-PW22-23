<?php
include("../dbContext.php");
include("../header.php");
?>
<?php
// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the values from the form
    $name = $_POST['name'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $size = $_POST['size'];
    $gender = $_POST['gender'];
    $price = $_POST['price'];
    $created_on = date('Y-m-d H:i:s');

    // Validate the inputs (you can use the validations I provided earlier)

    // If all inputs are valid, insert the product into the database
    $sql = "INSERT INTO products (ProductName, Description, Price, ImageUrl, CreatedOn, IsRelease , CategoryId, GenderId, SizeId) VALUES ('$name', '$description', '$price', '', '$created_on', '1', '$category', '$gender', '$size')";
    $sqlResult = mysqli_query($conn, $sql);
    // Get the ID of the newly inserted product
    if ($sqlResult) {
        $product_id = mysqli_insert_id($conn);
        // use $productId as needed
    }

    //$product_id = $stmt->insert_id;

    // Upload the photo (if it exists) and save the filename in the database
    if ($_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $filename = basename($_FILES['photo']['name']);
        $photo_name = $_FILES['photo']['name'];
        $photo_tmp_name = $_FILES['photo']['tmp_name'];
        $photo_ext = strtolower(pathinfo($photo_name, PATHINFO_EXTENSION));
        //$photo_new_name = uniqid() . ".$photo_ext";
        //$filenameDb = "$filename  . $photo_ext";
        $photo_path = "../Doc/img/$filename";
        if (move_uploaded_file($photo_tmp_name, $photo_path)) {
            $sqlUpdate = "UPDATE products SET ImageUrl = '$filename' WHERE ProductId = $product_id";
            $sqlResult2 = mysqli_query($conn, $sqlUpdate);
        }
    }

    // Redirect to the product page or show a success message
    // (you can customize this based on your needs)
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert</title>
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
    <br>
    <h2 class="mx-auto" style="text-align:center;">Insert Product</h2>
    <br />
    <br />
    <div class="container">
        <form method="post" enctype="multipart/form-data" action="insert.php" onsubmit="return validateForm()">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description"></textarea>
            </div>

            <div class="form-group">
                <label for="category">Category:</label>
                <select class="form-control" id="category" name="category">
                    <?php

                    // Retrieve categories from database
                    $sql = "SELECT * FROM categories";
                    $result = mysqli_query($conn, $sql);

                    // Add options to select element
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='" . $row['CategoryId'] . "'>" . $row['CategoryName'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="size">Size:</label>
                <select class="form-control" id="size" name="size">
                    <?php

                    $sqlSizes = "SELECT * FROM sizes";
                    $resultSizes = mysqli_query($conn, $sqlSizes);

                    // Add options to select element
                    while ($rowSize = mysqli_fetch_assoc($resultSizes)) {
                        echo "<option value='" . $rowSize['SizeId'] . "'>" . $rowSize['SizeName'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="gender">Gender:</label>
                <select class="form-control" id="gender" name="gender">
                    <?php
                    // Connect to the database (same as above)

                    // Retrieve genders from database
                    $sql = "SELECT * FROM genders";
                    $result = mysqli_query($conn, $sql);

                    // Add options to select element
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='" . $row['GenderId'] . "'>" . $row['GenderName'] . "</option>";
                    }

                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="price">Price:</label>
                <div class="input-group">
                    <span class="input-group-addon">$</span>
                    <input type="number" step="0.01" class="form-control" id="price" name="price">
                </div>
            </div>

            <div class="form-group">
                <label for="photo">Photo:</label>
                <input type="file" class="form-control-file" id="photo" name="photo">
            </div>

            <button type="submit" class="btn btn-primary">Add Product</button>
        </form>
    </div>

    <?php
    include("../footer.php");

    ?>
    <script>
    function validateForm() {
        // Get form elements
        var name = document.getElementById("name").value;
        var description = document.getElementById("description").value;
        var price = document.getElementById("price").value;

        // Check if any of the required fields are empty
        if (name == "" || description == "" || price == "") {
            alert("Please fill out all required fields.");
            return false;
        }
    }
</script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>

    <!-- Popper.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>










    <!-- JS here -->


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
    <script src="./assets/js/main.js"></script>


</body>

</html>