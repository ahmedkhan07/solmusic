<?php
session_start();
require_once __DIR__ . "/connection.php"; // Include your database connection code here

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $currentEmail = $_POST['current_email'];
    $newEmail = $_POST['new_email'];
    $newPassword = $_POST['new_password'];

    // Query to check if the current email and password are correct
    $query = "SELECT * FROM admin WHERE email = '$currentEmail'";
    $result = $con->query($query);

    if ($result->num_rows === 1) {
        // Hash the new password
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Update the email and hashed password
        $updateQuery = "UPDATE admin SET email = '$newEmail', password = '$hashedPassword' WHERE email = '$currentEmail'";
        if ($con->query($updateQuery)) {
            $_SESSION['email'] = $newEmail; // Update the session email

            echo '<script>alert("Login info updated successfully."); window.location.href = "dashboard.php";</script>';
            exit();
        } else {
            $errorMessage = "Error updating login info. Please try again.";
        }
    } else {
        $errorMessage = "Invalid current email. Please enter the correct current email.";
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Update Login Info</title>
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- CSS Files -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/now-ui-dashboard.css?v=1.5.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="assets/demo/demo.css" rel="stylesheet" />
  <!-- Include Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- Include jQuery and Bootstrap JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>
<body>
<div class="wrapper ">
    <div class="sidebar" data-color="blue">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
    <div class="logo">
        <a href="dashboard.php" class="simple-text logo-mini">
          SL
        </a>
        <a href="dashboard.php" class="simple-text logo-normal">
          SolMusic
        </a>
      </div>
      <div class="sidebar-wrapper" id="sidebar-wrapper">
        <ul class="nav">
          <li >
            <a href="./dashboard.php">
              <i class="now-ui-icons design_app"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li>
            <a href="./categories.php">
              <i class="now-ui-icons media-2_sound-wave"></i>
              <p>categories</p>
            </a>
          </li>
          <li>
            <a href="./files.php">
              <i class="now-ui-icons location_map-big"></i>
              <p>files</p>
            </a>
          </li>
      
          <li>
            <a href="./user.php">
              <i class="now-ui-icons users_single-02"></i>
              <p>Users</p>
            </a>
          </li>
          <li>
            <a href="./tables.php">
              <i class="now-ui-icons design_bullet-list-67"></i>
              <p>forms</p>
            </a>
          </li>
       
          <li class="active-pro">
            <a href="./upgrade.php">
              <i class="now-ui-icons arrows-1_cloud-download-93"></i>
              <p>upgrade</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel" id="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="#pablo">Update</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
           
            <ul class="navbar-nav">
             
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="now-ui-icons users_single-02"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Some Actions</span>
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="logout.php">Logout</a>
                  <a class="dropdown-item" href="update.php">Change login info</a>
                </div>
              </li>
              
              <li class="nav-item">
                <a class="nav-link" href="#pablo">
                <i class="now-ui-icons location_world"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Account</span>
                  </p>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>

      <div class="panel-header panel-header-lg">
        
      </div>
      <div class="content">
        <div class="row">
          <div class="col-lg-4">
            <div class="card card-chart">
      
          
            
            </div>
          </div>
<!-- Update Login Info Form -->
<!-- Update Login Info Form -->
<div class="col-md-8">
  <div class="card">
    <div class="card-header">
      <h5 class="title">Update Login Info</h5>
    </div>
    <div class="card-body">
      <form method="POST" action="update.php">
        <div class="row">
          <div class="col-md-12 pr-1">
            <div class="form-group">
              <label>Current Email</label>
              <input type="email" class="form-control" name="current_email" placeholder="Current Email" required>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 pr-1">
            <div class="form-group">
              <label>New Email</label>
              <input type="email" class="form-control" name="new_email" placeholder="New Email" required>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>New Password</label>
              <input type="password" class="form-control" name="new_password" placeholder="New Password" required>
            </div>
          </div>
        </div>
        <button type="submit" name="update_login" class="btn btn-primary">Update Login Info</button>
      </form>
    </div>
  </div>
</div>

</div>
  </div>
</div>
</div>
</div>



</body>
</html>
