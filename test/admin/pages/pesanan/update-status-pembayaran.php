<?php
    if (isset($_POST['status_pembayaran'])) {
        
        //Include file koneksi, untuk koneksikan ke database
        include '../../../config/database.php';
        
        //Fungsi untuk mencegah inputan karakter yang tidak sesuai
        function input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        //Cek apakah ada kiriman form dari method post
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //Memulai transaksi
            mysqli_query($kon,"START TRANSACTION");

            $nomor_pesanan=input($_POST["nomor_pesanan"]);
            $status_pembayaran=input($_POST["status_pembayaran"]);

     
            $query = mysqli_query($kon,"select status_pembayaran from pesanan where nomor_pesanan='$nomor_pesanan'");
            $data = mysqli_fetch_array($query);
            $status_pembayaran_sebelumnya=$data['status_pembayaran'];

            $update=mysqli_query($kon,"update pesanan set status_pembayaran='$status_pembayaran' where nomor_pesanan='$nomor_pesanan'");

            if ($status_pembayaran_sebelumnya!=$status_pembayaran){

        
                //Jika pesanan sudah dibayar maka stok produk akan dikurangi berdasarkan jumlah beli
                if ($status_pembayaran==1){

                    $query = mysqli_query($kon,"SELECT * FROM pesanan_detail d INNER JOIN ukuran u ON u.produk_id=d.kode_produk AND u.ukuran=d.size WHERE d.nomor_pesanan='$nomor_pesanan'");
                    while ($data = mysqli_fetch_array($query)):
                        $kode_produk=$data['kode_produk'];
                        $stok=$data['stock']-$data['qty'];
                        $ukuran=$data['size'];

                        $update_stok=mysqli_query($kon,"update ukuran set stock=$stok where produk_id='$kode_produk' and ukuran='$ukuran'");
                    endwhile;

                //Jika status pembayaran diganti menjadi belum bayar maka stok produk akan dikembalikan
                }else if ($status_pembayaran==0){

                    $query = mysqli_query($kon,"SELECT * FROM pesanan_detail d INNER JOIN ukuran u ON u.produk_id=d.kode_produk AND u.ukuran=d.size WHERE d.nomor_pesanan='$nomor_pesanan'");
                    while ($data = mysqli_fetch_array($query)):
                        $kode_produk=$data['kode_produk'];
                        $stok=$data['stock']+$data['qty'];
                        $ukuran=$data['size'];

                        $update_stok=mysqli_query($kon,"update ukuran set stock=$stok where produk_id='$kode_produk' and ukuran='$ukuran'");
                    endwhile;
                }

            }

            //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
            if ($update) {
                mysqli_query($kon,"COMMIT");
                header("Location:../../index.php?page=detail-pesanan&nomor_pesanan=$nomor_pesanan");
            }
            else {
                mysqli_query($kon,"ROLLBACK");
                header("Location:../../index.php?page=detail-pesanan&nomor_pesanan=$nomor_pesanan");
            }
        }
    }
?>
