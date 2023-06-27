<?php
session_start();
include 'config.php';

if (isset($_POST['login'])) {
    $nik = $_POST['nik'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM petani 
    INNER JOIN desa
    WHERE petani.password='$password' AND petani.nik='$nik'";
    $result = mysqli_query($conn, $sql);
    // $row = mysqli_fetch_assoc($result);
    // var_dump($result);
    // die();

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['nama_full'] = $row['nama_full'];
        $_SESSION['nik'] = $row['nik'];
        $_SESSION['hp'] = $row['no_hp'];
        $_SESSION['nama_desa'] = $row['nama_desa'];
        $_SESSION['level'] = $row['level'];
        // kodeptn unuk mengelompokan data hasil panen yang si buat petani berdasarkan kode petani dalam proses_panen.php.....lupa hahaaha
        $_SESSION['kodeptn'] = $row['kd_pet'];
        $_SESSION['kd_desa'] = $row['kd_desa'];

        if ($row['level'] == 'ADMIN') {
            header("Location: index.php");
            exit();
        } elseif ($row['level'] == 'PETANI') {
            header("Location: index.php");
            exit();
        }
    } else {
        echo "<script>alert('Data Login Tidak Sesuai!')</script>";
        echo "<script>window.location.href='login.php';</script>";
        exit();
    }
} elseif (isset($_POST['change_password'])) {
    $password_lama = $_POST['password_lama'];
    $cpassword_lama = $_POST['cpassword_lama'];
    $password_baru = $_POST['password_baru'];
    $cpassword_baru = $_POST['cpassword_baru'];
    $nik = $_SESSION['nik'];

    $sql = "SELECT * FROM petani WHERE nik='$nik'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    // var_dump($row);
    // die();
    if ($password_lama == $row['password']) {
        if ($password_lama == $cpassword_lama) {
            if ($password_baru == $cpassword_baru) {
                $sql = "UPDATE petani SET password='$password_baru' WHERE nik='$nik'";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    echo "<script>alert('Berhasil Ubah Password!')</script>";
                    echo "<script>window.location.href='profile.php';</script>";
                } else {
                    echo "<script>alert('Gagal mengubah password.')</script>";
                    echo "<script>window.location.href='change_password.php';</script>";
                }
            } else {
                echo "<script>alert('Konfirmasi Password baru tidak sama!')</script>";
                echo "<script>window.location.href='change_password.php';</script>";
            }            
        } else {
            echo "<script>alert('Konfirmasi Password lama tidak sama!')</script>";
            echo "<script>window.location.href='change_password.php';</script>";
        }
    } else {
        echo "<script>alert('Password salah tidak sama!')</script>";
        echo "<script>window.location.href='change_password.php';</script>";
    }
}
?>