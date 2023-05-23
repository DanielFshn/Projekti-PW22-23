<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
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
    <?php
    include("../header.php");
    include("../dbContext.php");
    $productName = $description = $price = $imageUrl = $categoryId = $genderId = $sizeId = "";
    // Get the form values
    $id = $_GET["id"];
    $formAction = "edit.php?id=" . $id;
    echo ($_SESSION['role']);
    $sql = "SELECT * from products where ProductId = $id";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $productName = $row["ProductName"];
        $description = $row["Description"];
        $price = $row["Price"];
        $imageUrl = $row["ImageUrl"];
        $categoryId = $row["CategoryId"];
        $genderId = $row["GenderId"];
        $sizeId = $row["SizeId"];
    }


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_SESSION['role'])) {
            if ($_SESSION['role'] != 'admin') {
                echo ("<script>alert('You are not aothorized to do this update!');</script>");
                //header("Location: ../index.php");
                $url = "http://localhost:3000/index.php";
                header("refresh:0;url=$url");
                exit;
            }
        }
        $nameUpdate = $_POST['name'];
        $descriptionUpdate = $_POST['description'];
        $categoryUpdate = $_POST['category'];
        $sizeUpdate = $_POST['size'];
        $genderUpdate = $_POST['gender'];
        $priceUpdate = $_POST['price'];
        $updateDate = date('Y-m-d H:i:s');

        $userEmail = $_SESSION['email'];
        $sqlGetPerson = "SELECT Id FROM `users` WHERE Email = '$userEmail' limit 1";
        $userResult = mysqli_query($conn, $sqlGetPerson);
        $userId = "";
        if ($userResult != null) {
            while ($rowUser = mysqli_fetch_assoc($userResult)) {
                $userId = $rowUser["Id"];
            }
        } else {
            echo ("<script>alert('Authentication problem!');</script>");
            //header("Location: ../index.php");
            $url = "http://localhost:3000/index.php";
            header("refresh:0;url=$url");
            exit;
        }
        if ($_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            $filename = basename($_FILES['photo']['name']);
            $photo_name = $_FILES['photo']['name'];
            $photo_tmp_name = $_FILES['photo']['tmp_name'];
            $photo_ext = strtolower(pathinfo($photo_name, PATHINFO_EXTENSION));
            //$photo_new_name = uniqid() . ".$photo_ext";
            //$filenameDb = "$filename  . $photo_ext";
            $photo_path = "../Doc/img/$filename";
            if (move_uploaded_file($photo_tmp_name, $photo_path)) {
                //filename
                $sqlUpdate = "UPDATE `products` SET `ProductName`='$nameUpdate',`Description`='$descriptionUpdate',`Price`='$priceUpdate',`ImageUrl`='$filename',`UpdatedById`='$userId',`UpdatedOn`='
                $updateDate',`CategoryId`='$categoryUpdate',`GenderId`='$genderUpdate',`SizeId`='$sizeUpdate' WHERE ProductId = $id";
                $updateResult = mysqli_query($conn, $sqlUpdate);
                if ($updateResult != null) {
                    echo ("<script>alert('Product is updatet succesfully!');</script>");
                    //header("Location: ../index.php");
                    //$url = "http://localhost:3000/index.php";
                    //header("refresh:0;url=$url");
                    exit;
                } else {
                }
            }
        } else {
            //foto is not inserted
            $updateWithoutPhoto = "UPDATE `products` SET `ProductName`='$nameUpdate',`Description`='$descriptionUpdate',`Price`='$priceUpdate',`UpdatedById`='$userId',`UpdatedOn`='
            $updateDate',`CategoryId`='$categoryUpdate',`GenderId`='$genderUpdate',`SizeId`='$sizeUpdate' WHERE ProductId = $id";
            $updateWithourPhotoResult =  mysqli_query($conn, $updateWithoutPhoto);
            if ($updateWithourPhotoResult != null) {
                echo ("<script>alert('Product is updatet succesfully!');</script>");
                //header("Location: ../index.php");
                //$url = "http://localhost:3000/index.php";
                //header("refresh:0;url=$url");
                exit;
            }
        }
    }
    ?>

    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="container">

        <form method="post" enctype="multipart/form-data" action="<?php echo $formAction; ?>">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $productName; ?>">
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description"><?php echo $description; ?></textarea>
            </div>

            <div class="form-group">
                <label for="category">Category:</label>
                <select class="form-control" id="category" name="category">
                    <?php
                    // Retrieve categories from database (same as above)
                    // ...

                    // Add options to select element
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
                    // Retrieve sizes from database (same as above)
                    // ...

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
                    // Retrieve genders from database (same as above)
                    // ...

                    // Add options to select element
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
                    <input type="number" step="0.01" class="form-control" id="price" name="price" value="<?php echo $price; ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="photo">Photo:</label>
                <input type="file" class="form-control-file" id="photo" name="photo">
            </div>

            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <button type="submit" class="btn btn-primary">Update Product</button>

        </form>
    </div>

    <br>
    <br>
    <br>
    <br>
    <br>

    <?php
    include("../footer.php");

    ?>

</body>

</html>