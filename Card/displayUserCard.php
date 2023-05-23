<?php

// Start or resume the session
//session_start();
include('../header.php');
if(!isset($_SESSION['userid'])){
    echo ("<script>alert('Please login!');</script>");
    $url = "http://localhost:3000/index.php";
    header("refresh:0;url=$url");
    exit;
}
// Retrieve the cart array from the session
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
if (empty($cart)) {
    $element = 'Your Shoping Card Is Empty!';
}
//$_SESSION['productsToAdd'] = array();

?>
<br>
<br>
<br>
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
    <style>
        * {
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
            -webkit-text-shadow: rgba(0, 0, 0, .01) 0 0 1px;
            text-shadow: rgba(0, 0, 0, .01) 0 0 1px
        }

        body {
            font-family: 'Rubik', sans-serif;
            font-size: 14px;
            font-weight: 400;
            background: #E0E0E0;
            color: #000000
        }

        ul {
            list-style: none;
            margin-bottom: 0px
        }

        .button {
            display: inline-block;
            background: #0e8ce4;
            border-radius: 5px;
            height: 48px;
            -webkit-transition: all 200ms ease;
            -moz-transition: all 200ms ease;
            -ms-transition: all 200ms ease;
            -o-transition: all 200ms ease;
            transition: all 200ms ease
        }

        .button a {
            display: block;
            font-size: 18px;
            font-weight: 400;
            line-height: 48px;
            color: #FFFFFF;
            padding-left: 35px;
            padding-right: 35px
        }

        .button:hover {
            opacity: 0.8
        }

        .cart_section {
            width: 100%;
            padding-top: 93px;
            padding-bottom: 111px
        }

        .cart_title {
            font-size: 30px;
            font-weight: 500
        }

        .cart_items {
            margin-top: 8px
        }

        .cart_list {
            border: solid 1px #e8e8e8;
            box-shadow: 0px 1px 5px rgba(0, 0, 0, 0.1);
            background-color: #fff
        }

        .cart_item {
            width: 100%;
            padding: 15px;
            padding-right: 46px
        }

        .cart_item_image {
            width: 133px;
            height: 133px;
            float: left
        }

        .cart_item_image img {
            max-width: 100%
        }

        .cart_item_info {
            width: calc(100% - 133px);
            float: left;
            padding-top: 18px
        }

        .cart_item_name {
            margin-left: 7.53%
        }

        .cart_item_title {
            font-size: 14px;
            font-weight: 400;
            color: rgba(0, 0, 0, 0.5)
        }

        .cart_item_text {
            font-size: 18px;
            margin-top: 35px
        }

        .cart_item_text span {
            display: inline-block;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            margin-right: 11px;
            -webkit-transform: translateY(4px);
            -moz-transform: translateY(4px);
            -ms-transform: translateY(4px);
            -o-transform: translateY(4px);
            transform: translateY(4px)
        }

        .cart_item_price {
            text-align: right
        }

        .cart_item_total {
            text-align: right
        }

        .order_total {
            width: 100%;
            height: 60px;
            margin-top: 30px;
            border: solid 1px #e8e8e8;
            box-shadow: 0px 1px 5px rgba(0, 0, 0, 0.1);
            padding-right: 46px;
            padding-left: 15px;
            background-color: #fff
        }

        .order_total_title {
            display: inline-block;
            font-size: 14px;
            color: rgba(0, 0, 0, 0.5);
            line-height: 60px
        }

        .order_total_amount {
            display: inline-block;
            font-size: 18px;
            font-weight: 500;
            margin-left: 26px;
            line-height: 60px
        }

        .cart_buttons {
            margin-top: 60px;
            text-align: right
        }

        .cart_button_clear {
            display: inline-block;
            border: none;
            font-size: 18px;
            font-weight: 400;
            line-height: 48px;
            color: rgba(0, 0, 0, 0.5);
            background: #FFFFFF;
            border: solid 1px #b2b2b2;
            padding-left: 35px;
            padding-right: 35px;
            outline: none;
            cursor: pointer;
            margin-right: 26px
        }

        .cart_button_clear:hover {
            border-color: #0e8ce4;
            color: #0e8ce4
        }

        .cart_button_checkout {
            display: inline-block;
            border: none;
            font-size: 18px;
            font-weight: 400;
            line-height: 48px;
            color: #FFFFFF;
            padding-left: 35px;
            padding-right: 35px;
            outline: none;
            cursor: pointer;
            vertical-align: top
        }
    </style>
