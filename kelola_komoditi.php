<?php
include 'config.php';

session_start();

if (!isset($_SESSION['nik'])) {
    header("Location: index.php");
    exit();
}

$kd_komoditi = '';
$nama_kom = '';
$ket = '';

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $sql = "SELECT * FROM komoditi WHERE kd_komoditi = $id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

    $kd_komoditi = $row['kd_komoditi'];
    $nama_kom = $row['nama_kom'];
    $ket = $row['ket'];
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>proses</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <script src="js/bootstrap.bundle.min.js"></script>
</head>

<body>
  <div class="container mt-5">
      <form method="POST" action="proses_komoditi.php">
          <input type="hidden" value="<?php echo $id; ?>" name="id" />

          <div class="mb-3 row">
              <label for="kode" class="col-sm-2 col-form-label" <?php if (!isset($_GET['edit'])) { echo "hidden"; } ?> >Kode</label>
              <div class="col-sm-10">
                  <input type="number" required id="kode" name="kode" <?php if (!isset($_GET['edit'])) { echo "hidden"; } ?> readonly value="<?php echo "$kd_komoditi" ?>"
                      class="form-control">
              </div>
          </div>

          <div class="mb-3 row">
              <label for="komoditi" class="col-sm-2 col-form-label">Nama Komoditi</label>
              <div class="col-sm-10">
                  <input type="text" required id="komoditi" name="komoditi" value="<?php echo "$nama_kom" ?>"
                      class="form-control">
              </div>
          </div>

          <div class="mb-3 row">
              <label for="ket" class="col-sm-2 col-form-label">Keterangan</label>
              <div class="col-sm-10">
                  <input type="text" id="ket" name="ket" value="<?php echo "$ket" ?>"
                      class="form-control">
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
              <a href="data_komoditi.php" type="button" class="btn btn-danger">
                  Batal
              </a>
          </div>
      </form>
  </div>

</body>