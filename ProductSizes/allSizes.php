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

    ?>
    <div class="container">
        <a id="edit_btn" class="btn btn-outline-primary" href="../ProductSizes/addSize.php" role="button">Add New Sizes</a>
        <br>
        <br>
        <br>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Assuming you have a $conn variable that holds your database connection
                $sql = "SELECT * FROM sizes";
                $sqlResult = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($sqlResult)) {
                    echo "<tr>";
                    echo "<td>" . $row['SizeId'] . "</td>";
                    echo "<td>" . $row['SizeName'] . "</td>";
                    echo '<td>';
                    echo '<a id="edit_btn" class="btn btn-outline-primary" href="../ProductSizes/edit.php?id=' . $row['SizeId'] . '" role="button">Update</a>';
                    echo '&nbsp';
                    echo '<a id="edit_btn" class="btn btn-outline-primary" href="../ProductsSizes/delete.php?id=' . $row['SizeId'] . '" role="button">Delete</a>';
                    echo '</td>';
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

    </div>
    <br>
    <br>
    <br>
    <br>
    <?php
    include("../footer.php");
    ?>

</body>

</html>