</head>

<body>

    <div class="cart_section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="cart_container">
                        <div class="cart_title">Shopping Cart</div>
                        <?php
                        $totalPrice = 0;
                        ?>
                        <?php
                        include("./shopProduct.php");
                        foreach ($cart as $productId) : ?>
                            <?php
                            include("../dbContext.php");
                          
                            //echo ("Product ID = > " . $productId);
                            $_SESSION['productsToAdd'] = array();
                            $sql = "SELECT * FROM products WHERE ProductId = '$productId'";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {

                                $prd = null;
                                while ($row = $result->fetch_assoc()) {
                                    $name = $row["ProductName"];
                                    $desc = $row["Description"];
                                    $price = $row["Price"];
                                    $category = $row["CategoryId"];
                                    $size = $row["SizeId"];
                                    $image = $row["ImageUrl"];
                                    $prd = new ProductToAdd($productId,$name, $desc, $price, $category, $size, $image);
                                    array_push($_SESSION['productsToAdd'], $prd);
                                    $totalPrice = $totalPrice + $price;
                                    $_SESSION['TotalAmount'] = $totalPrice;
                                }
                            }
                            //$result = mysqli_query($conn,$sql);
                            //while ($row = mysqli_fetch_assoc($result)) {
                            //  $name = $row["ProductName"];
                            //}
                            ?>

                            <div class="cart_items">
                                <ul class="cart_list">
                                    <?php foreach ($_SESSION['productsToAdd'] as $index => $product) : ?>
                                        <li class="cart_item clearfix">
                                            <div class="cart_item_image"><img src="../Doc/img/<?php echo $product->getImage(); ?>" /></div>
                                            <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                                                <div class="cart_item_name cart_info_col">
                                                    <div class="cart_item_title">Name</div>
                                                    <div class="cart_item_text"><?php echo $product->getName(); ?></div>
                                                </div>
                                                <div class="cart_item_color cart_info_col">
                                                    <div class="cart_item_title"> Description</div>
                                                    <div class="cart_item_text"><?php echo $product->getDescription() ?></div>
                                                </div>
                                                <div class="cart_item_quantity cart_info_col">
                                                    <div class="cart_item_title">Price </div>
                                                    <div class="cart_item_text"><?php echo '$' . $product->getPrice() ?></div>
                                                </div>

                                                <div class="cart_item_quantity cart_info_col">
                                                    <div class="cart_item_title">Quantity </div>
                                                    <div class="cart_item_input">
                                                        <input type="number" name="quantity" value="1" min="1" step="1">
                                                    </div>
                                                </div>
                                                <div>
                                                    <!--  @Html.ActionLink("Remove", "RemoveFromCart", "Order", new { id = item.Id }, new { @class = "btn btn-danger" })-->
                                                    <a id="edit_btn" class="btn btn-outline-primary" href="./remove_item.php?index=<?php echo $index ?>" role="button">Remove</a>
                                                </div>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endforeach; ?>

                        <h4></h4>

                        <div class="order_total">
                            <div class="order_total_content text-md-right">
                                <div class="order_total_title">Order Total:</div>
                                <div class="order_total_amount"><?php echo '$' . $totalPrice ?></div>
                            </div>
                        </div>
                        <div class="cart_buttons"> </div>


                        <a href="./saveOrder.php" class="button cart_button_checkout">Save Order</a>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- HTML for the shopping cart table -->

    <?php
    include('../footer.php');
    ?>
</body>

</html>