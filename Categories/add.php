<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
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
    include("../dbContext.php");
    include("../header.php");
    $url = "http://localhost:3000/index.php";
    if (!isset($_SESSION['role'])) {
        echo ("<script>alert('You are not loged in in the system!');</script>");
        //header("Location: ../index.php");
        header("refresh:0;url=$url");
        exit;
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if (isset($_SESSION['role'])) {
            if ($_SESSION['role'] != 'admin') {
                echo ("<script>alert('You are not aothorized to do this action!');</script>");
                //header("Location: ../index.php");
                header("refresh:0;url=$url");
                exit;
            }
        }
        // Get the values from the form
        $name = $_POST['categoryname'];
        //check if this exist in the database first
        $sqlCheck = "SELECT * FROM categories where CategoryName = '$name'";
        $resultCheck = mysqli_query($conn, $sqlCheck);
        if (mysqli_num_rows($resultCheck) > 0) {
            echo ("<script>alert('This category exist!');</script>");
            //header("Location: ../index.php");
            //$url = "http://localhost:3000/index.php";
            //header("refresh:0;url=$url");
            exit;
        } else {
            $sql = "INSERT INTO `categories`(`CategoryName`) VALUES ('$name')";
            $sqlResult = mysqli_query($conn, $sql);
            if ($sqlResult != null) {
                echo ("<script>alert('New category is added succesfully!');</script>");
                //header("Location: ../index.php");
                exit;
            }
        }
    }
    ?>
    <br>
    <br>
    <br>
    <br>
    <h2 class="mx-auto" style="text-align:center;">Insert Category</h2>
    <br />
    <br />
    <div class="container">
        <form method="post" action="add.php">
            <div class="form-group">
                <label for="name">Category Name:</label>
                <input type="text" class="form-control" id="categoryname" name="categoryname">
                <label id="categoryname-error" class="error" for="categoryname"></label> <!-- Added error label -->
            </div>
            <button type="submit" class="btn btn-primary">Add Category</button>

        </form>

    </div>
    <br>
    <br>
    <br>
    <?php
    include("../footer.php");
    ?>
    <script>
        // Get the form element
        const form = document.querySelector('form');

        // Add an event listener for the submit button
        form.addEventListener('submit', (event) => {
            // Get the category name input element value
            const categoryName = document.getElementById('categoryname').value;
            const categoryError = document.querySelector('#categoryname-error'); // Get the error label
            console.log(categoryName);
            // Check if the category name is empty
            if (categoryName.trim() === '') {
                // Prevent the form submission
                event.preventDefault();

                // Show the error message
                categoryError.innerHTML = 'Please enter a category name.';
                categoryError.style.color = 'red';
            } else {
                // Clear the error message
                document.getElementById('categoryname-error').textContent = '';
            }
        });
    </script>
</body>

</html>