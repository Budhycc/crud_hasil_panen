<?php
include 'config.php';

session_start();

if (!isset($_SESSION['nik'])) {
    header("Location: index.php");
    exit();
}

if (isset($_POST['kelola'])) {
    if ($_POST['kelola'] == "add") {
        $kd_desa = $_POST['kode'];
        $nama_desa = $_POST['desa'];

        // $cek = mysqli_query($conn, "SELECT * FROM desa WHERE kd_desa = '$kd_desa'");
        // if (mysqli_num_rows($cek) > 0) {
        //     echo "<script>alert('Kode Desa tidak boleh sama!')</script>";
        //     echo "<script>window.location.href='kelola_desa.php';</script>";
        // } else {
            $sql = "INSERT INTO desa VALUES (NULL,'$nama_desa')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                header("Location: data_desa.php");
                exit();
            } else {
                echo "Terjadi kesalahan saat memasukkan data desa.";
            }
        // }
    } elseif ($_POST['kelola'] == "edit") {
        $id = $_POST['id'];
        $kd_desa = $_POST['kode'];
        $nama_desa = $_POST['desa'];

        $cek = mysqli_query($conn, "SELECT * FROM desa WHERE kd_desa = '$kd_desa' AND kd_desa != '$id'");
        if (mysqli_num_rows($cek) > 0) {
            echo "<script>alert('Kode Desa tidak boleh sama dengan kode Desa yang sudah ada!')</script>";
            echo "<script>window.location.href='kelola_desa.php';</script>";
        } else {
            $sql = "UPDATE desa SET kd_desa='$kd_desa',nama_desa='$nama_desa' WHERE kd_desa='$id';";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                header("Location: data_desa.php");
                exit();
            } else {
                echo "Terjadi kesalahan saat mengubah data desa.";
            }
        }
    }

} elseif (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];

    $sql = "DELETE FROM desa WHERE kd_desa = '$id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: data_desa.php");
        exit();
    } else {
        echo "Terjadi kesalahan.";
    }
} else {
    echo "Terjadi kesalahan saat menghapus data desa.";
}
?>