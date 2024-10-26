

<style>
.nav-item{
	color: #fff;
}
</style>


<header class="header-section clearfix">
		<a href="index.php" class="site-logo">
			<img src="img/logo.png" alt="">
		</a>
		<div class="header-right">

			
			<?php if (isset($_SESSION['user_id'])) { ?>
				<li><a href="logout.php">logout</a></li>
                           
                        
						
					 
                           
                                
                                
                           
                        </li>
						<?php } else { ?>
			<div class="user-panel">
				<a href="register.php" class="login">Login</a>
				<span>|</span>
				<a href="signup.php" class="register">Create an account</a>
			</div> 
			<?php } ?>
		</div>
		<ul class="main-menu">
		
		<?php if (isset($_SESSION['user_id'])) { ?>
                        <li class="nav-item">
                            <span class="nav-link">Welcome, <?php echo $user['username']; ?>!</span>
                        </li>
						<?php } ?>
			<li><a href="index.php">Home</a></li>
			
			<li><a href="#">Category</a>
				<ul class="sub-menu">
					<li><a href="music.php">All Music</a></li>
					<li><a href="playlist.php">Playlists</a></li>
					<li><a href="artist.php">Artists</a></li>
					
				</ul>
			</li>
			<li><a href="blog.php">Blog</a></li>
			<li><a href="contact.php">Contact</a></li>
		</ul>
	</header>
