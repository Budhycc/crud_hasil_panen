<?php
include 'config.php';

session_start();

if (!isset($_SESSION['nik'])) {
  header("Location: index.php");
  exit();
}

$nama_full = $_SESSION['nama_full'];
$nik = $_SESSION['nik'];
$no_hp = $_SESSION['hp'];
$kd_desa = $_SESSION['nama_desa'];
$level = $_SESSION['level'];
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Profile</title>
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
          Selamat Datang di SI Hasil Pertanian Kecamatan Berastagi
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

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
          <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="data_panen.php" role="tab"
            aria-controls="nav-contact" aria-selected="false">Data Hasil Panen</a>
        </div>
      </nav>
    </div>

  </div>

  <main class="container d-flex justify-content-center align-items-center">
    <article class="blog-post">
      <h2>Profile</h2>
      <a href="change_password.php" type="button" class="btn btn-primary mb-3">Ubah Password</a>
      <div class="card">
        <div class="card-body">
          <div class="form-group">
            <label for="nama">Nama:</label>
            <input type="text" class="form-control" id="nama" value="<?php echo $nama_full; ?>" readonly>
          </div>
          <div class="form-group">
            <label for="nik">Nik:</label>
            <input type="text" class="form-control" id="nik" value="<?php echo $nik; ?>" readonly>
          </div>
          <div class="form-group">
            <label for="hp">No Hp:</label>
            <input type="text" class="form-control" id="hp" value="<?php echo $no_hp; ?>" readonly>
          </div>
          <div class="form-group">
            <label for="alamat">Desa:</label>
            <input type="text" class="form-control" id="alamat" value="<?php echo $kd_desa; ?>" readonly>
          </div>
          <div class="form-group">
            <label for="level">Sebagai:</label>
            <input type="text" class="form-control" id="level" value="<?php echo $level; ?>" readonly>
          </div>
        </div>
      </div>
    </article>
  </main>

  <footer class="blog-footer">
    <p>Copyright&copy;
      <a href="#" target="_blank">Raskita Surbakti</a>
    </p>
  </footer>
</body>

</html>