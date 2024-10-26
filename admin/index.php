<?php
session_start();

$errorMessage = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    include 'connection.php'; // Include your database connection code here

    $query = "SELECT * FROM admin WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) === 1) {
        $_SESSION['email'] = $email;
        mysqli_close($con);
        echo '<script>alert("Login successful. Welcome, ' . $email . '!"); window.location.href = "dashboard.php";</script>';
        exit();
    } else {
        $errorMessage = "Invalid email or password. Please try again.";
    }
}
?>





<!DOCTYPE html>
<html lang="en">

<head>
  <title>admin</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- CSS Files -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/css/now-ui-dashboard.css?v=1.5.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />

</head>

<body>
<style>
    body {
      background-image: url("assets/img/bg.jpeg");
      background-color: #f8f9fa;
      font-family: 'Montserrat', Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    .hero {
      background-image: url("assets/img/bg.jpeg");
      background-size: cover;
      background-position: center;
      height: 300px;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .hero h1 {
      color: white;
      font-size: 32px;
      margin: 0;
    }

    .site-navbar {
      background-color: #333;
      padding: 25px 0;
    }

    .site-navbar .logo {
      text-align: center;
    }

    .site-navbar .logo a {
      color: white;
      font-size: 24px;
      text-decoration: none;
      font-weight: bold;
    }

    .login-container {
      background-color: white;
      border-radius: 10px;
      padding: 20px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      max-width: 400px;
      margin: 0 auto;
      margin-top: -50px;
    }

    .login-container h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    .form-group {
      margin-bottom: 15px;
    }

    label {
      font-weight: bold;
      margin-bottom: 5px;
    }

    input {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }





.error-message {
  color: red;
  font-size: 16px;
  margin-top: 10px;
}

.login-form {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.input-container {
  display: flex;
  align-items: center;
  width: 100%;
  padding: 10px;
  margin-bottom: 15px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

.input-container i {
  margin-right: 10px;
  font-size: 18px;
  color: #333;
}

.input-container input {
  flex: 1;
  border: none;
  outline: none;
  padding: 10px;
}

.login-button {
  width: 100%;
  padding: 10px;
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s;
}

.login-button:hover {
  background-color: #0056b3;
}

  </style>

  <div class="site-wrap">

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>


    <header class="site-navbar py-4" role="banner">
    <div class="logo">
        <a href="#" class="simple-text logo-mini">
          SL |
        </a>
        <a href="#" class="simple-text logo-normal">
          SolMusic
        </a>
      </div>
            
          </div>
        </div>

    </header>
    <div class="hero overlay" style="">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-9 mx-auto text-center">
            
          </div>
        </div>
      </div>
    </div>


    <div class="container">
    <div class="login-container">
      <h2 class="login-title">Sign In</h2>
      <?php if (!empty($errorMessage)) : ?>
        <p class="error-message"><?php echo $errorMessage; ?></p>
      <?php endif; ?>
      <form method="post" class="login-form">
        <div class="input-container">
          <i class="fas fa-envelope"></i>
          <input type="email" id="email" name="email" placeholder="Email" required>
        </div>
        <div class="input-container">
          <i class="fas fa-lock"></i>
          <input type="password" id="password" name="password" placeholder="Password" required>
        </div>
        <button type="submit" class="login-button">Sign In</button>
      </form>
    </div>
  </div>
  </div>



          


          </div>
          <div class="col-lg-4 ml-auto">

            
          </div>
        </div>
      </div>
    </div>


   


  </div>




  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/now-ui-dashboard.min.js?v=1.5.0" type="text/javascript"></script><!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
  <script src="../assets/demo/demo.js"></script>

</body>

</html>