<?php
session_start();
include '../database/db.php';

// jika button simpan di tekan
if (isset($_POST['simpan'])) {
    $customer_name = $_POST['customer_name'];
    $phone = $_POST['phone'];
    $alamat = $_POST['alamat'];

    $insert = mysqli_query($koneksi, "INSERT INTO customer (customer_name, phone, alamat) VALUES ('$customer_name','$phone','$alamat')");
    header("location: customer.php?tambah=berhasil");
}


$id  = isset($_GET['edit']) ? $_GET['edit'] : '';
$queryEdit = mysqli_query($koneksi, "SELECT * FROM customer WHERE id ='$id'");
$rowEdit   = mysqli_fetch_assoc($queryEdit);


// jika button edit di klik

if (isset($_POST['edit'])) {
    $customer_name   = $_POST['customer_name'];
    $phone = $_POST['phone'];
    $alamat = $_POST['alamat'];
    $update = mysqli_query($koneksi, "UPDATE customer SET customer_name='$customer_name', phone='phone', alamat='alamat' WHERE id='$id'");
    header("location:customer.php?ubah=berhasil");
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
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header"><?php echo isset($_GET['edit']) ? 'Edit' : 'Tambah' ?> customers</div>
                                    <div class="card-body">
                                        <?php if (isset($_GET['hapus'])): ?>
                                            <div class="alert alert-success" role="alert">
                                                Data berhasil dihapus
                                            </div>
                                        <?php endif ?>

                                        <form action="" method="post" enctype="multipart/form-data">
                                            <div class="mb-3 row">
                                                <div class="col-sm-6">
                                                    <label for="" class="form-label">Tambah Nama customer</label>
                                                    <input type="text"
                                                        class="form-control"
                                                        name="customer_name"
                                                        placeholder="Masukkan nama customer anda"
                                                        required
                                                        value="<?php echo isset($_GET['edit']) ? $rowEdit['customer_name'] : '' ?>">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="" class="form-label">Nomor Telepon</label>
                                                    <input type="text"
                                                        class="form-control"
                                                        name="phone"
                                                        placeholder="Masukkan nomor telepon anda"
                                                        required
                                                        value="<?php echo isset($_GET['edit']) ? $rowEdit['phone'] : '' ?>">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="" class="form-label">Alamat</label>
                                                    <input type="text"
                                                        class="form-control"
                                                        name="alamat"
                                                        placeholder="Masukkan nama customer disini"
                                                        required
                                                        value="<?php echo isset($_GET['edit']) ? $rowEdit['alamat'] : '' ?>">
                                                </div>

                                                <div class="mb-3">
                                                    <button class="btn btn-primary" name="<?php echo isset($_GET['edit']) ? 'edit' : 'simpan' ?>" type="submit">
                                                        Simpan
                                                    </button>
                                                </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
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


    <!-- Core JS -->
    <?php include '../layout/js.php' ?>
</body>

</html>