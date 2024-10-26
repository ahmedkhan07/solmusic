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


try {
    $pdo = new PDO('mysql:host=localhost;dbname=sound', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch data from the database
    $stmt = $pdo->query("SELECT id, description FROM subscription_chart");
    $chartData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $pdo = null;
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!-- CSS Files -->
    <link href="bootstrap.min.css" rel="stylesheet" />
    <link href="now-ui-dashboard.css?v=1.5.0" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="demo.css" rel="stylesheet" />
   
 
	<!-- Stylesheets -->
	
	<link rel="stylesheet" href="css/font-awesome.min.css"/>
	<link rel="stylesheet" href="css/owl.carousel.min.css"/>
	<link rel="stylesheet" href="css/slicknav.min.css"/>

	<!-- Main Stylesheets -->
	<link rel="stylesheet" href="css/style.css"/>
    

 
</head>
<body>
<?php
	include 'nav.php';
	?>
  <div  class="content">
    <div class="row">
      <div class="col-md-8 ml-auto mr-auto">
    <div class="card card-upgrade">
        <div class="card-header text-center">
          <h4 class="card-title">SolMusic premium subscription</h3>
            <p class="card-category">Are you looking for more components? Please check our Premium Version of Now UI Dashboard PRO.</p>
        </div>
        <div class="card-body">
          <div class="table-responsive table-upgrade">
            <table class="table">
              <thead>
                <th></th>
                <th class="text-center">Free</th>
                <th class="text-center">PRO</th>
              </thead>
              <tbody>
                
              <?php foreach ($chartData as $data) { ?>
<tr>
<td contenteditable="true" data-id="<?php echo $data['id']; ?>"><?php echo $data['description']; ?></td>
  <td class="text-center"><i class="fas fa-times text-danger"></i></td>
  <td class="text-center"><i class="fas fa-check text-success"></i></td>
  <td class="text-center"><i class="fas fa-star text-warning"></i></td>
</tr>
<?php } ?>
                <tr>
                  <td></td>
                  <td class="text-center">Free</td>
                  <td class="text-center">Just $49</td>
                </tr>
                <tr>
                  <td class="text-center"></td>
                  <td class="text-center">
                    <a href="#" class="btn btn-round btn-default disabled">Current Version</a>
                  </td>
                  <td class="text-center">
                    <a target="_blank" href="#" class="btn btn-round btn-primary">Upgrade to PRO</a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
	include 'footer.php';
	?>
</body>
</html>