<?php
session_start();
if (isset($_POST['tambah_produk'])) {
    //Koneksi database
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

        $produk_id=input($_POST["nama_produk"]);
        $ukuran=input($_POST["ukuran"]);
        $stok=input($_POST["stok"]);
        $harga=input($_POST["harga"]);

        $sql = "SELECT MAX(urutan) AS max_urutan FROM ukuran WHERE produk_id = $produk_id";
        $result = mysqli_query($kon, $sql);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $urutan = $row['max_urutan'] + 1;
        } else {
            $urutan = 1; // Default to 1 if no previous entries exist or if the query fails
        }

        // $kode_produk=input($_POST["kode_produk"]);
        // $kategori=input($_POST["kategori"]);
        // $sub_kategori=input($_POST["sub_kategori"]);
        // $berat=input($_POST["berat"]);
        // $keterangan=input($_POST["keterangan"]);
        // $tanggal=date("Y-m-d");
        
        // $ekstensi_diperbolehkan	= array('png','jpg','jpeg','gif');
        // $gambar = $_FILES['gambar']['name'];
        // $x = explode('.', $gambar);
        // $ekstensi = strtolower(end($x));
        // $file_tmp = $_FILES['gambar']['tmp_name'];

        //Validasi jika gambar produk tidak diinput oleh user
        if (!empty($gambar)){
            if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){

                //Mengupload gambar
                move_uploaded_file($file_tmp, 'gambar/'.$gambar);

                $sql="insert into ukuran (produk_id, ukuran, harga, urutan, stock) values
                ('$produk_id','$ukuran','$harga','$urutan','$stok')";
 
            }
        }else {
            $sql="insert into ukuran (produk_id, ukuran, harga, urutan, stock) values
            ('$produk_id','$ukuran','$harga','$urutan','$stok')";
        }

        //Mengeksekusi query 
        $simpan=mysqli_query($kon,$sql);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($simpan) {
            mysqli_query($kon,"COMMIT");
            header("Location:../../index.php?page=produk_detail&add=berhasil");
        }
        else {
            mysqli_query($kon,"ROLLBACK");
            header("Location:../../index.php?page=produk_detail&add=gagal");
        }

    }

}


    // mengambil data produk dengan kode paling besar
    include '../../../config/database.php';
    $query = mysqli_query($kon, "SELECT max(id) as kodeTerbesar FROM produk");
    $data = mysqli_fetch_array($query);
    $id_produk = $data['kodeTerbesar'];
    $id_produk++;
    $huruf = "P";
    $kodeProduk = $huruf . sprintf("%04s", $id_produk);

?>

<form action="pages/produk/tambah_detail.php" method="post" enctype="multipart/form-data">
    <input name="kode_produk" value="<?php echo $kodeProduk; ?>" type="hidden" class="form-control">
    <!-- rows -->
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Nama Produk:</label>
                <select name="nama_produk" id="nama_produk" class="form-control">
                    <!-- Menampilkan daftar kategori produk di dalam select list -->
                    <?php  
                        $sql="select * from produk";
                        $hasil=mysqli_query($kon,$sql);
                        while ($data = mysqli_fetch_array($hasil)):
                    ?>
                        <option value="<?php echo $data['id']; ?>"><?php echo $data['nama']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Ukuran:</label>
                <input name="ukuran" type="text" class="form-control" placeholder="Masukan ukuran" required>
            </div>
        </div>
    </div>

    <!-- rows -->
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Stock:</label>
                <input name="stok" type="number" class="form-control" placeholder="Masukan stok barang" required>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label>Harga:</label>
                <input name="harga" type="number" id="harga" class="form-control" placeholder="Masukan harga" required>
            </div>
            <div class="form-group">
                <label id="info_harga"> </label>
            </div>
        </div>
    </div>

    <!-- rows -->   
    <!-- <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Keterangan:</label>
                <select name="keterangan"  id="keterangan" class="form-control">
                    
                </select>
            </div>  
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Deskripsi:</label>
                <select name="desc"  id="desc" class="form-control">

                </select>
            </div>
        </div>
    </div> -->

    <button type="submit" name="tambah_produk" class="btn btn-primary">Tambah</button>
</form>

<style>
    .file {
    visibility: hidden;
    position: absolute;
    }
</style>

<script>
    $(document).on("click", "#pilih_gambar", function() {
    var file = $(this).parents().find(".file");
    file.trigger("click");
    });
    $('input[type="file"]').change(function(e) {
    var fileName = e.target.files[0].name;
    $("#file").val(fileName);

    var reader = new FileReader();
    reader.onload = function(e) {
        // get loaded data and render thumbnail.
        document.getElementById("preview").src = e.target.result;
    };
    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
    });
</script>

<script>
    $(document).ready(function(){
        var id_kategori = $("#kategori").val();

        // Menggunakan ajax untuk mengirim dan dan menerima data dari server
        $.ajax({
            type: "POST",
            dataType: "html",
            url: 'pages/produk/ambil-sub-kategori.php',
            data: "id_kategori=" + id_kategori,
            success: function(data) {
                $("#sub_kategori").html(data);
            }
        });
    });
</script>

<script>
    $("#kategori").change(function() {
        // Mengambil id kategori dari select boz kategori
        var id_kategori = $("#kategori").val();

        // Menggunakan ajax untuk mengirim dan dan menerima data dari server
        $.ajax({
            type: "POST",
            dataType: "html",
            url: 'pages/produk/ambil-sub-kategori.php',
            data: "id_kategori=" + id_kategori,
            success: function(data) {
                $("#sub_kategori").html(data);
            }
        });
    });
</script>

<script>
    function format_rupiah(nominal){
        var  reverse = nominal.toString().split('').reverse().join(''),
            ribuan = reverse.match(/\d{1,3}/g);
         return ribuan	= ribuan.join('.').split('').reverse().join('');
    }

    $('#harga').bind('keyup', function () {
        var harga=$("#harga").val();
        $("#info_harga").text('Rp. '+format_rupiah(harga));   
    }); 
</script>

<script>
$(document).ready(function(){
    $('#nama_produk').change(function(){
        var id_produk = $(this).val();
        $.ajax({
            type: "POST",
            url: 'get_product_info.php',
            data: {id: id_produk},
            dataType: 'json',
            success: function(response){
                console.log(response);  // Tambahkan log ini untuk melihat respon
                if (response.error) {
                    alert(response.error);
                } else {
                    $('#keterangan').html('<option value="'+response.id+'">'+response.keterangan+'</option>');
                    $('#desc').html('<option value="'+response.id+'">'+response.deskripsi+'</option>');
                }
            },
            error: function(xhr, status, error) {
                console.log("Error: " + error);
            }
        });
    });

    var id = $("#nama_produk").val();
    if (id) {
        $.ajax({
            type: "POST",
            url: 'get_product_info.php',
            data: {id: id},
            dataType: 'json',
            success: function(response){
                console.log(response);  // Tambahkan log ini untuk melihat respon
                if (response.error) {
                    alert(response.error);
                } else {
                    $('#keterangan').html('<option value="'+response.id+'">'+response.keterangan+'</option>');
                    $('#desc').html('<option value="'+response.id+'">'+response.deskripsi+'</option>');
                }
            },
            error: function(xhr, status, error) {
                console.log("Error: " + error);
            }
        });
    }
});
</script>