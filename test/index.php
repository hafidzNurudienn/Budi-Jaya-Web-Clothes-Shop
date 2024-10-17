<?php
session_start();

include 'config/database.php';
$sql="select * from profil_aplikasi limit 1";
$hasil = mysqli_query($kon,$sql);
$row = mysqli_fetch_array($hasil)

?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo $row['nama_aplikasi'];?></title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<!--theme-style-->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />	
<!--//theme-style-->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--fonts-->
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
<!--//fonts-->
<script src="js/jquery.min.js"></script>
<link rel="stylesheet" href="css/etalage.css" type="text/css" media="all" />
<script src="js/jquery.etalage.min.js"></script>
<script>
	jQuery(document).ready(function($){

		$('#etalage').etalage({
			thumb_image_width: 300,
			thumb_image_height: 400,
			source_image_width: 900,
			source_image_height: 1200,
			show_hint: true,
			click_callback: function(image_anchor, instance_id){
				alert('Callback example:\nYou clicked on an image with the anchor: "'+image_anchor+'"\n(in Etalage instance: "'+instance_id+'")');
			}
		});

	});
</script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<!--script-->

<!-- <style type="text/css">
    .preloader {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 9999;
      background-color: #fff;
    }
    .preloader .loading {
      position: absolute;
      left: 50%;
      top: 50%;
      transform: translate(-50%,-50%);
      font: 14px arial;
    }
  </style> -->

  <script>
    $(document).ready(function(){
      $(".preloader").fadeOut();
    })
  </script>

  
</head>

	<link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    />
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="../style.css" />

<body>
	
<!-- <div class="preloader">
  <div class="loading">
    <img src="images/animasi_loading.gif">
  </div>
</div> -->

	<!--header-->
	<section id="header">
      <a href="" class="logo"><img src="../img/logo_budijaya.png" /></a>

      <div>
        <ul id="navbar">
          <li><a href="../index.php">Home</a></li>
          <li><a href="../shop.php">Katalog</a></li>
          <li class="dropdown">
            <a href="javascript:void(0)">Detail Pesanan</a>
            <i class="fa fa-caret-down"></i>
            <div class="dropdown-content">
            
            <?php if (!isset($_SESSION["id_pelanggan"])): ?>
              <a href="../status.php">Cek Status Pemesanan</a>
            <?php else: ?>
              <a href="index.php?page=pesanan-saya">Cek Status Pemesanan</a>
              <a href="../konfirmasi.php">Konfirmasi Pemesanan</a>
            <?php endif; ?>

            </div>
          </li>
          <li><a href="../contact.php">Kontak Kami</a></li>
          <li><a href="../help.php">Bantuan</a></li>
          <li id="lg-bag">
            <a href="../cart.php"><i class="fa-solid fa-cart-shopping"></i></a>
          </li>

          <?php if (!isset($_SESSION["id_pelanggan"])): ?>
            <li style="float: right">
              <a class="login-button" href="index.php?page=login">Login</a>
            </li>
          <?php else: ?>
            <li style="float: right">
              <a class="login-button" href="index.php?page=logout">Logout</a>
            </li>
          <?php endif; ?>
          
          <a href="#" id="close"><i class="fa fa-times"></i></a>
        </ul>
      </div>

      <div id="mobile">
        <a href="../cart.php"><i class="fa-solid fa-cart-shopping"></i></a>
        <i id="bar" class="fas fa-outdent"></i>
      </div>
    </section>

	<!---->
	
	<!-- start content -->
	<div class="container">
	<?php 
      if(isset($_GET['page'])){
        $page = $_GET['page'];
    
        switch ($page) {
			    case 'checkout':
				    include "pages/checkout.php";
				    break;
			    case 'pembayaran':
				    include "pages/pembayaran.php";
				    break;
			    case 'login':
				    include "pages/login.php";
				    break;
			    case 'daftar':
				    include "pages/daftar.php";
				    break;
          case 'reset':
            include "pages/reset.php";
            break;
			    case 'pesanan-saya':
				    include "pages/menu-pelanggan/pesanan-saya.php";
				    break;
			    case 'detail-pesanan':
				    include "pages/menu-pelanggan/detail-pesanan.php";
				    break;
			    case 'voucher-saya':
				    include "pages/menu-pelanggan/voucher-saya.php";
				    break;
			    case 'profil':
				    include "pages/menu-pelanggan/profil.php";
				    break;
			    case 'username-password':
				    include "pages/menu-pelanggan/username-password.php";
				    break;
			    case 'logout':
				    include "pages/logout.php";
				    break;
          default:
            echo "<center><h3>Maaf. Halaman tidak di temukan !</h3></center>";
            break;
        }
      }else {
		include "../index.php";
	}
  	?>

	<!-- <div id='ajax-wait'>
	<img src="images/animasi_loading.gif">
	</div> -->

	<!-- <script>
	$(document).ready( function () {
		loading();
	});

	//Fungsi untuk efek loading
	function loading(){
		$( document ).ajaxStart(function() {
		$( "#ajax-wait" ).css({
			left: ( $( window ).width() - 32 ) / 2 + "px", // 32 = lebar gambar
			top: ( $( window ).height() - 32 ) / 2 + "px", // 32 = tinggi gambar
			display: "block"
		})
		})
		.ajaxComplete( function() {
			$( "#ajax-wait" ).fadeOut();
		});
	}
	</script> -->

	<!-- <style>
		#ajax-wait {
		display: none;
		position: fixed;
		z-index: 1999
		}
	</style> -->

	</div>
	
	<!---->
  <section id="newsletter" class="section-p1 section-m1"></section>
	<footer class="section-p1">
      <div class="col">
        <img class="logo" src="../img/logo_budijaya.png" />
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

	<script src="../script.js"></script>
</body>
</html>