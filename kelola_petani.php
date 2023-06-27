<?php
include 'config.php';

session_start();

if (!isset($_SESSION['nik'])) {
    header("Location: index.php");
    exit();
}

$kode = '';
$nama_full = '';
$nik = '';
$no_hp = '';
$nama_desa = '';
$level = '';

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $sql = "SELECT * FROM petani 
    INNER JOIN desa
    WHERE kd_pet = $id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

    $kode = $id;
    $nama_full = $row['nama_full'];
    $nik = $row['nik'];
    $no_hp = $row['no_hp'];
    $nama_desa = $row['nama_desa'];
    $level = $row['level'];

}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Proses</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <script src="js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container mt-5">

        <form method="POST" action="proses_petani.php">
            <input type="hidden" value="<?php echo $id; ?>" name="id" />

            <div class="mb-3 row">
                <label for="kode" class="col-sm-2 col-form-label" <?php if (!isset($_GET['edit'])) { echo "hidden"; } ?> >Kode</label>
                <div class="col-sm-10">
                    <input type="number" required id="kode" name="kode" <?php if (!isset($_GET['edit'])) { echo "hidden"; } ?> readonly value="<?php echo "$kode" ?>"
                        class="form-control">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input type="text" required id="nama" name="nama" value="<?php echo "$nama_full" ?>"
                        class="form-control">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="nik" class="col-sm-2 col-form-label">Nik</label>
                <div class="col-sm-10">
                    <input type="text" minlength="16" maxlength="16" pattern="\d{1,16}" required id="nik" name="nik"
                        value="<?php echo "$nik" ?>" class="form-control">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="hp" class="col-sm-2 col-form-label">No Hp</label>
                <div class="col-sm-10">
                    <input type="text" minlength="12" maxlength="12" pattern="\d{1,12}" required id="hp" name="hp"
                        value="<?php echo "$no_hp" ?>" class="form-control">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="desa" class="col-sm-2 col-form-label">Desa</label>
                <div class="col-sm-10">
                    <select id="desa" required name="desa" class="form-select">
                        <?php $sqlds = "SELECT * FROM desa";
                        $resultds = mysqli_query($conn, $sqlds);
                        while ($rowds = mysqli_fetch_assoc($resultds)) { ?>
                            <option value="<?php echo $rowds['kd_desa'] ?>"> <?php echo $rowds['nama_desa'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="mb-3 row">
                <div class="col-sm-10">
                    <input type="text" required id="level" name="level" readonly hidden
                        value="<?php echo "$level" ?>" class="form-control">
                </div>
            </div>

            <div class="mt-2">
                <?php if (isset($_GET['edit'])) { ?>
                    <button type="submit" name="kelola" value="edit" class="btn btn-success">
                        Ubah
                    </button>
                <?php } else { ?>
                    <button type="submit" name="kelola" value="add" class="btn btn-success">
                        Tambah
                    </button>
                <?php } ?>
                <a href="data_petani.php" type="button" class="btn btn-danger">
                    Batal
                </a>
            </div>
        </form>
    </div>

</body>

</html>