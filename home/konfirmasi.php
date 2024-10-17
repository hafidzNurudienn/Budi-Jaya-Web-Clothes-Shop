<?php
session_start();
?>

<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kode_transaksi = $_POST['kode_transaksi'];
    header('Location: test/index.php?page=detail-pesanan&nomor_pesanan=' . urlencode($kode_transaksi));
    exit();
  }
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
              <a class="active" href="konfirmasi.php">Konfirmasi Pemesanan</a>
            <?php endif; ?>
            </div>
          </li>
          <li><a href="contact.php">Kontak Kami</a></li>
          <li><a href="help.php">Bantuan</a></li>
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
      <h2>Konfirmasi Pembayaranmu!</h2>
      <p>Dengan Mengisi Formulir Dibawah</p>
    </section>

    <section id="contact-details" class="section-p1">
      <div class="kontainer2">
        <h2>Konfirmasi Pembayaran</h2>
        <form method="post">
          <label style="margin-top:20px;" for="kode_transaksi">Kode Transaksi</label>
          <input type="text" id="kode_transaksi" name="kode_transaksi" required/>
   
        <!-- <p>
            Pembayaran telah dilakukan dengan transfer ke rekening Bank berikut
            ini:<br />(pilih ke rekening mana anda telah melakukan transfer?)
          </p>
          <div class="radio-group">
            <label>
              <input type="radio" name="bank" value="BCA" /> BCA - 176.141.3631
            </label>
            <label>
              <input type="radio" name="bank" value="BNI" /> BNI - 031.7033.845
            </label>
          </div> -->

          <!-- <p>
            Silahkan masukkan kode verifikasi (angka) yang tertera di bawah ini:
          </p>
          <div class="captcha-group">
            <img src="captcha_image_url_here" alt="CAPTCHA" />
            <a href="#">Klik di sini jika angka tidak terbaca</a>
          </div>

          <label for="captcha">Captcha</label>
          <input type="text" id="captcha" name="captcha" required/> -->

          <input type="submit" value="Konfirmasi Pembayaran" />
        </form>
      </div>
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
        <a href="shop.php">Seragam SD</a>
        <a href="shop.php">Seragam SMP</a>
        <a href="shop.php">Seragam SMA</a>
        <a href="shop.php">Aksesoris</a>
      </div>

      <div class="col">
        <h4>Pusat Bantuan</h4>
        <a href="help.php">Cara Memesan</a>
        <a href="help.php">Cara Bayar</a>
        <a href="help.php">Pengembalian Barang</a>
        <a href="help.php">Cek Status Pemesanan</a>
        <a href="help.php">Hubungi Kami</a>
      </div>

      <div class="copyright">
        <p>© 2024. Toko Seragam Budi Jaya</p>
      </div>
    </footer>

    <script src="script.js"></script>
  </body>
</html>
