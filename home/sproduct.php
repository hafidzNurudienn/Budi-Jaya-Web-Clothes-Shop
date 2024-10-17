<?php
session_start();
// include 'config/database.php';

// // Get product ID from query parameters
// $id_produk = addslashes(trim($_GET['id']));
// $hasil = mysqli_query($kon, "SELECT * FROM produk WHERE id_produk='$id_produk' LIMIT 1");
// $cek = mysqli_num_rows($hasil);

// if ($cek <= 0) {
//     echo "<center><h3>Maaf. Produk yang dicari tidak tersedia!</h3></center>";
//     exit;
// }

// $data = mysqli_fetch_array($hasil);
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

  <!-- Product Details Section -->
  <section id="prodetails" class="section-p1">
    <div class="single_grid">
      <div class="grid images_3_of_2">
        <ul id="etalage">
          <li>
            <a href="optionallink.html">
              <img class="etalage_thumb_image" src="admin/pages/produk/gambar/<?php echo $data['gambar'];?>" class="img-responsive" />
              <img class="etalage_source_image" src="admin/pages/produk/gambar/<?php echo $data['gambar'];?>" class="img-responsive" title="" />
            </a>
          </li>
        </ul>
        <div class="clearfix"> </div>    
      </div> 
      <div class="desc1 span_3_of_2">
        <form method="post" action="add_to_cart.php">
          <h4><?php echo $data['nama_produk'];?></h4>
          <div class="cart-b">
            <div class="left-n">Rp. <?php echo number_format($data['harga'], 0, ',', '.'); ?></div>
            <input type="submit" id="masukan_keranjang" class="btn btn-danger now-get get-cart-in" value="MASUKAN KERANJANG">
            <div class="clearfix"></div>
          </div>
          <div class="alert alert-danger" id="notifikasi">Jumlah beli tidak boleh melebihi stok produk.</div>
          <div class="input-group">
            <span class="input-group-addon">Jumlah</span>
            <input type="text" name="jumlah" id="jumlah" onkeypress="return event.charCode != 32" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" placeholder="Masukan jumlah beli" required>
          </div>
          <div class="input-group">
            <input type="hidden" name="kode_produk" value="<?php echo $data['kode_produk'];?>"/>
            <input type="hidden" name="aksi" value="tambah_produk"/>
          </div>
          <br>
          <span class="badge badge-pill badge-success"><?php echo $data['stok'];?> Stok Tersedia</span>
          <input type="hidden" id="stok" value="<?php echo $data['stok'];?>"/>
          <p><br><?php echo $data['keterangan'];?></p>
        </form>
      </div>
      <div class="clearfix"> </div>
    </div>
  </section>

  <!-- Best Selling Products Section -->
  <section id="product1" class="section-p1">
    <h2>Produk Terlaris</h2>
    <p>Seragam Sekolah</p>
    <div class="pro-container" id="relatedProducts">
      <!-- Produk terkait akan dimuat di sini oleh JavaScript -->
    </div>
  </section>

  <!-- Newsletter Section -->
  <section id="newsletter" class="section-p1 section-m1">
    <div class="newstext">
      <h4>Sign Up For Newsletters</h4>
      <p>Get E-mail updates about our latest shop and <span>special offers.</span></p>
    </div>
    <div class="form">
      <input type="text" placeholder="Your email address" />
      <button class="normal">Sign Up</button>
    </div>
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
      <a href="#">Seragam SD</a>
      <a href="#">Seragam SMP</a>
      <a href="#">Seragam SMA</a>
      <a href="#">Aksesoris</a>
    </div>

    <div class="col">
      <h4>Pusat Bantuan</h4>
      <a href="#">Cara Memesan</a>
      <a href="#">Cara Bayar</a>
      <a href="#">Pengembalian Barang</a>
      <a href="#">Cek Status Pemesanan</a>
      <a href="#">Hubungi Kami</a>
    </div>

    <div class="copyright">
      <p>© 2024. Toko Seragam Budi Jaya</p>
    </div>
  </footer>

  <!-- JavaScript untuk memuat detail produk -->
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const params = new URLSearchParams(window.location.search);
      const productId = params.get('id');
    
      if (productId) {
        fetchProductDetails(productId);
        fetchRelatedProducts(productId);
      }
    });

    function fetchProductDetails(productId) {
      fetch(`fetch_product_detail.php?id=${productId}`)
        .then(response => response.json())
        .then(product => {
          const sizes = product.ukuran.split(',');
          const prices = product.harga.split(',');
          const gambar = product.gambar.split(',');
          const stock = product.stock.split(',');

          let sizeOptions = '';
          for (let i = 0; i < sizes.length; i++) {
            sizeOptions += `<option value="${prices[i]}">${sizes[i]} - IDR ${prices[i]}</option>`;
          }

          const productHTML = `
            <div class="single-pro-image">
              <img src="img/products/${gambar[0]}" width="100%" id="MainImg" alt="${product.nama}" />
              <div class="small-img-group">
                ${gambar.map(img => `<div class="small-img-col"><img src="img/products/${img}" width="100%" class="small-img" alt="${product.nama}" /></div>`).join('')}
              </div>
            </div>
            <div class="single-pro-details">
              <h6>${product.deskripsi}</h6>
              <h4>${product.nama}</h4>
              <h2 class="productPrice">IDR ${prices[0]}</h2>
              <h5>Stock : <span class="stock">${stock[0]}</span></h5>
              <select class="sizeSelect">
                <option>Pilih Ukuran</option>
                ${sizeOptions}
              </select>
              <input type="number" value="1" min="1"/>
              <button class="normal" onclick="addToCart(${product.id}, '${product.nama}', '${gambar[0]}')">Add To Cart</button>
              <h4>Detail Produk</h4>
              <span>${product.detail_produk}</span>
            </div>
          `;

          const productDetailsSection = document.getElementById('prodetails');
          productDetailsSection.innerHTML = productHTML;

          const mainImg = document.getElementById('MainImg');
          const smallImgs = document.getElementsByClassName('small-img');

          for (let i = 0; i < smallImgs.length; i++) {
            smallImgs[i].onclick = function () {
              mainImg.src = smallImgs[i].src;
            };
          }

          const sizeSelect = document.querySelector('.sizeSelect');
          const stockElement = document.querySelector('.stock');

          sizeSelect.addEventListener('change', function () {
            const selectedStock = stock[this.selectedIndex-1];
            stockElement.textContent = selectedStock;

            const priceElement = document.querySelector('.productPrice');
            priceElement.textContent = `IDR ${this.value}`;
          });
        })
        .catch(error => console.error('Error:', error));
    }

    function fetchRelatedProducts(productId) {
      fetch(`fetch_related_products.php?id=${productId}`)
        .then(response => response.json())
        .then(products => {
          const relatedProductsContainer = document.getElementById('relatedProducts');
          relatedProductsContainer.innerHTML = products.map(product => `
            <div class="pro" onclick="loadProduct(${product.id})">
              <img src="img/products/${product.gambar.split(',')[0]}" alt="${product.nama}" />
              <div class="des">
                <span>${product.nama}</span>
                <h5>${product.nama}</h5>
                <div class="star">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                </div>
                <h4>IDR ${product.harga.split(',')[0]}</h4>
              </div>
              <a href="#"><i class="bx bx-shopping-bag cart"></i></a>
            </div>
          `).join('');
        })
        .catch(error => console.error('Error:', error));
    }

    function loadProduct(productId) {
      history.pushState(null, '', `?id=${productId}`);
      fetchProductDetails(productId);
      fetchRelatedProducts(productId);
    }

    function addToCart(productId, productName, productImage) {
      const sizeSelect = document.querySelector('.sizeSelect');
      const quantityInput = document.querySelector('input[type="number"]');
      const selectedSize = sizeSelect.options[sizeSelect.selectedIndex].text.split(' - ')[0];
      const price = sizeSelect.value;
      const quantity = quantityInput.value;

      if (!selectedSize || quantity < 1) {
        alert('Tolong pilih ukuran dan jumlah pembelian yang sesuai.');
        return;
      }

      fetch('add_to_cart.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          id: productId,
          nama: productName,
          gambar: productImage,
          size: selectedSize,
          price: price,
          quantity: quantity
        })
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          alert('Produk berhasil ditambahkan ke Keranjang! Silahkan cek Keranjang anda.');
        } else {
          alert('Gagal menambahkan produk kedalam Keranjang!');
        }
      })
      .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while adding the product to the cart.');
      });
    }
  </script>
  
  <script src="script.js"></script>
</body>
</html>
