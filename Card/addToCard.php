<?php

// Start or resume the session
session_start();

// Get the product ID from the POST data
$productId = $_POST['product_id'];
echo("id" . $productId);
// Create an array to store the shopping cart items
if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = [];
}

// Add the product to the shopping cart
//array_push($_SESSION['cart'], $productId);
// Check if the product is already added to the shopping cart
if (in_array($productId, $_SESSION['cart'])) {
  //echo "Product ID $productId is already in the shopping cart.";
} else {
  // Add the product to the shopping cart
  array_push($_SESSION['cart'], $productId);
  //echo "Product ID $productId has been added to the shopping cart.";
}
?>