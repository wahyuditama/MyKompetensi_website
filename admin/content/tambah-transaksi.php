<?php
session_start();
include '../database/db.php';

// Fetch customers and services


$id = isset($_GET['detail']) ? $_GET['detail'] : '';
$queryTransDetail = mysqli_query($koneksi, "SELECT trans_order.order_code, trans_order.order_date, 
trans_order.order_end_date, trans_order.status, service.service_name, service.harga,  
detail_trans_order.* FROM  detail_trans_order LEFT JOIN service ON service.id =  detail_trans_order.id_service 
LEFT JOIN trans_order ON trans_order.id =  detail_trans_order.id_order WHERE  detail_trans_order.id_order = '$id'");
$rowTransDetail = mysqli_fetch_all($queryTransDetail, MYSQLI_ASSOC);

// $queryCustomer = mysqli_query($koneksi, "SELECT customer.customer_name, customer.phone, customer.alamat FROM trans_order 
// LEFT JOIN customer ON customer.id = trans_order.id_customer 
// WHERE trans_order.id = '$id'");

$customerName = mysqli_query($koneksi, "SELECT id, customer_name FROM customer");

$queryCustomer = mysqli_query($koneksi, "SELECT customer.id, customer.customer_name, customer.phone, customer.alamat FROM trans_order 
LEFT JOIN customer ON customer.id = trans_order.id_customer 
WHERE trans_order.id = '$id'");


$customerDetail = mysqli_fetch_all($queryCustomer, MYSQLI_ASSOC);

$queryService = mysqli_query($koneksi, "SELECT id, service_name, harga FROM service");
$rowService = mysqli_fetch_all($queryService, MYSQLI_ASSOC);




// No. Invoice Code
// 001, jika ada auto-increment id + 1 = 002, selain itu 001
// MAX - MIN

$queryInvoice = mysqli_query($koneksi, "SELECT MAX(id) AS order_code FROM trans_order");

$str_unique = "INV";
$date_now = date("dmY");

//jika di dalam table trans_order ada datanya, + 1
if (mysqli_num_rows($queryInvoice) > 0) {
    $rowInvoice = mysqli_fetch_assoc($queryInvoice);
    $incrementPlus = $rowInvoice['order_code'] + 1;
    $code = $str_unique . "" . $date_now . "" . "000" . $incrementPlus;
} else {
    $code = "0001";
}



// Handle form submissions, mengambil nilai input dengan attribute name="" di form
if (isset($_POST['simpan'])) {
    $id_customer = $_POST['id_customer'];
    $order_code = $_POST['order_code'];
    $order_date = $_POST['order_date'];
    $order_end_date = $_POST['order_end_date'];
    $status = $_POST['status'];
    $order_pay = $_POST['order_pay'];
    $order_change = $_POST['order_change'];

    // Ambil data service dan qty
    $id_service = $_POST['id_service'];
    $qty = $_POST['qty'];
    $note = $_POST['note'];

    // Insert data ke tabel trans_order
    $insertTransOrder = mysqli_query($koneksi, "INSERT INTO trans_order (id_customer, order_code, order_date, order_end_date, status, order_pay, order_change) 
    VALUES ('$id_customer', '$order_code', '$order_date', '$order_end_date', '$status', '$order_pay', '$order_change')");

    $update = mysqli_query($koneksi, "UPDATE trans_order SET status='1' WHERE id_customer='$id'");
    // Mendapatkan ID transaksi yang baru saja dimasukkan
    $last_id = mysqli_insert_id($koneksi);

    // Loop untuk setiap service yang dipilih
    foreach ($id_service as $key => $value) {

        if (!empty($value) && !empty($qty[$key]) && (int)$qty[$key] > 0) {
            $id_service = $value;
            $quantity = (int)$qty[$key];
            $note = $note[$key];

            // Query untuk mendapatkan harga dari tabel service
            $queryPaket = mysqli_query($koneksi, "SELECT harga FROM service WHERE id='$id_service'");
            if ($rowPaketTransc = mysqli_fetch_assoc($queryPaket)) {
                $harga = $rowPaketTransc['harga'];
                $subTotal = $quantity * $harga;

                // Insert data ke tabel  detail_trans_order
                $insertDetailTransaksi = mysqli_query($koneksi, "INSERT INTO  detail_trans_order (id_order, id_service, qty, subtotal, note) 
                VALUES ('$last_id', '$id_service', '$quantity', '$subTotal', '$note')");
            }
        }
    }

    // Insert data untuk pickup laundry (jika ada)
    $pickup_date = $_POST['pickup_date'];
    $pickup_note = $_POST['pickup_note'];

    // Menyimpan data ke trans_pickup (jika ada input untuk pickup)
    if (!empty($pickup_date)) {
        $insertPickup = mysqli_query($koneksi, "INSERT INTO trans_pickup (id_order, id_customer, pickup_date, note, created_at, updated_at) 
        VALUES ('$last_id', '$id_customer', '$pickup_date', '$pickup_note', NOW(), NOW())");
    }


    header("location:trans-order.php?tambah=berhasil");
}
?>


?>

<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard - Analytics</title>
    <?php include '../layout/head.php'; ?>
</head>

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <?php include '../layout/sidebar.php'; ?>
            <div class="layout-page">
                <?php include '../layout/navbar.php'; ?>

                <div class="content-wrapper">

                    <!-- DETAIL -->
                    <!-- Detail Transaksi Eye -->

                    <?php if (isset($_GET['detail'])): ?>

                        <div class="container-xxl flex-grow-1 container-p-y">
                            <div class="row">
                                <div class="mb-3">
                                    <a href="transaksi.php" class="btn btn-outline-danger">
                                        <i class="fas fa-arrow-left">My Laundry Website</i>
                                    </a>
                                </div>

                                <div class="col-sm-12 mb-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <h5>Transaksi Laundry
                                                        <?php echo isset($customerDetail[0]['customer_name']) ? $customerDetail[0]['customer_name'] : 'N/A'; ?>
                                                    </h5>
                                                </div>
                                                <div class="col-sm-6" align="right">
                                                    <a target="_blank"
                                                        href="print.php?id=<?php echo $rowTransDetail[0]['id_order'] ?>"
                                                        class="btn btn-success">Print</a>

                                                    <?php if ($rowTransDetail[0]['status'] == 0): ?>
                                                        <a href="tambah-trans-pickup.php?ambil=<?php echo $rowTransDetail[0]['id_order'] ?>"
                                                            class="btn btn-warning">Ambil Cucian</a>
                                                    <?php endif ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Detail Data Transaksi -->
                                <div class="col-sm-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Data Transaksi</h5>

                                            <?php
                                            include 'helper.php';
                                            ?>

                                            <div class="card-body">
                                                <table class="table table-bordered table-striped">
                                                    <tr>
                                                        <th>No. Invoice</th>
                                                        <th><?php echo isset($rowTransDetail[0]['order_code']) ? $rowTransDetail[0]['order_code'] : 'N/A'; ?>
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th>Tanggal Laundry</th>
                                                        <th><?php echo isset($rowTransDetail[0]['order_date']) ? date('d-m-Y', strtotime($rowTransDetail[0]['order_date'])) : 'N/A'; ?>
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th>Tanggal Berakhir Laundry (Estimasi)</th>
                                                        <th><?php echo isset($rowTransDetail[0]['order_end_date']) ? date('d-m-Y', strtotime($rowTransDetail[0]['order_end_date'])) : 'N/A'; ?>
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th>Status</th>
                                                        <th><?php echo changeStatus($rowTransDetail[0]['status']) ?>
                                                        </th>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Detail Data Pelanggan -->
                                <div class="col-sm-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Data Pelanggan</h5>
                                            <div class="card-body">
                                                <table class="table table-bordered table-striped">
                                                    <tr>
                                                        <th>Nama</th>
                                                        <th><?php echo isset($customerDetail[0]['customer_name']) ? $customerDetail[0]['customer_name'] : 'N/A'; ?>
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th>No. Telp</th>
                                                        <th><?php echo isset($customerDetail[0]['phone']) ? $customerDetail[0]['phone'] : 'N/A'; ?>
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th>Alamat</th>
                                                        <th><?php echo isset($customerDetail[0]['alamat']) ? $customerDetail[0]['alamat'] : 'N/A'; ?>
                                                        </th>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--Transaksi Detail  -->
                                <div class="col-sm-12 mt-2">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Transaksi Detail</h5>
                                            <div class="card-body">
                                                <table class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>No. </th>
                                                            <th>Nama Paket</th>
                                                            <th>Harga</th>
                                                            <th>Qty</th>
                                                            <th>Sub Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $no = 1;
                                                        foreach ($rowTransDetail as $key => $value): ?>
                                                            <tr>
                                                                <td><?php echo $no++ ?></td>
                                                                <td><?php echo $value['service_name'] ?></td>
                                                                <td><?php echo "Rp" . number_format($value['harga']) ?></td>
                                                                <td><?php echo $value['qty'] ?></td>
                                                                <td><?php echo "Rp" . number_format($value['subtotal']) ?></td>
                                                            </tr>
                                                        <?php endforeach ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    <?php else: ?>

                        <div class="container-xxl flex-grow-1 container-p-y">
                            <div class="mb-3">
                                <a href="transaksi.php" class="btn btn-Danger">
                                    <i class="fas fa-arrow-left">My Laundry Website</i>
                                </a>
                            </div>
                            <form action="" method="POST">
                                <div class="card">
                                    <div class="card-header">
                                        <?php echo isset($_GET['edit']) ? 'Edit' : 'Tambah'; ?> Transaksi
                                    </div>
                                    <div class="card-body">
                                        <?php if (isset($_GET['hapus'])): ?>
                                            <div class="alert alert-success" role="alert">Data berhasil dihapus!</div>
                                        <?php endif; ?>

                                        <!-- Transaksi -->
                                        <div class="mb-3 row">
                                            <div class="col-sm-6">
                                                <label for="order_code" class="form-label">No. Invoice</label>
                                                <input type="text" class="form-control" name="order_code"
                                                    placeholder="Generated Order Code" value="#<?php echo $code ?>"
                                                    readonly>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="customer_name" class="form-label">Nama Customer</label>
                                                <select name="id_customer" class="form-control" required>
                                                    <option value="">Pilih Customer</option>
                                                    <?php while ($customer = mysqli_fetch_assoc($customerName)): ?>
                                                        <option value="<?= $customer['id'] ?>"><?= $customer['customer_name'] ?>
                                                        </option>
                                                    <?php endwhile; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <div class="col-sm-6">
                                                <label for="order_date" class="form-label">Tanggal Order</label>
                                                <input type="date" class="form-control" name="order_date" required>
                                            </div>

                                            <div class="col-sm-6">
                                                <label for="order_end_date" class="form-label">Tanggal Berakhir
                                                    Order</label>
                                                <input type="date" class="form-control" name="order_end_date" required>
                                            </div>
                                        </div>



                                        <!-- Button Tambah Paket -->
                                        <div class="mb-2">
                                            <button id="counterBtn" type="button" class="btn btn-primary btn-sm mb-2">Tambah
                                                Paket</button>
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Paket</th>
                                                        <th>Harga</th>
                                                        <th>Qty</th>
                                                        <th>Sub Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody">
                                                    <!-- Baris paket akan ditambahkan di sini -->
                                                </tbody>

                                                <tfoot>
                                                    <!-- Total Harga di atas -->
                                                    <tr>
                                                        <td colspan="4">Total</td>
                                                        <td>
                                                            <input type="number" class="total-harga form-control"
                                                                name="total_harga" id="total_harga" readonly>
                                                            <input type="hidden" name="status" value="0">
                                                        </td>
                                                    </tr>
                                                    <!-- Pembayaran -->
                                                    <tr>
                                                        <td colspan="4">Dibayar</td>
                                                        <td>
                                                            <input type="number" class="dibayar form-control"
                                                                name="order_pay" id="dibayar">
                                                        </td>
                                                    </tr>
                                                    <!-- Kembalian -->
                                                    <tr>
                                                        <td colspan="4">Kembalian</td>
                                                        <td>
                                                            <input type="number" class="kembalian form-control"
                                                                name="order_change" id="kembalian" readonly>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td colspan="4">Catatan</td>
                                                        <td>
                                                            <textarea class="form-control" name="note" id="note"
                                                                rows="3"></textarea>
                                                        </td>
                                                    </tr>
                                                </tfoot>


                                            </table>
                                        </div>

                                        <!-- Submit Button -->
                                        <div align="right" class="mb-3">
                                            <button class="mt-3 btn btn-success" name="simpan" type="submit">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>


                    <?php endif ?>



                </div>
                <!-- Footer -->
                <?php include '../layout/footer.php'; ?>

                <div class="content-backdrop fade"></div>
            </div>
        </div>
    </div>





    <!-- Core JS -->
    <?php include '../layout/js.php' ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const button = document.getElementById('counterBtn');
            const tbody = document.getElementById('tbody');
            let no = 0;

            // Pastikan rowService dari PHP sudah menjadi format JSON di sini
            const rowService = <?php echo json_encode($rowService); ?>;

            button.addEventListener('click', function() {
                no++;

                // Membuat baris baru dengan kolom untuk Nama Paket, Harga, Qty, dan Subtotal
                let newRow = document.createElement('tr');

                newRow.innerHTML = `
            <td>${no}</td>
            <td>
                <select class="form-control paket-select" name="id_service[]" required>
                    <option value="">--Pilih Paket--</option>
                    ${rowService.map(service => `
                        <option value="${service.id}" data-harga="${service.harga}">${service.service_name}</option>
                    `).join('')}
                </select>
            </td>
            <td><input type="number" name="harga[]" class="form-control harga-input" readonly></td>
            <td><input type="number" name="qty[]" class="form-control qty-input" value="1" min="1"></td>
            <td><input type="number" name="sub_total[]" class="form-control sub-total" readonly></td>
        `;

                tbody.appendChild(newRow);

                const paketSelect = newRow.querySelector(".paket-select");
                const hargaInput = newRow.querySelector(".harga-input");
                const qtyInput = newRow.querySelector(".qty-input");
                const subTotalInput = newRow.querySelector(".sub-total");

                function updateSubtotal() {
                    const harga = parseFloat(hargaInput.value) || 0;
                    const qty = parseInt(qtyInput.value) || 0;
                    const subTotal = harga * qty;
                    subTotalInput.value = Math.round(subTotal); // Bulatkan hasil subtotal
                }

                paketSelect.addEventListener('change', function() {
                    const selectedOption = paketSelect.options[paketSelect.selectedIndex];
                    const harga = selectedOption.getAttribute('data-harga');
                    hargaInput.value = harga ? harga : "";
                    updateSubtotal();
                });

                qtyInput.addEventListener('input', function() {
                    updateSubtotal();
                });
            });

            // Update total harga dan kembalian di bawah
            function updateTotalAndChange() {
                const totalHarga = Array.from(document.querySelectorAll('.sub-total'))
                    .reduce((total, subTotalInput) => total + parseFloat(subTotalInput.value) || 0, 0);

                const totalHargaInput = document.getElementById('total_harga');
                totalHargaInput.value = Math.round(totalHarga); // Bulatkan total harga

                const dibayarInput = document.getElementById('dibayar');
                const dibayar = parseFloat(dibayarInput.value) || 0;

                const kembalianInput = document.getElementById('kembalian');
                kembalianInput.value = Math.round(dibayar - totalHarga); // Bulatkan kembalian
            }

            // Event listener untuk menghitung ulang total dan kembalian ketika qty atau harga berubah
            document.getElementById('tbody').addEventListener('input', updateTotalAndChange);
            document.getElementById('dibayar').addEventListener('input', updateTotalAndChange);
        });
    </script>
</body>

</html>