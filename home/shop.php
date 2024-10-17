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
          <li><a class="active" href="shop.php">Katalog</a></li>
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

    <section id="page-header">
      <h2>Pesan Sekarang</h2>
      <p>Seragam SD hingga SMA dan aksesoris lainnya!</p>
    </section>

    <section id="product1" class="section-p1">
      <div class="pro-container" id="productList">
        <!-- Produk akan dimuat di sini oleh JavaScript -->
      </div>
    </section>

    <!-- <section id="pagination" class="section-p1">
      <a href="#">1</a>
      <a href="#">2</a>
      <a href="#"><i class="fal fa-long-arrow-alt-right"></i></a>
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

    <script>
      // Kode baru untuk mengambil data produk dan menambahkan ke halaman
      document.addEventListener("DOMContentLoaded", function () {
        fetch("fetch_products.php")
          .then((response) => response.json())
          .then((products) => {
            const productList = document.getElementById("productList");
            products.forEach((product) => {
              const sizes = product.ukuran.split(",");
              const prices = product.harga.split(",");
              const gambar = product.gambar.split(",");

              let sizeOptions = "";
              for (let i = 0; i < sizes.length; i++) {
                sizeOptions += `<option value="${prices[i]}">${sizes[i]} - IDR ${prices[i]}</option>`;
              }

              const productHTML = `
                          <div class="pro" onclick="window.location.href='sproduct.php?id=${product.id}'">
                              <img src="img/products/${gambar[0]}" alt="${product.nama}">
                              <div class="des">
                                  <span>${product.deskripsi}</span>
                                  <h5>${product.nama}</h5>
                                  <div class="star">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                  </div>
                                  <h4 class="productPrice">IDR ${prices[0]}</h4>
                                  </div>
                                  <a href="#"><i class="bx bx-shopping-bag cart"></i></a>
                              </div>
                          </div>
                      `;

              productList.insertAdjacentHTML("beforeend", productHTML);
            });

            const sizeSelects = document.querySelectorAll(".sizeSelect");
            sizeSelects.forEach((select) => {
              select.addEventListener("change", function () {
                const priceElement =
                  this.parentElement.querySelector(".productPrice");
                priceElement.textContent = `IDR ${this.value}`;
              });
            });
          })
          .catch((error) => console.error("Error:", error));
      });
    </script>

    <script src="script.js"></script>
  </body>
</html>
