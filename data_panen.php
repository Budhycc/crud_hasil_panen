<?php
include 'config.php';
session_start();

if (isset($_GET['data_saya'])) {
  $search = $_GET['data_saya'];
  $sql = "SELECT * FROM hasil_panen
  INNER JOIN petani ON hasil_panen.kd_ptn = petani.kd_pet
  INNER JOIN komoditi ON hasil_panen.kd_kom = komoditi.kd_komoditi
  INNER JOIN desa ON hasil_panen.kd_desa = desa.kd_desa
  WHERE petani.kd_pet LIKE '%$search%'
  ORDER BY kd_hasil";
} elseif (isset($_GET['search'])) {
  $search = $_GET['search'];
  $sql = "SELECT * FROM hasil_panen
  INNER JOIN petani ON hasil_panen.kd_ptn = petani.kd_pet
  INNER JOIN komoditi ON hasil_panen.kd_kom = komoditi.kd_komoditi
  INNER JOIN desa ON hasil_panen.kd_desa = desa.kd_desa
  WHERE kd_hasil LIKE '%$search%' OR komoditi.nama_kom LIKE '%$search%' OR petani.nama_full LIKE '%$search%'
  ORDER BY kd_hasil";
} else {
  $sql = "SELECT * FROM hasil_panen
  INNER JOIN petani ON hasil_panen.kd_ptn = petani.kd_pet
  INNER JOIN komoditi ON hasil_panen.kd_kom = komoditi.kd_komoditi
  INNER JOIN desa ON hasil_panen.kd_desa = desa.kd_desa
  ORDER BY kd_hasil";
}
$result = mysqli_query($conn, $sql);

if (isset($_GET['cetak'])) {
  $tahun = $_GET['cetak'];
  $sqlh = "SELECT YEAR(hasil_panen.tanggal) AS tahun, hasil_panen.kd_kom, komoditi.nama_kom, SUM(hasil_panen.jumlah_panen) AS total_panen
  FROM hasil_panen
  INNER JOIN komoditi ON hasil_panen.kd_kom = komoditi.kd_komoditi
  INNER JOIN desa ON hasil_panen.kd_desa = desa.kd_desa
  WHERE YEAR(hasil_panen.tanggal) = '$tahun'
  GROUP BY YEAR(hasil_panen.tanggal), hasil_panen.kd_kom
  ORDER BY YEAR(hasil_panen.tanggal) DESC";

} else {
  $sqlh = "SELECT YEAR(hasil_panen.tanggal) AS tahun, hasil_panen.kd_kom, komoditi.nama_kom, SUM(hasil_panen.jumlah_panen) AS total_panen
  FROM hasil_panen
  INNER JOIN komoditi ON hasil_panen.kd_kom = komoditi.kd_komoditi
  INNER JOIN desa ON hasil_panen.kd_desa = desa.kd_desa
  GROUP BY YEAR(hasil_panen.tanggal), hasil_panen.kd_kom
  ORDER BY YEAR(hasil_panen.tanggal) DESC";
}
$resulth = mysqli_query($conn, $sqlh);

if (isset($_GET['desa'])) {
  if ($_GET['desa'] == 1) {
    $desa = $_GET['desa'];
    $sqlds = "SELECT YEAR(hasil_panen.tanggal) AS tahun, komoditi.kd_komoditi, komoditi.nama_kom, desa.kd_desa, desa.nama_desa, SUM(hasil_panen.jumlah_panen) AS total
    FROM hasil_panen
    INNER JOIN petani ON hasil_panen.kd_ptn = petani.kd_pet
    INNER JOIN komoditi ON hasil_panen.kd_kom = komoditi.kd_komoditi
    INNER JOIN desa ON hasil_panen.kd_desa = desa.kd_desa
    GROUP BY YEAR(hasil_panen.tanggal), komoditi.kd_komoditi, komoditi.nama_kom, desa.kd_desa, desa.nama_desa
    ORDER BY desa.kd_desa";


  } else {
    $desa = $_GET['desa'];
    $year = $_GET['thn'];
    $sqlds = "SELECT YEAR(hasil_panen.tanggal) AS tahun, komoditi.kd_komoditi, komoditi.nama_kom, desa.kd_desa, desa.nama_desa, SUM(hasil_panen.jumlah_panen) AS total
    FROM hasil_panen
    INNER JOIN petani ON hasil_panen.kd_ptn = petani.kd_pet
    INNER JOIN komoditi ON hasil_panen.kd_kom = komoditi.kd_komoditi
    INNER JOIN desa ON hasil_panen.kd_desa = desa.kd_desa
    WHERE hasil_panen.kd_desa = '$desa' AND YEAR(hasil_panen.tanggal) = '$year'
    GROUP BY YEAR(hasil_panen.tanggal), komoditi.kd_komoditi, komoditi.nama_kom, desa.kd_desa, desa.nama_desa
    ORDER BY desa.kd_desa";

  }
  $desa = $_GET['desa'];
  $sqlds2 = "SELECT * FROM hasil_panen
  INNER JOIN desa ON hasil_panen.kd_desa = desa.kd_desa";
  $resultds = mysqli_query($conn, $sqlds);
  $resultds2 = mysqli_query($conn, $sqlds2);

  $sqltitle = "SELECT * FROM hasil_panen
  INNER JOIN desa ON hasil_panen.kd_desa = desa.kd_desa
  WHERE hasil_panen.kd_desa LIKE '%$desa%'";
  $resulttitle = mysqli_query($conn, $sqltitle);
  $rowtitle = mysqli_fetch_assoc($resulttitle);
}




