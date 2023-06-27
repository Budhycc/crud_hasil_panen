<?php
include 'config.php';

session_start();

if (!isset($_SESSION['nik'])) {
    header("Location: index.php");
    exit();
}

if (isset($_POST['kelola'])) {
    if ($_POST['kelola'] == "add") {
        $kd_pet = $_POST['kode'];
        $nama_pet = $_POST['nama'];
        $nik = $_POST['nik'];
        $hp = $_POST['hp'];
        $desa = $_POST['desa'];
        $level = "PETANI";

        $cek = mysqli_query($conn, "SELECT * FROM petani WHERE nik = '$nik'");
        if (mysqli_num_rows($cek) > 0) {
            echo "<script>alert('Nik Petani tidak boleh sama dengan Nik petani yang sudah ada!')</script>";
            echo "<script>window.location.href='data_petani.php';</script>";
        } else {
        $sql = "INSERT INTO petani VALUES (NULL,'$nik','$nama_pet','$nik','$hp','$desa','$level')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            header("Location: data_petani.php");
            exit();
        } else {
            echo "Terjadi kesalahan saat memasukkan data petani.";
        }
    }
    } elseif ($_POST['kelola'] == "edit") {
        $id = $_POST['id'];
        $kd_pet = $_POST['kode'];
        $nama_pet = $_POST['nama'];
        $nik = $_POST['nik'];
        $hp = $_POST['hp'];
        $desa = $_POST['desa'];
        $level = $_POST['level'];

        $sqlid = "SELECT * FROM petani 
        INNER JOIN desa
        WHERE kd_pet = $id";
        $resultid = mysqli_query($conn, $sqlid);
        $rowid = mysqli_fetch_array($resultid);
        $rowid = $rowid['nik'];

        $cek = mysqli_query($conn, "SELECT * FROM petani WHERE nik = '$nik' AND nik != '$rowid'");
        if (mysqli_num_rows($cek) > 0) {
            echo "<script>alert('Nik Petani tidak boleh sama dengan Nik petani yang sudah ada!')</script>";
            echo "<script>window.location.href='data_petani.php';</script>";
        } else {
            $sql = "UPDATE petani SET kd_pet='$kd_pet',nama_full='$nama_pet',nik='$nik',no_hp='$hp',kd_desa='$desa',level='$level' WHERE kd_pet='$id';";
            $result = mysqli_query($conn, $sql);

            $sqlpn = "UPDATE hasil_panen SET kd_desa='$desa' WHERE kd_ptn='$id';";
            $resultpn = mysqli_query($conn, $sqlpn);

            if ($result) {
                header("Location: data_petani.php");
                exit();
            } else {
                echo "Terjadi kesalahan saat mengubah data petani.";
            }
        }
    }
} elseif (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];

    $sql = "DELETE FROM petani WHERE kd_pet = '$id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: data_petani.php");
        exit();
    } else {
        echo "Terjadi kesalahan .";
    }
} else {
    echo "Terjadi kesalahan saat menghapus data petani.";
}
?>