<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Toko Seragam Budi Jaya</title>

    <!--Tambahkan Font Awesome Icon menggunakan CDN-->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    />
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="style.css" />

    <link rel="stylesheet" href="style1.css">
    
  </head>

  <body>
    <section id="header">
      <a href="" class="logo"><img src="img/logo_budijaya.png" /></a>

      <div>
        <ul id="navbar">
          <li><a href="index.php">Home</a></li>
          <li><a href="shop.php">Katalog</a></li>
          <li class="dropdown">
            <a href="javascript:void(0)">Detail Pesanan</a>
            <i class="fa fa-caret-down"></i>
            
            <div class="dropdown-content">
              <?php if (!isset($_SESSION["id_pelanggan"])): ?>
                <a href="status.php">Cek Status Pemesanan</a>
              <?php else: ?>
                <a href="test/index.php?page=pesanan-saya">Cek Status Pemesanan</a>
                <a href="konfirmasi.php">Konfirmasi Pemesanan</a>
              <?php endif; ?>
            </div>

          </li>
          <li><a href="contact.php">Kontak Kami</a></li>
          <li><a class="active" href="help.php">Bantuan</a></li>
          <li id="lg-bag">
            <a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a>
          </li>
          <?php if (!isset($_SESSION["id_pelanggan"])): ?>
            <li style="float: right">
              <a class="login-button" href="test/index.php?page=login">Login</a>
            </li>
          <?php else: ?>
            <li style="float: right">
              <a class="login-button" href="test/index.php?page=logout">Logout</a>
            </li>
          <?php endif; ?>
          <a href="#" id="close"><i class="fa fa-times"></i></a>
        </ul>
      </div>
      
      <div id="mobile">
        <a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a>
        <i id="bar" class="fas fa-outdent"></i>
      </div>
    </section>

    <section id="page-header" class="about-header">
      <h2>Hai! Apa yang bisa kami bantu?</h2>
    </section>


  <section class="cont">

    <div class="container">
      <div class="img">
        <img src="./images/illustration-woman-online-desktop.svg" alt="" />
      </div>

      <div class="questions">
        <h1>FAQ(Frequently Asked Questions)</h1>
        <div>
          <h3 class="question">
            Bagaimana cara login akun ke website?
            <img src="./images/icon-arrow-down.svg" alt="" />
          </h3>
          <p class="answer">
            login dengan memasukkan username dan password,
            kemudian lanjut pilih login agar sistem dapat beralih ke tampilan awal user
          </p>
        </div>
        <hr />
        <div>
          <h3 class="question">
            Bagaimana cara reset password?
            <img src="./images/icon-arrow-down.svg" alt="" />
          </h3>
          <p class="answer">
            Klik “Lupa password” di halaman login, lalu akan tampil halaman untuk memasukan email, masukkan
            email!.
            lalu akan di arahkan ke halaman verifikasi email masukkan kode verifikasi yang dikirimkan ke email,
            klik ok!.
            maka link reset password akan di kirmkan ke email.
          </p>
        </div>
        <hr />
        <div>
          <h3 class="question">
            Bagaimana cara memesan seragam?
            <img src="./images/icon-arrow-down.svg" alt="" />
          </h3>
          <p class="answer">
            Pada menu tampilan awal, user dapat memilih menu Katalog untuk melihat produk apa sajayang ingin
            dibeli,
            setelah itu user dapat memilih ukuran produk yang ada pada informasi yang ditampilkan sistem,
            kemudian user dapat menambahkannya kedalam keranjang belanja setelahnya sistem akan menampilkan
            detail produk
            sesuai pesanan user jika pesanan sudah benar maka user dapat mensubmit pesanan lalu melakukan
            konfirmasi
            pesanan untuk memastikan pesanan sudah sesuai, pada proses pembayaran user dapat memilih metode
            pembayaran kemudian konfirmasi pembayaran untuk menyelesaikan proses pesanan.
          </p>
        </div>
        <hr />
        <div>
          <h3 class="question">
            Bagaimana cara konfirmasi pembayaran?
            <img src="./images/icon-arrow-down.svg" alt="" />
          </h3>
          <p class="answer">
            Setelah melakukan pesanan barang usr akan di arahkan ke halaman konfir masi pembayaran/user bisa
            klik menu navigasi bar "Pemesanan" lalu user bisa memilih dua menu yaitu konfirmasi pembayaran dan
            cek status order, pilih konfirmasi pembayaran. Di halaman konfirmasi pembayaran user perlu mengirim
            bukti pembayaran dan memasukkan kode transaksi untuk mengonfirmasi pesananan, jika user belom
            mengkonfirmasi pesanan.
          </p>
        </div>
        <hr />
        <div>
          <h3 class="question">
            Bagaimana cara cek status order?
            <img src="./images/icon-arrow-down.svg" alt="" />
          </h3>
          <p class="answer">
            setelah mengkonfirmasi pembayaran akan diteruskan pada menu cek status order/user bisa memilih 
            menu navigasi bar "Pemesanan" lalu memilih menu cek status order, untuk mengecek status order, 
            setelah user memasukkan kode transaksi maka status order akan terlihat pada laman website.
          </p>
        </div>
      </div>
    </div>

    <hr>

    <div id="ukuran">
      &nbsp
      <h3>Ukuran Baju</h3>
      &nbsp
      <p><strong>Bagaimana caranya mengetahui ukuran seragam yang cocok?</strong></p>
      <p>Untuk ukuran baju bisa dilihat pada chart dibawah : </p>
      &nbsp
      <img style="max-width: 500px; max-height:500px; position:center; " src="img/ukuran1.jpg" alt="gambar ukuran">
      &nbsp 
    </div>

    <hr>

  </section>

    <section id="newsletter" class="section-p1 section-m1">
      <div class="newstext"></div>
      <div class="form"></div>
    </section>

    <footer class="section-p1">
      <div class="col">
        <img class="logo" src="img/logo_budijaya.png" />
        <p>
          <strong>Toko Seragam Budi Jaya menjual berbagai jenis</strong>
        </p>
        <p>
          <strong>seragam sekolah dari SD hingga SMA, aksesoris</strong>
        </p>
        <p>
          <strong> seragam sekolah, dan keperluan sekolah lainnya. </strong>
        </p>
        <p></p>
        <p></p>
        <p>
          <strong>Jam Operasional: </strong>Setiap Hari: 08:00 - 21:00, Kecuali
          Tanggal Merah
        </p>
      </div>

      <div class="col">
        <h4>Pemesanan</h4>
        <a href="#">Seragam SD</a>
        <a href="#">Seragam SMP</a>
        <a href="#">Seragam SMA</a>
        <a href="#">Aksesoris</a>
      </div>

      <div class="col">
        <h4>Pusat Bantuan</h4>
        <a href="#">Cara Memesan</a>
        <a href="#">Pengembalian</a>
        <a href="#">Status Pemesanan</a>
        <a href="#">Pembayaran</a>
        <a href="#">Hubungi Kami</a>
      </div>

      <div class="copyright">
        <p>© 2024. Toko Seragam Budi Jaya</p>
      </div>
    </footer>

    <script src="script.js"></script>
    <script src="index1.js"></script>
  </body>
</html>