$id = 1;
$no = 1;
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Data Panen</title>
  <link href="css/bootstrap.min.css" rel="stylesheet" />
  <script src="js/bootstrap.bundle.min.js"></script>

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

    .b-example-divider {
      height: 3rem;
      background-color: rgba(0, 0, 0, .1);
      border: solid rgba(0, 0, 0, .15);
      border-width: 1px 0;
      box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
    }

    .b-example-vr {
      flex-shrink: 0;
      width: 1.5rem;
      height: 100vh;
    }

    .bi {
      vertical-align: -.125em;
      fill: currentColor;
    }

    .nav-scroller {
      position: relative;
      z-index: 2;
      height: 2.75rem;
      overflow-y: hidden;
      background-color: rgb(190, 177, 159);
    }

    .nav-scroller .nav {
      display: flex;
      flex-wrap: nowrap;
      padding-bottom: 1rem;
      margin-top: -1px;
      overflow-x: auto;
      text-align: center;
      white-space: nowrap;
      -webkit-overflow-scrolling: touch;
    }

    .btn-outline-secondary {
      background-color: rgb(255, 255, 255);
      color: rgb(0, 0, 0);
    }

    @media (max-width: 767px) {
      .btn-outline-secondary {
        display: none;
      }
    }

    @media print {
      body * {
        visibility: hidden;
      }

      .tbl {
        display: none;
      }

      #data,
      #data * {
        visibility: visible;
      }

      #data {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
      }
    }
  </style>

  <link href="blog.css" rel="stylesheet">
</head>

