<?php

try {
    $conn = mysqli_connect("localhost", "root", "", "clothesstoredb");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
} catch (\PDOException $e) {
    error_log("Database connection failed: " . $e->getMessage());
}
