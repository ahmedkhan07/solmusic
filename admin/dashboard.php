<?php
session_start();

// Include your database connection code here
require_once __DIR__ . "/database.php"; // Update the path to your database.php file

// Use the $mysqli connection object to fetch user data
$sql = "SELECT * FROM login";
$result = $mysqli->query($sql);

if (!$result) {
    die("Error fetching user data: " . $mysqli->error);
}



$users = $result->fetch_all(MYSQLI_ASSOC);
$noResultsMessage = ""; // Initialize the no results message
$sql = "SELECT `id`, `email` FROM `admin`";
$result = $mysqli->query($sql);

if (!$result) {
    die("Error fetching admin user data: " . $mysqli->error);
}

$adminUsers = $result->fetch_all(MYSQLI_ASSOC);
$noAdminResultsMessage = ""; // Initialize the no results message
$message

?>









<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
 
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Admin
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- CSS Files -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/now-ui-dashboard.css?v=1.5.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="">
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
          <li class="active ">
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
            <a class="navbar-brand" href="#pablo">Dashboard</a>
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
      <!-- End Navbar -->
      <div class="panel-header panel-header-lg">
        
      </div>
      <div class="content">
        <div class="row">
          <div class="col-lg-4">
            <div class="card card-chart">
      
          
            
            </div>
          </div>

 
       
          <div class="col-md-6">
          <div class="card">
        <div class="card-header">
            <h4 class="card-title">Current Website Users</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead class="text-primary">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th class="text-right">Action</th>
                    </thead>
                    <tbody>
                    <tbody>
  <?php if (!empty($users)) { ?>
    <?php foreach ($users as $user) { ?>
      <tr>
        <td><?php echo $user['id']; ?></td>
        <td><?php echo $user['username']; ?></td>
        <td><?php echo $user['email']; ?></td>
        <td class="text-right">
          <a href="delete_user.php?id=<?php echo $user['id']; ?>" class="btn btn-danger btn-round btn-icon btn-icon-mini btn-neutral">
            <i class="now-ui-icons ui-1_simple-remove"></i>
          </a>
        </td>
      </tr>
    <?php } ?>
  <?php } else { ?>
    <tr>
      <td colspan="4"><?php echo isset($noResultsMessage) ? $noResultsMessage : "No users found."; ?></td>
    </tr>
  <?php } ?>
</tbody>

                </table>
            </div>
        </div>
    </div>

          </div>
        </div>
      

        <div class="col-md-6">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Admin Users</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead class="text-primary">
                        <th>ID</th>
                        <th>Email</th>
                        <th class="text-right">Action</th>
                    </thead>
                    <tbody>
                    <?php if (!empty($adminUsers)) { ?>
                        <?php foreach ($adminUsers as $adminUser) { ?>
                            <tr>
                                <td><?php echo $adminUser['id']; ?></td>
                                <td><?php echo $adminUser['email']; ?></td>
                                <td class="text-right">
                                    <!-- Add any action buttons or links here -->
                                    <!-- Example delete button -->
                                    <a href="delete_admin_user.php?id=<?php echo $adminUser['id']; ?>" class="btn btn-danger btn-round btn-icon btn-icon-mini btn-neutral">
                                        <i class="now-ui-icons ui-1_simple-remove"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr>
                            <td colspan="3">No admin users found.</td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


 
    </div>
  </div>
      
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="assets/js/core/jquery.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/now-ui-dashboard.min.js?v=1.5.0" type="text/javascript"></script><!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
  <script src="assets/demo/demo.js"></script>

</body>

</html>