<?php

session_start();
$conn = include 'database.php';

include 'database.php';





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

if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['subject']) && isset($_POST['message'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $sql = "INSERT INTO contact (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";

    if ($conn->query($sql) === TRUE) {
       
        header("Location: contact.php");
        exit;
    } else {
        
        header("Location: contact.php");
        exit; 
    }
} 

$conn->close();
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

	<!-- Contact section -->
	<section class="contact-section">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-6 p-0">
					<!-- Map -->
					<div class="map"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3620.802000249838!2d67.03102487599604!3d24.836443946217017!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3eb33dc578155555%3A0x3ae3774540a5995b!2sAptech%20Computer%20Education!5e0!3m2!1sen!2s!4v1694708779053!5m2!1sen!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" style="border:0" allowfullscreen></iframe></div>
				</div>
				<div class="col-lg-6 p-0">
					<div class="contact-warp">
						<div class="section-title mb-0">
							<h2>Get in touch</h2>
						</div>
						<p>At SOLMUSIC, we value every connection, every question, and every suggestion. We understand that communication is the lifeline of our relationship with you, our cherished audience. That's why we invite you to get in touch with us because your voice matters. </p>
						<ul>
							<li>Aptech Clifton Center, Karachi.</li>
							<li>+92 111 222 333 44</li>
							<li>contact@solmusic.com</li>
						</ul>
						<form class="contact-from" action="contact.php" method="POST">
    <div class="row">
        <div class="col-md-6">
            <input name="name" type="text" placeholder="Your name" required>
        </div>
        <div class="col-md-6">
            <input name="email" type="email" placeholder="Your e-mail" required>
        </div>
        <div class="col-md-12">
            <input name="subject" type="text" placeholder="Subject" required>
            <textarea name="message" placeholder="Message" required></textarea>
            <button class="site-btn">send message</button>
        </div>
    </div>
</form>

					</div>
				</div>
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
