<?php
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["submitMusic"])) {
        $artistName = $_POST["artistName"];
        $songName = $_POST["songName"];

        $uploadDirectory = "uploads/music/";
        $targetFile = $uploadDirectory . basename($_FILES["musicFile"]["name"]);

        if (move_uploaded_file($_FILES["musicFile"]["tmp_name"], $targetFile)) {
            $conn = new mysqli("localhost", "root", "", "sound");

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "INSERT INTO music_files (artist_name, song_name, file_path) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $artistName, $songName, $targetFile);
            if ($stmt->execute()) {
                header("Location: files.php");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $stmt->close();
            $conn->close();
        } else {
            echo "Sorry, there was an error uploading your music file.";
        }

    } elseif (isset($_POST["submitVideo"])) {
        $artistName = $_POST["artistName"];
        $songName = $_POST["songName"];

        $uploadDirectory = "uploads/videos/";
        $targetFile = $uploadDirectory . basename($_FILES["videoFile"]["name"]);

        if (move_uploaded_file($_FILES["videoFile"]["tmp_name"], $targetFile)) {
            $conn = new mysqli("localhost", "root", "", "sound");

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "INSERT INTO video_files (artist_name, song_name, file_path) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $artistName, $songName, $targetFile);

            if ($stmt->execute()) {
                header("Location: files.php");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $stmt->close();
            $conn->close();
        } else {
            echo "Sorry, there was an error uploading your video file.";
        }

    } elseif (isset($_POST["removeMusic"])) { // Check if the "Remove Music" button was clicked
        $musicId = $_POST["musicId"];

        $conn = new mysqli("localhost", "root", "", "sound");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "DELETE FROM music_files WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $musicId);

        if ($stmt->execute()) {
            header("Location: files.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $stmt->close();
        $conn->close();

    } elseif (isset($_POST["removeVideo"])) { // Check if the "Remove Video" button was clicked
        $videoId = $_POST["videoId"];

        $conn = new mysqli("localhost", "root", "", "sound");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "DELETE FROM video_files WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $videoId);

        if ($stmt->execute()) {
            header("Location: files.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $stmt->close();
        $conn->close();
    }
}
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

<body class="user-profile">
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
          <li class="active ">
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
            <a class="navbar-brand" href="#pablo">Files</a>
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
      <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
  <div class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Upload Music</h4>
        </div>
        <div class="card-body">
          <form action="files.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label for="artistName">Artist Name</label>
              <input type="text" class="form-control" name="artistName" id="artistName" required>
            </div>
            <div class="form-group">
              <label for="songName">Song Name</label>
              <input type="text" class="form-control" name="songName" id="songName" required>
            </div>
            <div class="form-group">
              <label for="musicFile">Select Music File</label>
              <input type="file" class="form-control" name="musicFile" id="musicFile" required>
            </div>
            <button type="submit" class="btn btn-primary" name="submitMusic">Upload Music</button>
          </form>
        </div>
      </div>
    </div>
 

    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Upload Video</h4>
        </div>
        <div class="card-body">
          <form action="files.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label for="artistName">Artist Name</label>
              <input type="text" class="form-control" name="artistName" id="artistName" required>
            </div>
            <div class="form-group">
              <label for="songName">Song Name</label>
              <input type="text" class="form-control" name="songName" id="songName" required>
            </div>
            <div class="form-group">
              <label for="videoFile">Select Video File</label>
              <input type="file" class="form-control" name="videoFile" id="videoFile" required>
            </div>
            <button type="submit" class="btn btn-primary" name="submitVideo">Upload Video</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="content">
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Uploaded Music</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
                <thead class="text-primary">
                  <th>ID</th>
                  <th>Artist Name</th>
                  <th>Song Name</th>
                  <th>Actions</th>
                </thead>
                <tbody>
                  <?php
                  $conn = new mysqli("localhost", "root", "", "sound");
                  if ($conn->connect_error) {
                      die("Connection failed: " . $conn->connect_error);
                  }

                  $sql = "SELECT * FROM music_files";
                  $result = $conn->query($sql);

                  if ($result->num_rows > 0) {
                      while ($row = $result->fetch_assoc()) {
                          echo "<tr>";
                          echo "<td>" . $row["id"] . "</td>";
                          echo "<td>" . $row["artist_name"] . "</td>";
                          echo "<td>" . $row["song_name"] . "</td>";
                          echo "<td>";
                          echo "<form action='files.php' method='POST'>";
                          echo "<input type='hidden' name='musicId' value='" . $row["id"] . "'>";
                          echo "<button type='submit' class='btn btn-danger btn-round btn-icon btn-icon-mini btn-neutral' name='removeMusic' data-original-title='Remove'>";
                          echo "<i class='now-ui-icons ui-1_simple-remove'></i>";
                          echo "</button>";
                          echo "</form>";
                          echo "</td>";
                          echo "</tr>";
                      }
                  } else {
                      echo "<tr><td colspan='4'>No records found</td></tr>";
                  }

                  $conn->close();
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Uploaded Videos</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
                <thead class="text-primary">
                  <th>ID</th>
                  <th>Artist Name</th>
                  <th>Song Name</th>
                  <th>Actions</th>
                </thead>
                <tbody>
                  <?php
                  $conn = new mysqli("localhost", "root", "", "sound");
                  if ($conn->connect_error) {
                      die("Connection failed: " . $conn->connect_error);
                  }

                  $sql = "SELECT * FROM video_files";
                  $result = $conn->query($sql);

                  if ($result->num_rows > 0) {
                      while ($row = $result->fetch_assoc()) {
                          echo "<tr>";
                          echo "<td>" . $row["id"] . "</td>";
                          echo "<td>" . $row["artist_name"] . "</td>";
                          echo "<td>" . $row["song_name"] . "</td>";
                          echo "<td>";
                          echo "<form action='files.php' method='POST'>";
                          echo "<input type='hidden' name='videoId' value='" . $row["id"] . "'>";
                          echo "<button type='submit' class='btn btn-danger btn-round btn-icon btn-icon-mini btn-neutral' name='removeVideo' data-original-title='Remove'>";
                          echo "<i class='now-ui-icons ui-1_simple-remove'></i>";
                          echo "</button>";
                          echo "</form>";
                          echo "</td>";
                          echo "</tr>";
                      }
                  } else {
                      echo "<tr><td colspan='4'>No records found</td></tr>";
                  }

                  $conn->close();
                  ?>
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