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

	<!-- Blog section -->
	<section class="blog-section spad">
		<div class="container">
			<!-- Blog post -->
			<div class="blog-item">
				<img src="img/blog/1.jpg" alt="">
				<div class="blog-date">April 14, 2019</div>
				<h3>Top 10 best songs in April</h3>
				<div class="blog-meta">by <a href="">Alan Smith</a> in <a href="">Music</a></div>
				<p>April was a month of musical magnificence as the top 10 songs took the world by storm, captivating hearts, and transcending borders. From chart-topping hits to genre-blurring anthems, these songs wove their magic, reaching millions of views and reshaping the music landscape. 	 </p>
			</div>
			<!-- Blog post -->
			<div class="blog-item">
				<img src="img/blog/2.jpg" alt="">
				<div class="blog-date">April 14, 2019</div>
				<h3>Summer Festivals that you cannot miss</h3>
				<div class="blog-meta">by <a href="">Alan Smith</a> in <a href="">Music</a></div>
				<p>As the sun stretches its golden rays across the horizon, the world comes alive with the vibrant energy of summer festivals. These annual celebrations are more than just gatherings; they are immersive experiences that encapsulate the essence of culture, music, and community. </p>
			</div>
			<!-- Blog post -->
			<div class="blog-item">
				<img src="img/blog/3.jpg" alt="">
				<div class="blog-date">April 14, 2019</div>
				<h3>Michael Smith latest album is out now</h3>
				<div class="blog-meta">by <a href="">Alan Smith</a> in <a href="">Music</a></div>
				<p>In the world of music, certain artists have the extraordinary ability to captivate our hearts and souls with each new release. Michael Smith, a name synonymous with musical brilliance, has once again left us in awe with his latest album, a true testament to his artistry and creativity. </p>
			</div>
			
		</div>
	</section>
	<!-- Blog section end -->

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
