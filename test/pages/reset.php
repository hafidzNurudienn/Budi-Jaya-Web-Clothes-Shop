<?php
if (isset($_POST['reset_password'])) {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    include 'config/database.php';

    $username = input($_POST["username"]);
    $email = input($_POST["email"]);
    $new_password = input(md5($_POST["new_password"]));

    // Cek apakah username dan email ada di database
    $cek_pelanggan = mysqli_query($kon, "SELECT * FROM pelanggan WHERE username='$username' AND email='$email' LIMIT 1");
    $pelanggan = mysqli_num_rows($cek_pelanggan);

    if ($pelanggan > 0) {
        $row = mysqli_fetch_assoc($cek_pelanggan);

        if ($row['status'] == 1) {
            // $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $update_password = mysqli_query($kon, "UPDATE pelanggan SET password='$new_password' WHERE username='$username' AND email='$email'");

            if ($update_password) {
                header("Location:index.php?page=login&aut=password_reset");
            } else {
                $reset_error = "Reset password gagal! Terjadi kesalahan saat memperbarui password.";
            }
        } else {
            $reset_error = "Mohon maaf status anda telah dinonaktifkan.";
        }
    } else {
        $reset_error = "Reset password gagal! Username atau email tidak valid.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <link rel="stylesheet" type="text/css" href="path/to/your/bootstrap.min.css">
</head>
<body>
<div class="women-product">
    <div class="w_content">
        <div class="women">
            <h3>Reset Password</h3>
            <div class="clearfix"></div>	
        </div>
    </div>
    <div class="grid-product">
        <?php
        if (isset($reset_error)) {
            echo "<div class='alert alert-danger'>$reset_error</div>";
        } elseif (isset($_GET['aut'])) {
            if ($_GET['aut'] == 'password_reset') {
                echo "<div class='alert alert-success'>Password berhasil direset! Silakan login dengan password baru.</div>";
            }
        }
        ?>
        <form method="post" action="">
            <div class="form-group">
                <label>Username:</label>
                <input type="text" name="username" class="form-control" required>  
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" class="form-control" required>  
            </div>
            <div class="form-group">
                <label>Password Baru:</label>
                <input type="password" name="new_password" class="form-control" required>  
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success" name="reset_password">Reset Password</button>
            </div>

            <p>Ingin kembali ke halaman login? <a href="index.php?page=login" >Klik disini</a> atau Mau buat akun baru? <a href="index.php?page=daftar" >Buat disini</a></p>
        </form>
        <div class="clearfix"></div>
    </div>
</div>
</body>
</html>