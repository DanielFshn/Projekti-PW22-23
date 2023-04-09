<?php
session_start();
if (isset($_SESSION['email'])) {
	unset($_SESSION['email ']);
}
session_unset();
session_destroy();
header('Location:login.php');
exit();
