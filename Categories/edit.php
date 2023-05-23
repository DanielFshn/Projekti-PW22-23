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
    <br>
    <br>
    <br>
    <br>
    <?php
    include("../dbContext.php");
    include("../header.php");

    if (!isset($_SESSION['role'])) {
        echo ("<script>alert('You are not loged in in the system!');</script>");
        //header("Location: ../index.php");
        $url = "http://localhost:3000/index.php";
        header("refresh:0;url=$url");
        exit;
    }
    $id = $_GET['id'];
    $actionUrl = "edit.php?id=" . $id;
    $sql = "SELECT * FROM categories where CategoryId = $id LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Fetch the product data as an associative array
        $row = mysqli_fetch_assoc($result);
    }
    $categoryName = $row['CategoryName'];


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_SESSION['role'])) {
            if ($_SESSION['role'] != 'admin') {
                echo ("<script>alert('You are not aothorized to do this action!');</script>");
                //header("Location: ../index.php");
                //url1 =  "http://localhost:3000/index.php";
                //header("url=$url1");
                exit;
            }
        }
        // Get the values from the form
        $name = $_POST['categoryname'];
        $sql = "UPDATE `categories` SET `CategoryName`='$name' WHERE CategoryId = $id";
        $sqlResult = mysqli_query($conn, $sql);
        if ($sqlResult != null) {
            echo ("<script>alert('New category is updated succesfully!');</script>");
            //$url2 = "http://localhost:3000/index.php";
            //header("Location: ../index.php");
            exit;
        }
    }

    ?>

    <br>
    <br>
    <br>
    <div class="container">

        <form method="post" enctype="multipart/form-data" action="<?php echo $actionUrl ?>">
            <div class="form-group">
                <label for="name">Category Name:</label>
                <input type="text" class="form-control" id="categoryname" name="categoryname" value="<?php echo $categoryName; ?>">
                <label id="categoryname-error" class="error" for="categoryname"></label> <!-- Added error label -->
            </div>
            <button type="submit" class="btn btn-primary">Update Category</button>
        </form>
    </div>
    <br>
    <br>
    <br>
    <?php
    include("../footer.php");
    ?>
    <script>
        document.querySelector('form').addEventListener('submit', (event) => {
            const sizeNameInput = document.querySelector('#categoryname');
            const sizeNameValue = sizeNameInput.value.trim();
            const sizeNameErrorLabel = document.querySelector('#categoryname-error'); // Get the error label
            if (!sizeNameValue.value) {
                sizeNameErrorLabel.innerHTML = 'Category name can not be empty';
            } else {
                sizeNameErrorLabel.innerHTML = ''; // Clear the error message
            }
        });
    </script>
</body>

</html>