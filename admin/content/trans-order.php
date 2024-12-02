<?php
session_start();
include '../database/db.php';
// munculkan / pilih sebuah atau semua kolom dari table trans_order
$querytrans_order = mysqli_query($koneksi, "SELECT customer.customer_name,trans_order.* FROM trans_order LEFT JOIN customer ON customer.id = trans_order.id_customer ORDER BY ID DESC");
// mysqli_fetch_assoc($query) = untuk menjadikan hasil query menjadi sebuah data (object,array)

// jika parameternya ada ?delete=nilai param
if (isset($_GET['delete'])) {
    $id = $_GET['delete']; //mengambil nilai params

    // query / perintah hapus
    $delete = mysqli_query($koneksi, "DELETE FROM trans_order  WHERE id ='$id'");
    header("location:trans-order.php?hapus=berhasil");
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
        content="width=device-width, initial-scale=1.0, trans_order-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

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
                                    <div class="card-header">Data Transaksi Laundry</div>
                                    <div class="card-body">
                                        <?php if (isset($_GET['hapus'])): ?>
                                            <div class="alert alert-success" role="alert">
                                                Data berhasil dihapus
                                            </div>
                                        <?php endif ?>
                                        <div align="right" class="mb-3">
                                            <a href="tambah-transaksi.php" class="btn btn-primary">Tambah</a>
                                        </div>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>No. Invoice</th>
                                                    <th>Pelanggan</th>
                                                    <th>tanggal</th>
                                                    <th>Status</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1;
                                                while ($rowtrans_order = mysqli_fetch_assoc($querytrans_order)) { ?>
                                                    <tr>
                                                        <td><?php echo $no++ ?></td>
                                                        <td><?php echo $rowtrans_order['order_code'] ?></td>
                                                        <td><?php echo $rowtrans_order['customer_name'] ?></td>
                                                        <td><?php echo $rowtrans_order['order_date'] ?></td>
                                                        <td>
                                                            <?php switch ($rowtrans_order['status']) {
                                                                case '1':
                                                                    $badge = "<span class='badge bg-success'> sudah dikembalikan</span>";
                                                                    break;

                                                                default:
                                                                    $badge = "<span class='badge bg-warning'> Baru</span>";
                                                                    break;
                                                            }
                                                            echo $badge;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <a href="tambah-order.php?detail=<?php echo $rowtrans_order['id'] ?>" class="btn btn-primary btn-sm">
                                                                <span class="tf-icon bx bx-show bx-18px "></span>
                                                            </a>
                                                            <a target="blank" href="print.php?id=<?php echo $rowtrans_order['id'] ?>" class="btn btn-success btn-sm">
                                                                <span class="tf-icon bx bx-printer bx-18px "></span>
                                                            </a>
                                                            <a onclick="return confirm('Apakah anda yakin akan menghapus data ini??')"
                                                                href="trans-order.php?delete=<?php echo $rowtrans_order['id'] ?>" class="btn btn-danger btn-sm">
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