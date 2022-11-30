<?php
session_start(); //inisialisasi session
require_once 'db_connect.php';

//cek apakah user sudah submit form
if (isset($_POST['submit'])) {
  $valid = true; //flag validasi

  //cek validasi email
  $email = $_POST['email'];
  if ($email == '') {
    $error_email = 'Email is required';
    $valid = false;
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error_email = 'Invalid email format';
    $valid = false;
  }

  //cek validasi password
  $password = $_POST['password'];
  if ($password == '') {
    $error_password = 'Password is required';
    $valid = false;
  }

  //cek validasi
  if ($valid) {
    //asign a query
    $query =
      " SELECT * FROM mahasiswa WHERE email_mhs='" .
      $email .
      "' AND password_mhs='" .
      $password .
      "' ";
    //excute the query
    $result = $koneksi->query($query);
    if (!$result) {
      die('Could not query the database: <br />' . $koneksi->error);
    } else {
      if ($result->num_rows > 0) {
        //login berhasil
        $_SESSION['username'] = $email;
        header('Location: Mahasiswa/home.php');
        exit();
      } else {
        //login gagal
        echo '<span class="error">Combination of username and password are not correct.</span>';
      }
    }
    //close koneksi connection
    $koneksi->close();
  }
}
?>
<!DOCTYPE html>
<html>

  <title>Login</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/a81368914c.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
  </head>

  <body>
    <img class="wave" src="ombak1.png">
    <div class="container">
      <div class="img">
        <img src="logoundip.png">
      </div>
      <div class="login-content">
        <form method="POST" action="<?php echo htmlspecialchars(
                                      $_SERVER['PHP_SELF']
                                    ); ?>">
          <h2 class="title">Sign In</h2>
          <div class="dropdown mt-3">
            Login as <button class="btn btn-primary dropdown-toggle text-light" role="button" data-bs-toggle="dropdown" aria-expanded="false" id="book-dropdown">
              Mahasiswa
            </button>
            <ul class="dropdown-menu" aria-labelledby="book-dropdown">
              <li><a class="dropdown-item" href="login_mhs.php">Mahasiswa</a></li>
              <li><a class="dropdown-item" href="login.php">Admin</a></li>
            </ul>
          </div>
          <div class="input-div one">
            <div class="i">
              <i class="fas fa-user"></i>
            </div>
            <div class="div">
              <h5>Email</h5>
              <input type="email" name="email" class="input">
            </div>
          </div>
          <div class="input-div pass">
            <div class="i">
              <i class="fas fa-lock"></i>
            </div>
            <div class="div">
              <h5>Password</h5>
              <input type="password" name="password" class="input">
            </div>
          </div>
          <input type="submit" name="submit" class="btn" value="Login">
        </form>
      </div>
    </div>
    <script type="text/javascript" src="js/main.js"></script>
  </body>

</html>