<?php
session_start();

include 'database.php'; // Include your database connection code here

// Check if the user is logged in
if (!isset($_SESSION["user_id"])) {
	// Display a JavaScript prompt
	echo '<script>alert("Please log in first to access this page."); window.location.href = "signup.php";</script>';
	exit; // Stop further execution of the page
}


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

// Fetch music files
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// SQL query to fetch audio song details
$sql = "SELECT `id`, `artist_name`, `song_name`, `file_path` FROM `music_files`";
$result = $mysqli->query($sql);

if ($result === false) {
    die("Query failed: " . $mysqli->error);
}

// SQL query to fetch video details
$sql = "SELECT `id`, `artist_name`, `song_name`, `file_path` FROM `video_files`";
$result = $mysqli->query($sql);

if ($result === false) {
    die("Query failed: " . $mysqli->error);
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
<style>
	.category-title {
	display: inline-block;
	font-size: 15px;
	font-weight: 500;
	color: #6a7080;
	padding: 10px 6px 16px;
	margin-right: 55px;
	margin-bottom: 10px;
	border-bottom: 2px solid transparent;
	cursor: pointer;
}

</style>
</head>
<body>
	<!-- Page Preloder -->
	<div id="preloder">
		<div class="loader"></div>
	</div>

	<?php
	include 'nav.php';
	?>

	<!-- Category section -->
	

	<section class="category-section spad">
        <div class="container-fluid">
            <div class="section-title">
                <h2>Music</h2>
            </div>
            <div class="container">
                <div class="category-links">
                    <a href="" class="active">All songs</a>
                    <a href="artist.php">Artists</a>
                    <a href="playlist.php">Playlists</a>
                </div>
            </div>
            <div class="category-title">
                <h3>Video songs</h3>
            </div>
            <div class="category-items">
                <div class="row">
                    <?php
                    // Loop through the database results and display video items
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $video_id = $row['id'];
                            $artist_name = $row['artist_name'];
                            $song_name = $row['song_name'];
                            $file_path = $row['file_path'];
                    ?>
                    <div class="col-md-4">
                        <div class="category-item">
                            <div class="video-item">
                                <video class="myVideo" width="360" height="315" controls>
                                    <source src="admin/<?php echo $file_path; ?>" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                            <div class="ci-text">
                                <h4><?php echo $song_name; ?></h4>
                                <p><?php echo $artist_name; ?></p>
                            </div>
                            <a href="#" class="ci-link" id="playButton"><i class="fa fa-play"></i></a>
                        </div>
                    </div>
                    <?php
                        }
                    } else {
                        echo "No video songs found.";
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>

	<section class="songs-section">
        <div class="container">
            <div class="category-title">
                <h3>Audio songs</h3>
            </div>
            <?php
            include 'database.php'; // Include your database connection file

            // SQL query to fetch audio song details
            $sql = "SELECT `id`, `artist_name`, `song_name`, `file_path` FROM `music_files`";
            $result = $mysqli->query($sql);

            if ($result === false) {
                die("Query failed: " . $mysqli->error);
            }

            // Loop through the database results and display audio song items
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $song_id = $row['id'];
                    $artist_name = $row['artist_name'];
                    $song_name = $row['song_name'];
                    $file_path = $row['file_path'];
            ?>
            <div class="song-item">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="song-info-box">
                            <img src="img/songs/<?php echo $song_id; ?>.jpg" alt="">
                            <div class="song-info">
                                <h4><?php echo $artist_name; ?></h4>
                                <p><?php echo $song_name; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="single_player_container">
                            <div class="single_player">
                                <div class="jp-jplayer jplayer" data-ancestor=".jp_container_<?php echo $song_id; ?>"
                                    data-url="admin/<?php echo $file_path; ?>"></div>
                                <div class="jp-audio jp_container_<?php echo $song_id; ?>" role="application"
                                    aria-label="media player">
									<div class="jp-gui jp-interface">

<!-- Player Controls -->
<div class="player_controls_box">
	<button class="jp-prev player_button" tabindex="0"></button>
	<button class="jp-play player_button" tabindex="0"></button>
	<button class="jp-next player_button" tabindex="0"></button>
	<button class="jp-stop player_button" tabindex="0"></button>
</div>
<!-- Progress Bar -->
<div class="player_bars">
	<div class="jp-progress">
		<div class="jp-seek-bar">
			<div>
				<div class="jp-play-bar"><div class="jp-current-time" role="timer" aria-label="time">0:00</div></div>
			</div>
		</div>
	</div>
	<div class="jp-duration ml-auto" role="timer" aria-label="duration">00:00</div>
</div>
</div>

                            </div>
                        </div>
                    </div>
					</div>
                    <div class="col-lg-2">
                        <div class="songs-links">
                            <a href=""><img src="img/icons/p-1.png" alt=""></a>
                            <a href=""><img src="img/icons/p-2.png" alt=""></a>
                            <a href=""><img src="img/icons/p-3.png" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                }
            } else {
                echo "No audio songs found.";
            }
            ?>
            <div class="site-pagination pt-5 mt-5">
                <a href="#" class="active">01.</a>
                <a href="#">02.</a>
                <a href="#">03.</a>
                <a href="#">04.</a>
            </div>
        </div>
    </section>

 
	<!-- Songs section end -->

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

	<!-- Audio Player and Initialization -->
	<script src="js/jquery.jplayer.min.js"></script>
	<script src="js/jplayerInit.js"></script>

	<script>
		// Get references to all video elements with the class "myVideo"
		const videos = document.querySelectorAll('.myVideo');
		const playButtons = document.querySelectorAll('.ci-link');
	
		// Add a click event listener to each play button
		playButtons.forEach((button, index) => {
			button.addEventListener('click', function (e) {
				e.preventDefault(); // Prevent the default anchor link behavior
				const video = videos[index]; // Get the corresponding video element
				if (video.paused) {
					video.play();
					button.innerHTML = '<i class="fa fa-pause"></i>'; // Change the play button icon to pause
				} else {
					video.pause();
					button.innerHTML = '<i class="fa fa-play"></i>'; // Change the pause button icon to play
				}
			});
		});
	</script>
	
	</body>
</html>