<body>

  <div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <a class="navbar-brand" href="#">
          <!-- <img src="logo.png" alt="Logo" height="30" class="d-inline-block align-top"> -->
          Selamat Datang di SI Hasil Pertanian Kecamatan Berastagi
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <?php if (isset($_SESSION['nik'])) {
          $nama_full = $_SESSION['nama_full'];
          $level = $_SESSION['level'];
          ?>

          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="data/img/icon.png" alt="Profile" height="20" class="rounded-circle me-2">
                  <?php echo $nama_full ?>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                  <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                  <li>
                    <hr class="dropdown-divider">
                  </li>
                  <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                </ul>
              </li>
            </ul>
          </div>
        <?php } else { ?>
          <a href="login.php" type="button" class="btn btn-primary">Login</a>
        <?php } ?>
      </div>
    </nav>

    <div class="nav-scroller py-1 mb-2">
      <nav class="nav d-flex justify-content-center">
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
          <a class="nav-item nav-link" id="nav-home-tab" data-toggle="tab" href="index.php" role="tab"
            aria-controls="nav-home" aria-selected="true">Home</a>
          <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="tentang_kami.php" role="tab"
            aria-controls="nav-profile" aria-selected="false">Tentang Kami</a>
          <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="data_desa.php" role="tab"
            aria-controls="nav-contact" aria-selected="false">Data Desa</a>
          <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="data_komoditi.php" role="tab"
            aria-controls="nav-contact" aria-selected="false">Data Komoditi</a>
          <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="data_petani.php" role="tab"
            aria-controls="nav-contact" aria-selected="false">Data Petani</a>
          <a class="nav-item nav-link active" id="nav-contact-tab" data-toggle="tab" href="data_panen.php" role="tab"
            aria-controls="nav-contact" aria-selected="false">Data Hasil Panen</a>
        </div>
      </nav>
    </div>
  </div>

  <main class="container">
    <article class="blog-post">
      <div class="container-fluid mt-3">
        <h2 class="lead">Data Panen</h2>


        <?php if (isset($_SESSION['nik'])) { ?>
          <a href="kelola_panen.php" type="button" class="btn btn-primary mb-3">Tambah</a>
        <?php } ?>

        <div class="row mb-3">
          <div class="col-lg-6">
            <form method="get" action="data_panen.php">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Cari berdasarkan kode, petani dan komoditi"
                  name="search">
                <button class="btn btn-outline-secondary" type="submit">Cari</button>
                <a href="data_panen.php" type="button" class="btn btn-outline-secondary">Batal</a>
              </div>
            </form>
          </div>
          <div class="col-lg-6">
            <?php if (isset($_SESSION['nik'])) { ?>
              <form method="get" action="data_panen.php">
                <input type="text" class="form-control" value="<?php echo $_SESSION['kodeptn'] ?>" readonly hidden
                  name="data_saya">
                <div class="input-group">
                  <button class="btn btn-outline-secondary mb-3" type="submit">Lihat data yang saya buat dan edit</button>
                  <a href="data_panen.php" type="button" class="btn btn-outline-secondary mb-3">Batal</a>
                </div>
              </form>
            <?php } ?>
          </div>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <td>No</td>
              <td>Kode</td>
              <td>Petani</td>
              <td>Desa</td>
              <td>Komoditi</td>
              <td>Jumlah Panen</td>
              <td>Tanggal</td>
              <td>Opsi</td>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
              <tr>
                <td>
                  <?php echo $id++; ?>.
                </td>
                <td>
                  <?php echo $row['kd_hasil']; ?>
                </td>
                <td>
                  <?php echo $row['nama_full']; ?>
                </td>
                <td>
                  <?php echo $row['nama_desa']; ?>
                </td>
                <td>
                  <?php echo $row['nama_kom']; ?>
                </td>
                <td>
                  <?php echo $row['jumlah_panen']; ?>
                </td>
                <td>
                  <?php echo $row['tanggal']; ?>
                </td>
                <td>
                  <?php if (isset($_SESSION['nik'])) { ?>
                    <?php if ($_SESSION['level'] == "ADMIN") { ?>
                      <a href="kelola_panen.php?edit=<?php echo $row['kd_hasil']; ?>" type="button"
                        class="btn btn-success btn-sm">
                        Edit
                      </a>
                      <a href="proses_panen.php?hapus=<?php echo $row['kd_hasil']; ?>" type="button"
                        class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus')">
                        Hapus
                      </a>
                    <?php } ?>

                    <?php if (isset($_GET['data_saya'])) { ?>
                      <?php if ($_SESSION['level'] == "PETANI") { ?>
                        <a href="kelola_panen.php?edit=<?php echo $row['kd_hasil']; ?>" type="button"
                          class="btn btn-success btn-sm">
                          Edit
                        </a>
                        <a href="proses_panen.php?hapus=<?php echo $row['kd_hasil']; ?>" type="button"
                          class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus')">
                          Hapus
                        </a>
                      <?php } ?>
                    <?php } else { ?>
                      <?php if ($_SESSION['level'] == "PETANI") { ?>
                        Tidak Bisa Edit (Bukan Admin)
                      <?php } ?>
                    <?php } ?>
                  <?php } else { ?>
                    Tidak Bisa Edit (Harus Login)
                  <?php } ?>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>

      <hr>

      <div id="data">
        <div class="container-fluid mt-3">
          <?php // if (!isset($_GET['desa'])) { ?>
          <h2 class="lead">Total Komoditi</h2>
          <?php // } ?>
          <?php if (!isset($_GET['desa'])) { ?>
            <div class="tbl">
              <div class="row mb-3">
                <div class="col-lg-3">
                  <form method="get" action="data_panen.php">
                    <div class="input-group">
                      <select name="cetak" required class="form-select">
                        <option value="">Tahun</option>
                        <?php $resultpn = mysqli_query($conn, $sqlh);
                        $tahun_sebelumnya = null;
                        while ($rowpn = mysqli_fetch_assoc($resultpn)) {
                          if ($rowpn['tahun'] != $tahun_sebelumnya) {
                            $tahun_sebelumnya = $rowpn['tahun']; ?>
                            <option value="<?php echo $rowpn['tahun'] ?>"> <?php echo $rowpn['tahun'] ?></option>
                          <?php }
                        } ?>
                      </select>

                      <button class="btn btn-outline-secondary" type="submit">Sortir</button>
                      <a href="data_panen.php" type="button" class="btn btn-outline-secondary">Batal</a>
                    </div>
                  </form>
                </div>
              <?php } elseif (isset($_GET['desa'])) { ?>
                <div class="tbl">
                  <div class="row mb-3">
                    <div class="col-lg-4">
                      <form method="get" action="data_panen.php">
                        <div class="input-group">
                          <select name="desa" required class="form-select">
                            <option value="">Desa</option>
                            <?php
                            $desa_sebelumnya = null;
                            while ($rowds2 = mysqli_fetch_assoc($resultds2)) {
                              if ($rowds2['kd_desa'] != $desa_sebelumnya) {
                                $desa_sebelumnya = $rowds2['kd_desa']; ?>
                                <option value="<?php echo $rowds2['kd_desa'] ?>"> <?php echo $rowds2['nama_desa'] ?></option>
                              <?php } ?>
                          <?php } ?>
                          </select>
                          <select name="thn" required class="form-select">
                        <option value="">Tahun</option>
                        <?php $resultpn = mysqli_query($conn, $sqlh);
                        $tahun_sebelumnya = null;
                        while ($rowpn = mysqli_fetch_assoc($resultpn)) {
                          if ($rowpn['tahun'] != $tahun_sebelumnya) {
                            $tahun_sebelumnya = $rowpn['tahun']; ?>
                            <option value="<?php echo $rowpn['tahun'] ?>"> <?php echo $rowpn['tahun'] ?></option>
                          <?php }
                        } ?>
                      </select>
                          <?php // var_dump($rowds2); die(); ?>
                          <button class="btn btn-outline-secondary" type="submit">Sortir</button>
                          <a href="data_panen.php?desa=1" type="button" class="btn btn-outline-secondary">Batal</a>
                        </div>
                      </form>
                    </div>
                  <?php } ?>

                  <div class="col-lg-5">
                    <div class="input-group">
                      <form method="get" action="data_panen.php">
                        <input type="text" class="form-control" readonly hidden name="desa">
                        <div class="input-group">
                          <?php if (isset($_GET['desa'])) { ?>
                            <a href="data_panen.php" class="btn btn-outline-secondary mb-3" type="button">Sortir Per
                              Tahun</a>
                          <?php } else { ?>
                            <a href="data_panen.php?desa=1" class="btn btn-outline-secondary mb-3" type="submit">Sortir
                              Per Desa</a>
                          <?php } ?>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php if (isset($_GET['cetak'])) { ?>
              <h2 class="lead">Total Komoditi Pada Tahun
                <?php echo $tahun; ?>
              </h2>
            <?php } elseif (isset($_GET['desa'])) { ?>
              <?php if ($_GET['desa'] != 1) { ?>
                <h2 class="lead">Total Komoditi Pada Desa
                <?php } else { ?>
                  <h2 class="lead">Total Komoditi Per Desa
                  <?php } ?>
                  <?php if ($_GET['desa'] != 1) {
                    echo $rowtitle['nama_desa'];
                  } ?>
                </h2>
              <?php } else { ?>
                <h2 class="lead">Total Komoditi Per Tahun </h2>
              <?php } ?>

              <?php if (isset($_GET['desa'])) { ?>
                <div class="table-responsive">

                  <table class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <?php if ($_GET['desa'] == 1) { ?>
                          <td>Desa</td>
                        <?php } ?>
                        <td>Tahun</td>
                        <td>Komoditi</td>
                        <td>Total Panen</td>
                      </tr>
                    </thead>
                    <tbody>
                      <?php while ($rowds = mysqli_fetch_assoc($resultds)) { ?>
                        <tr>
                          <?php if ($_GET['desa'] == 1) { ?>
                            <td>
                              <?php echo $rowds['nama_desa'] ?>
                            </td>
                          <?php } ?>
                          <td>
                            <?php echo $rowds['tahun'] ?>
                          </td>
                          <td>
                            <?php echo $rowds['nama_kom'] ?>
                          </td>
                          <td>
                            <?php echo $rowds['total'] ?>
                          </td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
            </div>

          <?php } else { ?>
            <div class="table-responsive">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <td>No</td>
                    <?php if (!isset($_GET['cetak'])) { ?>
                      <td>Tahun</td>
                    <?php } ?>
                    <td>Komoditi</td>
                    <td>Total Panen</td>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($rowh = mysqli_fetch_assoc($resulth)) { ?>
                    <tr>
                      <td>
                        <?php echo $no++; ?>
                      </td>
                      <?php if (!isset($_GET['cetak'])) { ?>
                        <td>
                          <?php echo $rowh['tahun'] ?>
                        </td>
                      <?php } ?>
                      <td>
                        <?php echo $rowh['nama_kom'] ?>
                      </td>
                      <td>
                        <?php echo $rowh['total_panen'] ?>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        <?php } ?>

        <button id="cetakp" type="button" class="btn btn-primary mb-3">Cetak</button>

    </article>
  </main>

  <footer class="blog-footer">
    <p>Copyright&copy;<a href="#" target="_blank">Raskita Surbakti</a>
  </footer>
  <?php if (isset($_GET['desa'])) { ?>
    <script>
      var table = document.getElementById("data");
      var cetakp = document.getElementById("cetakp");

      cetakp.addEventListener("click", function () {
        window.print();
        window.location.href = "data_panen.php?desa=1";
      });
    </script>
  <?php } else { ?>
    <script>
      var table = document.getElementById("data");
      var cetakp = document.getElementById("cetakp");

      cetakp.addEventListener("click", function () {
        window.print();
        window.location.href = "data_panen.php";
      });
    </script>
  <?php } ?>

</body>

</html>