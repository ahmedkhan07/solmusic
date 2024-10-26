<?php
session_start();

require_once __DIR__ . "/database.php"; // Include your database connection code here

// Check if the user is logged in
if (isset($_SESSION["user_id"])) {
    // Verify if the user ID still exists in the database
    $user_id = $_SESSION["user_id"];
    $sql = "SELECT * FROM login WHERE id = $user_id";
    $result = $mysqli->query($sql);
    
    if (!$result || $result->num_rows === 0) {
        // User not found, destroy the session
        session_destroy();
        
        exit();
    }

    // User is logged in, fetch user data
    $user = $result->fetch_assoc();
}

?>


<!DOCTYPE html>
<html lang="zxx">
<head>
	<title>SolMusic</title>
	<meta charset="UTF-8">
	<meta name="description" content="SolMusic HTML Template">
	<meta name="keywords" content="music, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<!-- Favicon -->
	

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i&display=swap" rel="stylesheet">
 
	<!-- Stylesheets -->
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" href="css/font-awesome.min.css"/>
	<link rel="stylesheet" href="css/owl.carousel.min.css"/>
	<link rel="stylesheet" href="css/slicknav.min.css"/>

	<!-- Main Stylesheets -->
	<link rel="stylesheet" href="css/style.css"/>


	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body>
	<!-- Page Preloder -->
	<div id="preloder">
		<div class="loader"></div>
	</div>

	<!-- Header section -->
	<?php
	include 'nav.php';
	?>
	<!-- Header section end -->

	<!-- Playlist section -->
	<section class="playlist-section spad">
		<div class="container-fluid">
			<div class="section-title">
				<h2>Playlists</h2>
			</div>
			<div class="container">
				<ul class="playlist-filter controls">
					<li class="control" data-filter=".genres">Genres</li>
					<li class="control" data-filter=".artists">Artists</li>
					<li class="control" data-filter=".movies">Movies Soundtracks</li>
					<li class="control" data-filter=".labels">Labels</li>
					<li class="control" data-filter="all">All Playlist</li>
				</ul>
			</div>                                              
			<div class="clearfix"></div>
			<div class="row playlist-area">
			<?php
// Include your database connection here (e.g., include 'database.php').

// Create a database connection
$conn = new mysqli("localhost", "root", "", "sound");

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch categories, class names, and image paths
$sql = "SELECT name, class_name, image_path FROM categories";
$result = $conn->query($sql);

// Check if there are results
if ($result->num_rows > 0) {
    // Loop through the results
    while ($row = $result->fetch_assoc()) {
        $categoryName = $row["name"];
        $className = $row["class_name"];
        $imagePath = $row["image_path"];
        
        // Display category, class name, and image
        echo "<div class='mix col-lg-3 col-md-4 col-sm-6 $className'>";
        echo "<div class='playlist-item'>";
        echo "<img src='admin/$imagePath' alt='$categoryName'>";
        echo "<h5>$categoryName</h5>";
        echo "</div>";
        echo "</div>";
    }
} else {
    echo "No categories found.";
}

// Close the database connection
$conn->close();
?>


			</div>
		</div>
	</section>
	<!-- Playlist section end -->

	<!-- Help section end -->
	<section class="help-section spad pt-0">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="section-title mb-0 pb-4">
						<h2>Need Help to find music? </h2>
					</div>
					<p>Discovering the perfect soundtrack for your mood, moment, or occasion can sometimes feel like searching for a needle in a haystack. But fret not – we're here to assist you on your musical quest! </p>
				</div>
				<div class="col-lg-6">
					<div class="d-flex h-100 align-items-end">
						<form class="search-form">
							<input type="text" placeholder="Hit it">
							<button>Search</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Help section end -->

	<!-- Footer section -->
	<?php
	include 'footer.php';
	?>
	<!-- Footer section end -->
	
	<!--====== Javascripts & Jquery ======-->
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.slicknav.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/mixitup.min.js"></script>
	<script src="js/main.js"></script>

	</body>
</html>
