# MyKompetensi_website
# MyLaundry3_website
Langkah install 
 - Hidupkan XAMPP
 - Buat databse baru dengan nama [ mylaundry ]
 - import databse mylaundry 
 - Masuk dengan email dan password

 --- Admin ---
 - email : admin@gmail.com
 - password : 123 

 --- Operator ---
 - email : operator@gmail.com
 - password : 1234

 --- Pimpinan ---
 - email : pimpinan@gmail.com
 - password : 123

Sistem Informasi Laundry ini dirancang untuk memudahkan pengelolaan transaksi dan operasional laundry. Berikut adalah fitur-fitur yang terdapat dalam sistem serta alur proses penggunaannya.

1. Pengguna Sistem
   Administrator / Super Admin

Mengelola master data seperti Customer, User, dan Jenis Service.
Menambahkan user baru dengan level user/operator.
Operator

Melakukan transaksi laundry.
Mengelola transaksi pengambilan pakaian yang sudah selesai dilaundry.
Pimpinan

Melihat stok barang.
Melihat laporan penjualan.

2. Alur Proses Sistem Laundry
   Kedatangan Customer

Customer datang ke lokasi laundry untuk melakukan transaksi.
Input Data Customer

Operator atau Admin akan menginput data Customer baru jika data Customer belum terdaftar dalam sistem.
Pembuatan Transaksi Laundry

Jika Customer sudah terdaftar, Operator atau Admin akan langsung membuat transaksi laundry.
Pemilihan Jenis Layanan

Operator memilih jenis layanan laundry yang diinginkan oleh Customer, dengan pilihan harga sebagai berikut:
Cuci dan Gosok: Rp. 5.000 per kg
Hanya Cuci: Rp. 4.500 per kg
Hanya Gosok: Rp. 5.000 per kg
Laundry Besar (Selimut, Karpet, Mantel, Sprei, dll.): Rp. 7.000 per kg
Perhitungan Subtotal

Sistem secara otomatis menghitung subtotal transaksi berdasarkan harga dan jumlah barang (qty).
Status Transaksi

Setelah transaksi selesai, status transaksi menjadi "baru" dengan kode 0.
Pengambilan Pakaian

Ketika Customer datang untuk mengambil pakaian yang telah selesai dilaundry, status transaksi akan berubah menjadi "sudah diambil" dengan kode 1.
Kesimpulan
Sistem ini dirancang untuk mendukung operasional laundry secara efektif dan efisien, dari input data customer hingga proses transaksi dan laporan. Dengan adanya fitur yang lengkap dan alur kerja yang jelas, diharapkan dapat meningkatkan produktivitas dan memberikan kemudahan bagi semua pihak yang terlibat dalam proses layanan laundry.
