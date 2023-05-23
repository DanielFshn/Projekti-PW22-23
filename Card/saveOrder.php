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


    <?php
    require_once './shopProduct.php';
    session_start();
    include("../dbContext.php");
    if (!isset($_SESSION['userid'])) {
        echo ("<script>alert('Please login!');</script>");
        $url = "http://localhost:3000/index.php";
        header("refresh:0;url=$url");
        exit;
    }
    $costumerId = $_SESSION['userid'];
    $total = $_SESSION['TotalAmount'];
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $country = $_POST['country'];
        $city = $_POST['city'];
        $street = $_POST['street'];
        $postalcode = $_POST['postalcode'];
        //  $conn->begin_transaction();

        //   $conn->begin_transaction();
        try {
            $adressSql = "INSERT INTO `adressdetails`(`Country`, `City`, `StreetName`, `PostalCode`) VALUES ('$country','$city','$street','$postalcode')";
            $adressResult = $conn->query($adressSql);
            if ($adressResult) {
                $adressId = $conn->insert_id;
            }

            $order_created_on = date('Y-m-d H:i:s');
            $sqlOrder = "INSERT INTO `orders`(`CustomerId`, `CreatedOn`, `TotalAmount`) VALUES ('$costumerId','$order_created_on','$total')";
            $orderResult = $conn->query($sqlOrder);

            if ($orderResult) {
                $orderId = $conn->insert_id;
            }
            echo ("adressa - > " . $adressId);
            echo ("order - > " . $orderId);

            if (isset($_SESSION['productsToAdd']) && is_array($_SESSION['productsToAdd'])) {
                foreach ($_SESSION['productsToAdd'] as $prd1) {
                    echo 'Produkti' . $prd1->getName();
                    $price = $prd1->getPrice();
                    $prdId = $prd1->getId();
                    $sqlOrderDetails = "INSERT INTO `orderdetails`(`OrderId`, `ProductId`, `Quantity`, `UnitPrice`, `ShippingAdressId`) VALUES ($orderId,$prdId,1,$price,$adressId)";
                    $orderDetResult = mysqli_query($conn, $sqlOrderDetails);
                }
                $_SESSION['productToAdd'] = array();
            }

            echo ("<script>alert('Order is send , Thanks!');</script>");
            $url = "http://localhost:3000/index.php";
            header("refresh:0;url=$url");
            exit;
            // $conn->commit();
        } catch (Exception $e) {
            $conn->rollback();
        }
    }
    ?>

    <main class="order-body" data-vide-bg="../assets/img/hero/login.jpg">
        <!-- Login Admin -->

        <form class="form-default" action="../Card/saveOrder.php" method="post" onsubmit="return validateForm()">
            <div class="login-form">
                <!-- logo-login -->
                <div class="logo-login">
                    <a href="../index.php"><img src="../assets/img/logo/loder.png" alt=""></a>
                </div>
                <h2>Save Order</h2>
                <div class="form-input">
                    <label for="name">Name <span style="color: red;">*</span></label>
                    <input type="text" name="name" id="name">
                </div>
                <div class="form-input">
                    <label for="surname">Surname <span style="color: red;">*</span></label>
                    <input type="text" name="surname" id="surname">
                </div>
                <div class="form-input">
                    <label for="country">Country <span style="color: red;">*</span></label>
                    <input type="text" name="country" id="country">
                </div>
                <div class="form-input">
                    <label for="city">City <span style="color: red;">*</span></label>
                    <input type="text" name="city" id="city">
                </div>
                <div class="form-input">
                    <label for="street">Street Name <span style="color: red;">*</span></label>
                    <input type="text" name="street" id="street">
                </div>
                <div class="form-input">
                    <label for="postalcode">Postal Code<span style="color: red;">*</span></label>
                    <input type="text" name="postalcode" id="postalcode">
                </div>
                <div class="form-input pt-30">
                    <input type="submit" name="submit" value="Login">
                </div>
                <a href="../index.php" class="registration">Home</a>
            </div>
        </form>
        <!-- /end login form -->
    </main>




    <br><br><br><br><br><br><br><br><br><br><br><br>
    <br>
    <br>
    <br>
    <br>
    <script>
        function validateForm() {
            var name = document.getElementById("name").value.trim();
            var surname = document.getElementById("surname").value.trim();
            var country = document.getElementById("country").value.trim();
            var city = document.getElementById("city").value.trim();
            var street = document.getElementById("street").value.trim();
            var postalcode = document.getElementById("postalcode").value.trim();

            // Check if any field is empty
            if (name === "" || surname === "" || country === "" || city === "" || street === "" || postalcode === "") {
                alert("All fields are required!");
                return false;
            }

            // All fields are filled, allow form submission
            return true;
        }
    </script>
</body>

</html>