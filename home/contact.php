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
          <li><a class="active" href="contact.php">Kontak Kami</a></li>
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
      <h2>Informasi Kontak</h2>
      <p>Anda perlu bantuan? Hubungi kami!</p>
    </section>

    <section id="contact-details" class="section-p1">
      <div class="details">
        <span>Hubungi Kami</span>
        <h2>Kunjungi lokasi toko kami</h2>
        <h3>Cabang Pertama</h3>
        <div>
          <li>
            <i class="fa fa-map"></i>
            <p>
              Perum Griya Kondang Asri, Jalan Citra Kebun Mas T18, Karawang
              Timur, Kondangjaya, Kec. Karawang Tim., Karawang, Jawa Barat 41371
            </p>
          </li>
          <!-- <li>
            <i class="fa fa-envelope"></i>
            <p>-</p>
          </li> -->
          <li>
            <i class="fa fa-phone-alt"></i>
            <p>085717587800</p>
          </li>
          <li>
            <i class="fa fa-clock"></i>
            <p>08.00-21.00</p>
          </li>
        </div>
      </div>

      <div class="map">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4060611.4285221924!2d103.1250372!3d-6.3368988999999925!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6976f14ec360a7%3A0xbe75d9c15d1ec08f!2sToko%20Budhi%20Jaya!5e0!3m2!1sid!2sid!4v1720071380497!5m2!1sid!2sid"
          width="600"
          height="450"
          style="border: 0"
          allowfullscreen=""
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
        ></iframe>
      </div>
    </section>

    <section id="contact-details" class="section-p1">
      <div class="details">
        <h3>Cabang Kedua</h3>
        <div>
          <li>
            <i class="fa fa-map"></i>
            <p>
              Jl. Perum Citra Kebun Mas No.9-54, Bengle, Kec. Majalaya,
              Karawang, Jawa Barat 41371
            </p>
          </li>
          <!-- <li>
            <i class="fa fa-envelope"></i>
            <p>-</p>
          </li> -->
          <li>
            <i class="fa fa-phone-alt"></i>
            <p>081288002950</p>
          </li>
          <li>
            <i class="fa fa-clock"></i>
            <p>09.00-21.00</p>
          </li>
        </div>
      </div>

      <div class="map">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.5254182825624!2d107.34688267364442!3d-6.32588619366362!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6977e2c45094b3%3A0xe652a64478fc1ce9!2sToko%20Budhi%20Jaya%202!5e0!3m2!1sid!2sid!4v1720479105185!5m2!1sid!2sid"
          width="600"
          height="450"
          style="border: 0"
          allowfullscreen=""
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
        ></iframe>
      </div>
    </section>

    <!-- <section id="form-details">
        <form action="">
            <span>TINGGALKAN PESAN</span>
            <h2>Hubungi kami</h2>
            <input type="text" placeholder="Nama kamu">
            <input type="text" placeholder="Email">
            <input type="text" placeholder="Subject">
            <textarea name="" id="" cols="30" rows="10" placeholder="Pesan mu disini"></textarea>
            <button class="normal">Submit</button>
        </form>
    </section> -->

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
