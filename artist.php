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

	<section class="player-section set-bg" data-setbg="img/player-bg.jpg">
		<div class="player-box">
			<div class="tarck-thumb-warp">
				<div class="tarck-thumb">
					<img src="img/wave-thumb.jpg" alt="">
					<button onclick="wavesurfer.playPause();" class="wp-play"></button>
				</div>
			</div>
			<div class="wave-player-warp">
				<div class="row">
					<div class="col-lg-8">
						<div class="wave-player-info">
							<h2>Michael Smith</h2>
							<p>One Night in Ibiza</p>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="songs-links">
							<a href=""><img src="img/icons/p-1.png" alt=""></a>
							<a href=""><img src="img/icons/p-2.png" alt=""></a>
							<a href=""><img src="img/icons/p-3.png" alt=""></a>
						</div>
					</div>
				</div>
				<div id="wavePlayer" class="clierfix">
					<div id="audiowave" data-waveurl="music-files/8.mp3"></div>
					<div id="currentTime"></div>
					<div id="clipTime"></div>
					<!-- Player Controls -->
					<div class="wavePlayer_controls">
						<button class="jp-prev player_button" onclick="wavesurfer.skipBackward();"></button>
						<button class="jp-play player_button" onclick="wavesurfer.playPause();"></button>
						<button class="jp-next player_button" onclick="wavesurfer.skipForward();"></button>
						<button class="jp-stop player_button" onclick="wavesurfer.stop();"></button>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Player section end -->

	<!-- Songs details section -->
	<section class="songs-details-section">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-3">
					<div class="song-details-box">
						<h3>Song Details</h3>
						<ul>
							<li><strong>Genre:</strong><span>electro, drum & base, minimal</span></li>
							<li><strong>Tags:</strong><span>quitar, piano, music, electronic music, minimal, chill music, pop, cultural, live, popular</span></li>
							<li><strong>Instruments:</strong><span>quitar, piano, drums, bass</span></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-9">
					<div class="row">
						<div class="col-lg-6">
							<div class="song-details-box">
								<h3>About the Artist</h3>
								<div class="artist-details">
									<img src="img/artist.jpg" alt="">
									<div class="ad-text">
										<h5>Michael Smith</h5>
										<span>Artist/ Songwriter</span>
										<p>In the vast realm of music, few names shine as brightly as Michael Smith's. Hailing from New Jersey, this gifted songwriter and artist has left an indelible mark on the industry with his heartfelt lyrics and captivating melodies. </p>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="song-details-box">
								<h3>Song Details</h3>
								<!-- song -->
								<div class="song-item">
									<div class="row">
										<div class="col-xl-5 col-lg-12 col-md-5">
											<div class="song-info-box">
												<img src="img/songs/1.jpg" alt="">
												<div class="song-info">
													<h4>Jennifer Brown</h4>
													<p>One Night in Ibiza</p>
												</div>
											</div>
										</div>
										<div class="col-xl-7 col-lg-12 col-md-7">
											<div class="single_player_container">
												<div class="single_player">
													<div class="jp-jplayer jplayer" data-ancestor=".jp_container_1" data-url="music-files/1.mp3"></div>
													<div class="jp-audio jp_container_1" role="application" aria-label="media player">
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
														<div class="jp-no-solution">
															<span>Update Required</span>
															To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- song -->
								<div class="song-item">
									<div class="row">
										<div class="col-xl-5 col-lg-12 col-md-5">
											<div class="song-info-box">
												<img src="img/songs/2.jpg" alt="">
												<div class="song-info">
													<h4>Michael Smith</h4>
													<p>Dream in colors</p>
												</div>
											</div>
										</div>
										<div class="col-xl-7 col-lg-12 col-md-7">
											<div class="single_player_container">
												<div class="single_player">
													<div class="jp-jplayer jplayer" data-ancestor=".jp_container_2" data-url="music-files/2.mp3"></div>
													<div class="jp-audio jp_container_2" role="application" aria-label="media player">
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
														<div class="jp-no-solution">
															<span>Update Required</span>
															To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Songs details section -->
	
	<!-- Similar Songs section -->
	<section class="similar-songs-section">
		<div class="container-fluid">
			<h3>Similar Songs</h3>
			<div class="row">
				<div class="col-xl-3 col-sm-6">
					<div class="similar-song">
						<img class="ss-thumb" src="img/playlist/1.jpg" alt="">
						<h4>Jennifer Brown</h4>
						<p>One Night in Ibiza</p>
						<div class="single_player">
							<div class="jp-jplayer jplayer" data-ancestor=".jp_container_8" data-url="music-files/3.mp3"></div>
							<div class="jp-audio jp_container_8" role="application" aria-label="media player">
								<div class="jp-gui jp-interface">
									<!-- Player Controls -->
									<div class="ss-controls">
										<div class="songs-links">
											<a href=""><img src="img/icons/p-1.png" alt=""></a>
											<a href=""><img src="img/icons/p-2.png" alt=""></a>
											<a href=""><img src="img/icons/p-3.png" alt=""></a>
										</div>
										<div class="player_controls_box">
											<button class="jp-prev player_button" tabindex="0"></button>
											<button class="jp-play player_button" tabindex="0"></button>
											<button class="jp-next player_button" tabindex="0"></button>
											<button class="jp-stop player_button" tabindex="0"></button>
										</div>
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
								<div class="jp-no-solution">
									<span>Update Required</span>
									To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-sm-6">
					<div class="similar-song">
						<img class="ss-thumb" src="img/playlist/2.jpg" alt="">
						<h4>Jennifer Brown</h4>
						<p>One Night in Ibiza</p>
						<div class="single_player">
							<div class="jp-jplayer jplayer" data-ancestor=".jp_container_9" data-url="music-files/4.mp3"></div>
							<div class="jp-audio jp_container_9" role="application" aria-label="media player">
								<div class="jp-gui jp-interface">
									<!-- Player Controls -->
									<div class="ss-controls">
										<div class="songs-links">
											<a href=""><img src="img/icons/p-1.png" alt=""></a>
											<a href=""><img src="img/icons/p-2.png" alt=""></a>
											<a href=""><img src="img/icons/p-3.png" alt=""></a>
										</div>
										<div class="player_controls_box">
											<button class="jp-prev player_button" tabindex="0"></button>
											<button class="jp-play player_button" tabindex="0"></button>
											<button class="jp-next player_button" tabindex="0"></button>
											<button class="jp-stop player_button" tabindex="0"></button>
										</div>
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
								<div class="jp-no-solution">
									<span>Update Required</span>
									To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-sm-6">
					<div class="similar-song">
						<img class="ss-thumb" src="img/playlist/3.jpg" alt="">
						<h4>Jennifer Brown</h4>
						<p>One Night in Ibiza</p>
						<div class="single_player">
							<div class="jp-jplayer jplayer" data-ancestor=".jp_container_10" data-url="music-files/5.mp3"></div>
							<div class="jp-audio jp_container_10" role="application" aria-label="media player">
								<div class="jp-gui jp-interface">
									<!-- Player Controls -->
									<div class="ss-controls">
										<div class="songs-links">
											<a href=""><img src="img/icons/p-1.png" alt=""></a>
											<a href=""><img src="img/icons/p-2.png" alt=""></a>
											<a href=""><img src="img/icons/p-3.png" alt=""></a>
										</div>
										<div class="player_controls_box">
											<button class="jp-prev player_button" tabindex="0"></button>
											<button class="jp-play player_button" tabindex="0"></button>
											<button class="jp-next player_button" tabindex="0"></button>
											<button class="jp-stop player_button" tabindex="0"></button>
										</div>
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
								<div class="jp-no-solution">
									<span>Update Required</span>
									To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-sm-6">
					<div class="similar-song">
						<img class="ss-thumb" src="img/playlist/4.jpg" alt="">
						<h4>Jennifer Brown</h4>
						<p>One Night in Ibiza</p>
						<div class="single_player">
							<div class="jp-jplayer jplayer" data-ancestor=".jp_container_11" data-url="music-files/7.mp3"></div>
							<div class="jp-audio jp_container_11" role="application" aria-label="media player">
								<div class="jp-gui jp-interface">
									<!-- Player Controls -->
									<div class="ss-controls">
										<div class="songs-links">
											<a href=""><img src="img/icons/p-1.png" alt=""></a>
											<a href=""><img src="img/icons/p-2.png" alt=""></a>
											<a href=""><img src="img/icons/p-3.png" alt=""></a>
										</div>
										<div class="player_controls_box">
											<button class="jp-prev player_button" tabindex="0"></button>
											<button class="jp-play player_button" tabindex="0"></button>
											<button class="jp-next player_button" tabindex="0"></button>
											<button class="jp-stop player_button" tabindex="0"></button>
										</div>
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
								<div class="jp-no-solution">
									<span>Update Required</span>
									To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Similar Songs section end -->

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

	<!-- Audio Players js -->
	<script src="js/jquery.jplayer.min.js"></script>
	<script src="js/wavesurfer.min.js"></script>

	<!-- Audio Players Initialization -->
	<script src="js/WaveSurferInit.js"></script>
	<script src="js/jplayerInit.js"></script>

	</body>
</html>
