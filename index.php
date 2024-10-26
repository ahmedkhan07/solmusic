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

	<!-- Hero section -->
	<section class="hero-section">
		<div class="hero-slider owl-carousel">
			<div class="hs-item">
				<div class="container">
					<div class="row">
						<div class="col-lg-6">
							<div class="hs-text">
								<h2><span>Music</span> for everyone.</h2>
								<p>Welcome to SOLMUSIC, where the language of emotion is expressed through the universal medium of music. We are passionate about the power of music to inspire, heal, and connect people from all walks of life.</p>
								
							</div>
						</div>
						<div class="col-lg-6">
							<div class="hr-img">
								<img src="img/hero-bg.png" alt="">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="hs-item">
				<div class="container">
					<div class="row">
						<div class="col-lg-6">
							<div class="hs-text">
								<h2><span>Listen </span> to new music.</h2>
								<p>Welcome to SOLMUSIC, where the language of emotion is expressed through the universal medium of music. We are passionate about the power of music to inspire, heal, and connect people from all walks of life. </p>
								
							</div>
						</div>
						<div class="col-lg-6">
							<div class="hr-img">
								<img src="img/hero-bg.png" alt="">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Hero section end -->

	<!-- Intro section -->
	<section class="intro-section spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="section-title">
						<h2>Unlimited Access to 100K tracks</h2>
					</div>
				</div>
				<div class="col-lg-6">
					<p>At SOLMUSIC, our mission is to be your ultimate destination for all things music. Whether you're a casual listener, an aspiring musician, or a seasoned professional, we strive to create a space where music enthusiasts can come together to explore, learn, and share their love for music.</p>
					<a href="music.php" class="site-btn">Try it now</a>
				</div>
			</div>
		</div>
	</section>
	<!-- Intro section end -->

	<!-- How section -->
	<section class="how-section spad set-bg" data-setbg="img/how-to-bg.jpg">
		<div class="container text-white">
			<div class="section-title">
				<h2>How it works</h2>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="how-item">
						<div class="hi-icon">
							<img src="img/icons/brain.png" alt="">
						</div>
						<h4>Create an account</h4>
						<p>Create an account to unlock access to our incredible world of music, with extra perks and features only for verified users! </p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="how-item">
						<div class="hi-icon">
							<img src="img/icons/pointer.png" alt="">
						</div>
						<h4>Choose a plan</h4>
						<p>Select a Plan and Dive In! Choose whatever plan suits your taste of music best & enjoy the premium perks coming with it! </p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="how-item">
						<div class="hi-icon">
							<img src="img/icons/smartphone.png" alt="">
						</div>
						<h4>Listen Music</h4>
						<p>Listen music your way! Experience the joy of music at your fingertips. Listen your favorite tracks today and carry the magic of melodies wherever you go. </p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- How section end -->

	<!-- Concept section -->
	<section class="concept-section spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="section-title">
						<h2>Our Concept & artists</h2>
					</div>
				</div>
				<div class="col-lg-6">
					<p>At the heart of our music platform lies a diverse tapestry of concepts and artists, each woven together to create a vibrant musical ecosystem. We curate a rich selection of musical genres and concepts that range from the soothing melodies of acoustic ballads to the electrifying rhythms of EDM, ensuring there's something for every musical palate.</p>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-3 col-sm-6">
					<div class="concept-item">
						<img src="img/concept/1.jpg" alt="">
						<h5>Soul Music</h5>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="concept-item">
						<img src="img/concept/2.jpg" alt="">
						<h5>Live Concerts</h5>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="concept-item">
						<img src="img/concept/3.jpg" alt="">
						<h5>Dj Sets</h5>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="concept-item">
						<img src="img/concept/4.jpg" alt="">
						<h5>Live Streems</h5>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Concept section end -->

	<!-- Subscription section -->
	<section class="subscription-section spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="sub-text">
						<h2>Subscription from $15/month</h2>
						<h3>Start a free trial now</h3>
						<p>Embark on a premium music experience like no other with our exclusive $15 trial offer. Dive into the world of music with an array of enticing perks, designed to elevate your listening journey to new heights.</p>
						<a href="upgrade.php" class="site-btn">Try it now</a>
					</div>
				</div>
				<div class="col-lg-6">
					<ul class="sub-list">
						<li><img src="img/icons/check-icon.png" alt="">Play any track</li>
						<li><img src="img/icons/check-icon.png" alt="">Listen offline</li>
						<li><img src="img/icons/check-icon.png" alt="">No ad interruptions</li>
						<li><img src="img/icons/check-icon.png" alt="">Unlimited skips</li>
						<li><img src="img/icons/check-icon.png" alt="">High quality audio</li>
						<li><img src="img/icons/check-icon.png" alt="">Shuffle play</li>
					</ul>
				</div>
			</div>
		</div>
	</section>
	<!-- Subscription section end -->

	<!-- Premium section end -->
	<section class="premium-section spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="section-title">
						<h2>Why go Premium</h2>
					</div>
				</div>
				<div class="col-lg-6">
					<p>Choose Premium for an Unmatched Music Experience, with options to play any track, listen to music offline, no ad interruptions, unlimited skips, high quality audio & much more!</p>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-3 col-sm-6">
					<div class="premium-item">
						<img src="img/premium/1.jpg" alt="">
						<h4>No ad interruptions </h4>
						<p>Making the experience better and more melodious without any ads!</p>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="premium-item">
						<img src="img/premium/2.jpg" alt="">
						<h4>High Quality</h4>
						<p>With high quality audio, blessing your ears with the music we strive to produce!</p>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="premium-item">
						<img src="img/premium/3.jpg" alt="">
						<h4>Listen Offline</h4>
						<p>Listen offline without any worries for an internet connection! </p>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="premium-item">
						<img src="img/premium/4.jpg" alt="">
						<h4>Download Music</h4>
						<p>Download your music and enjoy with 0 ad interruptions!</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Premium section end -->

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
