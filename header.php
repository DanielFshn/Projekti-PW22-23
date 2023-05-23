<header>
    <!-- Header Start -->
    <div class="header-area header-transparent">
        <div class="main-header ">
            <div class="header-bottom  header-sticky">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <!-- Logo -->
                        <div class="col-xl-2 col-lg-2">
                            <div class="logo">
                                <a href="../index.php"><img src="../assets/img/hero/OIP.jpg" alt="logoPhoto" class="fluid-image" style="width:20%;"></a>
                                <?php
                                session_start();
                                if (isset($_SESSION['username']) && $_SESSION['username'] != "") {
                                    echo ("Hello " . $_SESSION['username']);
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-xl-10 col-lg-10">
                            <div class="menu-wrapper d-flex align-items-center justify-content-end">
                                <!-- Main-menu -->
                                <div class="main-menu d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li class="active"><a href="../index.php" class="text-secondary">Home</a></li>
                                            <li class="active"><a href="../Products/allProducts.php" class="text-secondary">Products</a></li>

                                            <?php
                                                if(isset($_SESSION["role"] ) && $_SESSION["role"] != ""){
                                                    if($_SESSION['role'] == "admin"){
                                                        $sizesStyle = "";
                                                        $categoryStyle = "";
                                                    }else{
                                                        $sizesStyle = "display: none;";
                                                        $categoryStyle = "display: none;";
                                                    }
                                                }else{
                                                    $sizesStyle = "display: none;";
                                                    $categoryStyle = "display: none;";
                                                }
                                                ?>
                                                  <li class="active"><a href="../ProductSizes/allSizes.php" style="<?php echo $sizesStyle; ?>" class="text-secondary">Manage Sizes</a></li>
                                                <li class="active"><a href="../Categories/index.php" style="<?php echo $categoryStyle; ?>" class="text-secondary">Manage Categories</a></li>
                                            <!-- Button -->
                                            <?php
                                            if (isset($_SESSION["email"]) && $_SESSION["email"] != "") {
                                                $buttonStyle = "display: none;";
                                                $logOutButtonStyle = "";
                                                $changePasswordStyle = "";
                                                $joinForFree = "";
                                            } else {
                                                $buttonStyle = "";
                                                $logOutButtonStyle = "display: none;";
                                                $changePasswordStyle = "display: none;";
                                                $joinForFree = "display: none;";
                                            }
                                            ?>
                                            <li class="button-header margin-left" style="<?php echo $buttonStyle; ?>"><a href="../Authentication/register.php" class="btn">Join</a></li>
                                            <li class="button-header" style="<?php echo $buttonStyle; ?>"><a href="../Authentication/login.php" class="btn">Log in</a></li>
                                            <li class="button-header" style="<?php echo $logOutButtonStyle; ?>"><a href="../Authentication/logOut.php" class="btn">Log Out</a></li>
                                            <li class="button-header" style="<?php echo $changePasswordStyle; ?>"><a href="../Authentication/resetPassword.php" class="btn">Reset Password</a></li>

                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <!-- Mobile Menu -->
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->
</header>