<?php
session_start();
include '../database/db.php';
// munculkan / pilih sebuah atau semua kolom dari table user
$querycustomer = mysqli_query($koneksi, "SELECT * FROM customer");
// mysqli_fetch_assoc($query) = untuk menjadikan hasil query menjadi sebuah data (object,array)

// jika parameternya ada ?delete=nilai param
if (isset($_GET['delete'])) {
    $id = $_GET['delete']; //mengambil nilai params

    // query / perintah hapus
    $delete = mysqli_query($koneksi, "DELETE FROM customer  WHERE id ='$id'");
    header("location:customer.php?hapus=berhasil");
}
?>
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

    <title>Dashboard - Analytics | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>

    <meta name="description" content="" />

    <?php include '../layout/head.php' ?>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <?php include '../layout/sidebar.php'; ?>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <?php include '../layout/navbar.php'; ?>
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header">Data customer</div>
                                    <div class="card-body">
                                        <?php if (isset($_GET['hapus'])): ?>
                                            <div class="alert alert-success" role="alert">
                                                Data Berhasil dihapus
                                            </div>
                                        <?php endif ?>
                                        <div align="right" class="mb-3">
                                            <a href="tambah-customer.php" class="btn btn-primary">Tambah</a>
                                        </div>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama customer</th>
                                                    <th>Telepon</th>
                                                    <th>Alamat</th>
                                                    <th>Aksi</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1;
                                                while ($rowcustomer = mysqli_fetch_assoc($querycustomer)) { ?>
                                                    <tr>
                                                        <td><?php echo $no++ ?></td>
                                                        <td><?php echo $rowcustomer['customer_name'] ?></td>
                                                        <td><?php echo $rowcustomer['phone'] ?></td>
                                                        <td><?php echo $rowcustomer['alamat'] ?></td>
                                                        <td>
                                                            <a href="tambah-customer.php?edit=<?php echo $rowcustomer['id'] ?>" class="btn btn-success btn-sm">
                                                                <span class="tf-icon bx bx-pencil bx-18px "></span>
                                                            </a>
                                                            <a onclick="return confirm('Apakah anda yakin akan menghapus data ini??')"
                                                                href="customer.php?delete=<?php echo $rowcustomer['id'] ?>" class="btn btn-danger btn-sm">
                                                                <span class="tf-icon bx bx-trash bx-18px "></span>
                                                            </a>

                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    <footer class="content-footer footer bg-footer-theme">
                        <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                            <div class="mb-2 mb-md-0">
                                ©
                                <script>
                                    document.write(new Date().getFullYear());
                                </script>
                                , made with ❤️ by
                                <a href="https://themeselection.com" target="_blank" class="footer-link fw-bolder">ThemeSelection</a>
                            </div>
                            <div>
                                <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank">License</a>
                                <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">More Themes</a>

                                <a
                                    href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/"
                                    target="_blank"
                                    class="footer-link me-4">Documentation</a>

                                <a
                                    href="https://github.com/themeselection/sneat-html-admin-template-free/issues"
                                    target="_blank"
                                    class="footer-link me-4">Support</a>
                            </div>
                        </div>
                    </footer>
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


    <!-- Core JS -->
    <?php include '../layout/js.php' ?>
</body>

</html>