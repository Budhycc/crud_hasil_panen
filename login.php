<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link href="css/bootstrap.min.css" rel="stylesheet" />
  <script src="js/bootstrap.bundle.min.js"></script>
  <style>
    body {
      background-image: url('data/img/cover.jpeg');
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

    .login-form .btn-primary {
      width: 100%;
      border-radius: 3px;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-md-6 mx-auto">
        <div class="login-form">
          <h2>Login</h2>
          <form method="POST" action="autentikasi.php">
            <div class="form-group">
              <label for="nik">Nik</label>
              <input type="text" class="form-control" minlength="16" maxlength="16" pattern="\d{1,16}" required
                name="nik" placeholder="Masukan Nik">
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" required name="password" placeholder="Masukan password">
            </div>
            <button type="submit" name="login" class="btn btn-primary mt-4">Login</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

</html>