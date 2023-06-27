<?php
include 'config.php';
session_start();

// if (!isset($_SESSION['username'])) {
//     header("Location: index.php");
//     exit();
// }



?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
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
                                <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
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
                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="index.php" role="tab"
                        aria-controls="nav-home" aria-selected="true">Home</a>
                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="tentang_kami.php"
                        role="tab" aria-controls="nav-profile" aria-selected="false">Tentang Kami</a>
                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="data_desa.php" role="tab"
                        aria-controls="nav-contact" aria-selected="false">Data Desa</a>
                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="data_komoditi.php"
                        role="tab" aria-controls="nav-contact" aria-selected="false">Data Komoditi</a>
                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="data_petani.php"
                        role="tab" aria-controls="nav-contact" aria-selected="false">Data Petani</a>
                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="data_panen.php" role="tab"
                        aria-controls="nav-contact" aria-selected="false">Data Hasil Panen</a>
                </div>
            </nav>
            </nav>
        </div>
    </div>

    <main class="container">



        <div id="demo" class="carousel slide" data-bs-ride="carousel">


            <div class="carousel-indicators">
                <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
            </div>


            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="data/img/1.jpeg" alt="slide-1" class="d-block w-100">
                </div>
                <div class="carousel-item">
                    <img src="data/img/2.jpeg" alt="slide-2" class="d-block w-100">
                </div>
                <div class="carousel-item">
                    <img src="data/img/3.jpeg" alt="slide-3" class="d-block w-100">
                </div>
            </div>


            <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div> <br>

        <div class="row mb-2">
            <!-- <div class="col-md-6">
                <div
                    class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                        <strong class="d-inline-block mb-2 text-primary">Progam Studi</strong>
                        <h3 class="mb-0">SISTEM KOMPUTER (S1)</h3>
                        <p class="card-text mb-auto">Program studi Sistem Komputer mewujudkan sumber daya manusia yang
                            handal di bidang teknologi komputer.</p>
                        <a href="prodi.html" class="stretched-link">Selengkapnya...</a>
                    </div>
                    <div class="col-auto d-none d-lg-block">
                        <image class="bd-placeholder-img" src="assets\images\sistem-kr.jpg" width="200" height="250">
                        </image>
                    </div>
                </div>
            </div> -->
            <!-- <div class="col-md-6">
                <div
                    class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                        <strong class="d-inline-block mb-2 text-success">Tentang</strong>
                        <h3 class="mb-0">Sejarah</h3>
                        <p class="mb-auto">Berdirinya AMIK Catur Sakti dan STMIK Catur Sakti Kendari tidak terlepas dari
                            peranan Yayasan Pendidikan Said Dahlan yang dipimpin oleh H.M.Said Dahlan, S.E.</p>
                        <a href="tentang.html" class="stretched-link">Selengkapnya...</a>
                    </div>
                    <div class="col-auto d-none d-lg-block">
                        <image class="bd-placeholder-img" src="assets\images\Logo-cs.jpg" width="200" height="250">
                        </image>
                    </div>
                </div>
            </div> -->
        </div>
        <hr>
        <div class="row g-5">
            <div class="col-md-8">
                <article class="blog-post">
                    <h2 class="blog-post-title mb-1">Sistem informasi Hasil Pertanian Kecamatan Berastagi Kabupaten Karo Prov.Sumatera Utara</h2>
                    <p>&emsp;&emsp;&emsp; Berastagi berjarak sekitar 66 kilometer dari Kota Medan. Berastagi diapit oleh 2 gunung berapi aktif yaitu Gunung Sibayak dan Gunung Sinabung. Di dekat Gunung Sibayak, terdapat pemandian mata air panas. Berastagi sendiri berada di ketinggian lebih dari 1300 mdpl, sehingga menjadikan kota ini menjadi salah satu kota terdingin yang ada di Indonesia.</p>
                    <hr>
                    <p>Aktivitas ekonomi di Berastagi terpusat pada produksi sayur,buah-buahan dan pariwisata. Berastagi merupakan salah satu penghasil sayur dan buah buahan terbesar di Sumatra Utara. Bahkan sudah di ekspor ke Singapura dan Malaysia. Etnis yang dominan di daerah ini adalah Suku Karo, dan berkomunikasi dengan Bahasa Karo dialek Gugung.</p>
                    <hr>
                    <p>Suku asli yang mendiami Berastagi adalah orang Karo. Sebagai kawasan wisata, penduduk dari luar Karo kemudian mulai bermukim dan menetap di Berastagi, sehingga Berastagi termasuk kecamatan dengan tingkat multietnis dan agama paling heterogen di Kabupaten karo</p>
                </article>

            </div>

            <div class="col-md-4">
                <div class="position-sticky" style="top: 2rem;">
                    <div class="p-4 mb-3 bg-light rounded">
                        <h4 class="fst-italic">Alamat</h4>
                        <p class="mb-0">Jalan Jamin Ginting, No 327 Tanggung Karo, Guruanga,</p>
                        <p class="mb-0"> Kec. Berastagi, Kab. Karo, Prov. Sumatra Utara</p>
                    </div>

                    <div class="p-4 mb-3 bg-light rounded">
                        <h4 class="fst-italic">Lokasi</h4>
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15934.61719127431!2d98.50491299999999!3d3.1852909499999997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3031028adff333f9%3A0x5eba62355c88647b!2sBerastagi%2C%20Gundaling%20II%2C%20Kec.%20Berastagi%2C%20Kabupaten%20Karo%2C%20Sumatera%20Utara!5e0!3m2!1sid!2sid!4v1686330313689!5m2!1sid!2sid"
                            width="auto" height="auto" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <footer class="blog-footer">
        <p>Copyright&copy;<a href="#" target="_blank">Raskita Surbakti</a>
    </footer>
</body>

</html>