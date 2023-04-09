<?php 

try {
    $testPass = password_hash("Daniel2001-!", PASSWORD_DEFAULT);
//echo ($testPass);

$conn = mysqli_connect("localhost", "root", "", "clothesstoredb");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
}catch(\PDOException $e){
    
}
