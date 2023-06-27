<?php
include 'config.php';
session_start();

if (isset($_GET['search'])) {
  $search = $_GET['search'];
  $sql = "SELECT * FROM komoditi WHERE kd_komoditi LIKE '%$search%' OR  nama_kom LIKE '%$search%'";
} else {
  $sql = "SELECT * FROM komoditi";
}
$result = mysqli_query($conn, $sql);

$id = 1;


?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Data Komoditi</title>
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
          <a class="nav-item nav-link active" id="nav-contact-tab" data-toggle="tab" href="data_komoditi.php" role="tab"
            aria-controls="nav-contact" aria-selected="false">Data Komoditi</a>
          <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="data_petani.php" role="tab"
            aria-controls="nav-contact" aria-selected="false">Data Petani</a>
          <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="data_panen.php" role="tab"
            aria-controls="nav-contact" aria-selected="false">Data Hasil Panen</a>
        </div>
      </nav>
      </nav>
    </div>
  </div>

  <main class="container">
    <article class="blog-post">
      <div class="container-fluid mt-3">
        <h2 class="lead">Data Komoditi</h2>



        <?php if (isset($_SESSION['nik'])) { ?>
          <?php if ($_SESSION['level'] == "ADMIN") { ?>
            <a href="kelola_komoditi.php" type="button" class="btn btn-primary mb-3">Tambah</a>
          <?php } ?>
        <?php } ?>

        <div class="row mb-3">
          <div class="col-lg-6">
            <form method="get" action="data_komoditi.php">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Cari berdasarkan kode dan komoditi"
                  name="search">
                <button class="btn btn-outline-secondary" type="submit">Cari</button>
                <a href="data_komoditi.php" type="button" class="btn btn-outline-secondary">Batal</a>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="table-responsive">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <td>No</td>
              <td>Kode</td>
              <td>Komoditi</td>
              <td>Keterangan</td>
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
                  <?php echo $row['kd_komoditi']; ?>
                </td>
                <td>
                  <?php echo $row['nama_kom']; ?>
                </td>
                <td>
                  <?php echo $row['ket']; ?>
                </td>
                <td>
                  <?php if (isset($_SESSION['nik'])) { ?>
                    <?php if ($_SESSION['level'] == "ADMIN") { ?>
                      <a href="kelola_komoditi.php?edit=<?php echo $row['kd_komoditi']; ?>" type="button"
                        class="btn btn-success btn-sm">
                        Edit
                      </a>
                      <a href="proses_komoditi.php?hapus=<?php echo $row['kd_komoditi']; ?>" type="button"
                        class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus')">
                        Hapus
                      </a>
                    <?php } else { ?>
                      Tidak Bisa Edit (Bukan Admin)
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
    </article>
  </main>

  <footer class="blog-footer">
    <p>Copyright&copy;<a href="#" target="_blank">Raskita Surbakti</a>
  </footer>
</body>

</html>