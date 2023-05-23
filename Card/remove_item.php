<?php
session_start();

if (isset($_GET['index'])) {
  $index = $_GET['index'];
  echo $index;

  if (array_key_exists($index, $_SESSION['productsToAdd'])) {
    unset($_SESSION['productsToAdd'][$index]);
  }
}
// Redirect back to the cart page
//header('Location: displayUserCard.php');
exit;
?>