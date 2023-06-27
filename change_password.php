<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ganti Password</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <script src="js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            /* background-image: url('data/img/cover.jpeg'); */
            background-size: cover;
            background-position: center;
            height: 100vh;
        }

        .login-form {
            background-color: rgba(255, 255, 255, 0.8);
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            margin-top: 100px;
            border-radius: 5px;
        }

        .login-form h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .login-form .form-control {
            border-radius: 3px;
        }

        .login-form .btn-group {
            display: flex;
            justify-content: space-between;
        }

        .login-form .btn-primary,
        .login-form .btn-secondary {
            width: 48%;
            border-radius: 3px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="login-form">
                    <h2>Ubah</h2>
                    <form method="POST" action="autentikasi.php">
                        <div class="form-group">
                            <label for="password_lama">Password Lama</label>
                            <input type="password" class="form-control" required name="password_lama"
                                placeholder="Masukan password lama">
                        </div>
                        <div class="form-group">
                            <label for="cpassword_lama">Konfirmasi Password Lama</label>
                            <input type="password" class="form-control" required name="cpassword_lama"
                                placeholder="Konfirmasi password lama">
                        </div>
                        <div class="form-group">
                            <label for="password_baru">Password Baru</label>
                            <input type="password" class="form-control" required name="password_baru"
                                placeholder="Masukan password baru">
                        </div>
                        <div class="form-group">
                            <label for="cpassword_baru">Konfirmasi Password Baru</label>
                            <input type="password" class="form-control" required name="cpassword_baru"
                                placeholder="Konfirmasi password baru">
                        </div>
                        <div class="mt-2">
                            <div class="btn-group">
                                <button type="submit" name="change_password" class="btn btn-primary mt-4">Ubah</button>
                                <a href="profile.php" type="button" class="btn btn-secondary mt-4">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>