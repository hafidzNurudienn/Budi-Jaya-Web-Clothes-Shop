<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Toko Seragam Budi Jaya</title>
  
  <!-- Tambahkan Font Awesome Icon menggunakan CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <!-- Header Section -->
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
        <li><a href="help.php">Bantuan</a></li>
        <li id="lg-bag">
          <a class="active" href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a>
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
    <h2>Keranjang Belanja</h2>
    <p>Seluruh belanjaan anda. Kami simpan disini</p>
  </section>

  <section id="cart" class="section-p1">
    <table width="100%">
        <thead>
            <tr>
                <td>Remove</td>
                <td>Gambar</td>
                <td>Nama Produk</td>
                <td>Ukuran</td>
                <td>Harga</td>
                <td>Jumlah</td>
                <td>Subtotal</td>
            </tr>
        </thead>
        <tbody>
            <!-- Cart items will be dynamically loaded here -->
        </tbody>
    </table>
  </section>

  <section id="cart-add" class="section-p1">
  <form action="process_checkout.php" method="post" id="checkout-form">
      <div id="subtotal">
          <h3>Total Belanja</h3>
          <table>
              <tr>
                  <td>Total Belanja Barang</td>
                  <td id="total-belanja-barang"></td>
              </tr>
              <tr>
                  <td>Potongan Harga</td>
                  <td id="diskon">IDR 0</td>
              </tr>
              <tr>
                  <td><strong>Total</strong></td>
                  <td id="total-harga"><strong>IDR 0</strong></td>
              </tr>
          </table>
          <input type="hidden" name="cart_data" id="cart-data" value="">
          <button type="submit" name="buat_pesanan" class="normal">Checkout</button>
      </div>
  </form>
</section>

  <!-- Footer Section -->
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
document.addEventListener('DOMContentLoaded', () => {
    fetch('get_cart.php')
        .then(response => response.json())
        .then(cart => {
            const tbody = document.querySelector('tbody');
            const totalBelanjaBarang = document.getElementById('total-belanja-barang');
            const totalHarga = document.getElementById('total-harga');
            const cartDataInput = document.getElementById('cart-data');
            let subtotalSum = 0;
            let cartData = [];

            tbody.innerHTML = cart.map(item => {
                const subtotal = item.price * item.quantity;
                subtotalSum += subtotal;
                cartData.push({ kode_produk: item.id, nama: item.nama, size: item.size, price: item.price, quantity: item.quantity });

                return `
                    <tr>
                        <td><i class="fa fa-times-circle" onclick="removeFromCart(${item.id})"></i></td>
                        <td><img src="img/products/${item.gambar}" alt="${item.nama}"></td>
                        <td>${item.nama}</td>
                        <td>${item.size}</td>
                        <td>IDR ${item.price}</td>
                        <td><input type="number" value="${item.quantity}" min="1" onchange="updateCart(${item.id}, this.value)"></td>
                        <td>IDR ${subtotal}</td>
                    </tr>
                `;
            }).join('');

            totalBelanjaBarang.textContent = `IDR ${subtotalSum}`;
            totalHarga.innerHTML = `<strong>IDR ${subtotalSum}</strong>`;
            cartDataInput.value = JSON.stringify(cartData);
        });
});

function removeFromCart(productId) {
    fetch('remove_from_cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ id: productId })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // alert('Product removed from cart successfully!');
            location.reload(); // Reload the page to reflect changes
        } else {
            alert('Failed to remove product from cart.');
        }
    });
}

function updateCart(productId, quantity) {
    fetch('update_cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ id: productId, quantity: quantity })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // alert('Cart updated successfully!');
            location.reload(); // Reload the page to reflect changes
        } else {
            alert('Failed to update cart.');
        }
    });
}
</script>

  <script src="script.js"></script>
</body>
</html>