<?php session_start(); ?>
<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
    lang="en"
    class="light-style layout-menu-fixed"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="../assets/"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Welcome To My laundry</title>

    <meta name="description" content="" />

    <?php include '../layout/head.php' ?>
</head>

<body class="body-background">
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <?php include '../layout/sidebar.php' ?>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <?php include '../layout/navbar.php' ?>

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card mt-5">
                                    <div class="card-header">
                                        <h5 class="card-title text-danger" style="font-family: Edu AU VIC WA NT Pre, serif;">Welcome To My Laundry</h5>
                                    </div>
                                    <div class="card-body text-center">
                                        <img src="../assets/img/home-logo.png" class="img-fluid h-auto" alt="" style="width:20rem;">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Revenue -->

                        <!--/ Total Revenue -->

                    </div>
                    <div class="row">
                        <!-- Order Statistics -->

                        <!--/ Order Statistics -->

                        <!-- Expense Overview -->

                        <!--/ Expense Overview -->

                        <!-- Transactions -->

                        <!--/ Transactions -->
                    </div>
                </div>
                <!-- / Content -->

                <!-- Footer -->
                <?php include '../layout/footer.php' ?>
                <!-- / Footer -->

                <div class="content-backdrop fade"></div>
            </div>
            <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->



    <?php include '../layout/js.php' ?>
</body>

</html>