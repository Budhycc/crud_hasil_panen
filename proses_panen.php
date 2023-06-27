<?php
include 'config.php';

session_start();

if (!isset($_SESSION['nik'])) {
    header("Location: index.php");
    exit();
}

if (isset($_POST['kelola'])) {
    if ($_POST['kelola'] == "add") {
        $kd_hasil = $_POST['kode'];
        if ($_SESSION['level'] == "ADMIN") {
            $kd_ptn = $_POST['petani'];
            $sqlds = "SELECT * FROM petani WHERE kd_pet ='$kd_ptn'";
            $resultds = mysqli_query($conn, $sqlds);
            $rowds = mysqli_fetch_assoc($resultds);
            $kd_desa = $rowds['kd_desa'];
            // var_dump($rowds);
            // die();
        } elseif ($_SESSION['level'] == "PETANI") {
            $kd_ptn = $_SESSION['kodeptn'];
            $kd_desa= $_SESSION['kd_desa'];
        }
        $kd_kom = $_POST['komoditi'];
        $jumlah_panen = $_POST['panen'];
        $tanggal = $_POST['tanggal'];

        // $cek = mysqli_query($conn, "SELECT * FROM hasil_panen WHERE kd_hasil = '$kd_hasil'");
        // if (mysqli_num_rows($cek) > 0) {
        //     echo "<script>alert('Kode Panen tidak boleh sama!')</script>";
        //     echo "<script>window.location.href='kelola_panen.php';</script>";
        // } else {
            $sql = "INSERT INTO hasil_panen VALUES (NULL,'$kd_ptn','$kd_kom','$kd_desa','$jumlah_panen','$tanggal')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                header("Location: data_panen.php");
                exit();
            } else {
                echo "Terjadi kesalahan saat memasukkan data panen.";
            }
        // }
    } elseif ($_POST['kelola'] == "edit") {
        $id = $_POST['id'];
        $kd_hasil = $_POST['kode'];
        if ($_SESSION['level'] == "ADMIN") {
            $kd_ptn = $_POST['petani'];
            $sqlds = "SELECT * FROM petani WHERE kd_pet ='$kd_ptn";
            $resultds = mysqli_query($conn, $sqlds);
            $rowds = mysqli_fetch_assoc($resultds);
            $kd_desa = $rowds['kd_desa'];
            // var_dump($resultds);
            // die();
        } elseif ($_SESSION['level'] == "PETANI") {
            $kd_ptn = $_SESSION['kodeptn'];
            $kd_desa= $_SESSION['kd_desa'];
        }
        $kd_kom = $_POST['komoditi'];
        $jumlah_panen = $_POST['panen'];
        $tanggal = $_POST['tanggal'];

        $cek = mysqli_query($conn, "SELECT * FROM hasil_panen WHERE kd_hasil = '$kd_hasil' AND kd_hasil != '$id'");
        if (mysqli_num_rows($cek) > 0) {
            echo "<script>alert('Kode panen tidak boleh sama dengan kode panen yang sudah ada!')</script>";
            echo "<script>window.location.href='kelola_panen.php';</script>";
        } else {
            $sql = "UPDATE hasil_panen SET kd_hasil='$kd_hasil',kd_ptn='$kd_ptn',kd_kom='$kd_kom',kd_desa='$kd_desa',jumlah_panen='$jumlah_panen',tanggal='$tanggal' WHERE kd_hasil='$id';";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                header("Location: data_panen.php");
                exit();
            } else {
                echo "Terjadi kesalahan saat mengubah data panen.";
            }
        }
    }

} elseif (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];

    $sql = "DELETE FROM hasil_panen WHERE kd_hasil = '$id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: data_panen.php");
        exit();
    } else {
        echo "Terjadi kesalahan .";
    }
} else {
    echo "Terjadi kesalahan saat menghapus data panen.";
}
?>