<?php
include 'config.php';

session_start();

if (!isset($_SESSION['nik'])) {
    header("Location: index.php");
    exit();
}

if (isset($_POST['kelola'])) {
    if ($_POST['kelola'] == "add") {
        $kd_komoditi = $_POST['kode'];
        $nama_kom = $_POST['komoditi'];
        $ket = $_POST['ket'];

        // $cek = mysqli_query($conn, "SELECT * FROM komoditi WHERE kd_komoditi = '$kd_komoditi'");
        // if (mysqli_num_rows($cek) > 0) {
        //     echo "<script>alert('Kode Komoditi tidak boleh sama!')</script>";
        //     echo "<script>window.location.href='kelola_komoditi.php';</script>";
        // } else {
            $sql = "INSERT INTO komoditi VALUES (NULL,'$nama_kom','$ket')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                header("Location: data_komoditi.php");
                exit();
            } else {
                echo "Terjadi kesalahan saat memasukkan data komoditi.";
            }
        // }
    } elseif ($_POST['kelola'] == "edit") {
        $id = $_POST['id'];
        $kd_komoditi = $_POST['kode'];
        $nama_kom = $_POST['komoditi'];
        $ket = $_POST['ket'];

        $cek = mysqli_query($conn, "SELECT * FROM komoditi WHERE kd_komoditi = '$kd_komoditi' AND kd_komoditi != '$id'");
        if (mysqli_num_rows($cek) > 0) {
            echo "<script>alert('Kode Komoditi tidak boleh sama dengan kode Komoditi yang sudah ada!')</script>";
            echo "<script>window.location.href='kelola_komoditi.php';</script>";
        } else {
            $sql = "UPDATE komoditi SET kd_komoditi='$kd_komoditi',nama_kom='$nama_kom',ket='$ket' WHERE kd_komoditi='$id';";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                header("Location: data_komoditi.php");
                exit();
            } else {
                echo "Terjadi kesalahan saat mengubah data komoditi.";
            }
        }
    }
} elseif (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];

    $sql = "DELETE FROM komoditi WHERE kd_komoditi = '$id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: data_komoditi.php");
        exit();
    } else {
        echo "Terjadi kesalahan.";
    }
} else {
    echo "Terjadi kesalahan saat menghapus data komoditi.";
}
?>