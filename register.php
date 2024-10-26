<?php
$is_invalid = false;
$error_message = "";

$mysqli = require __DIR__ . "/database.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["login"])) {
        // Login logic
        $email = trim($_POST["email"]);
        $enteredPassword = $_POST["password"];

        $sql = "SELECT * FROM login WHERE email = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && $enteredPassword === $user["password"]) {
            session_start();
            session_regenerate_id();
            $_SESSION["user_id"] = $user["id"];

            // Redirect to the appropriate location after successful login
            header("Location: index.php"); // Make sure this is the correct path
            exit;
        } else {
            $is_invalid = true;
            $error_message = "Invalid email or password";
        }
        $stmt->close();
    } elseif (isset($_POST["register"])) {
        // Registration logic
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        $insert_sql = "INSERT INTO login (username, email, password) VALUES (?, ?, ?)";
        $stmt = $mysqli->prepare($insert_sql);

        if ($stmt) {
            $stmt->bind_param("sss", $username, $email, $password);
            $stmt->execute();

            // Redirect to the appropriate location after successful registration
            header("Location: index.php"); // Make sure this is the correct path
            exit;
        } else {
            // Handle insertion error
            $error_message = "Registration failed. Please try again later.";
        }
    }
}

?>
<!-- The rest of the login form HTML is the same as before -->


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SolMusic</title>
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">

			<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i&display=swap" rel="stylesheet">
 
 <!-- Stylesheets -->
 <link rel="stylesheet" href="css/bootstrap.min.css"/>
 <link rel="stylesheet" href="css/font-awesome.min.css"/>
 <link rel="stylesheet" href="css/owl.carousel.min.css"/>
 <link rel="stylesheet" href="css/slicknav.min.css"/>

 <!-- Main Stylesheets -->
 <link rel="stylesheet" href="css/style.css"/>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <style>

   

.hero-section {
  background: #0a183d;
}
   

.account-page {
  padding: 50px 0;
  display: flex;
  justify-content: center;
      align-items: center;
      margin-left: 450px;
     
 
}
.form-container {
  background: #fff;
  width: 300px;
  height: 400px;
  position: relative;
  text-align: center;
  padding: 20px 0;
  margin: auto;
  box-shadow: 0 0 20px 0px rgba(255, 0, 0, 0.7);
 overflow: hidden;
}
.form-container span {
  font-weight: bold;
  padding: 0 10px;
  color: #555;
cursor: pointer;
width: 100px;
display: inline-block;
}
.form-btn {
  display: inline-block;
  align-items: center;
}
.form-container form {
  max-width: 300px;
  padding: 0 20px;
  position: absolute;
  top: 130px;
  transition: transform 1s;
}
form input {
  width: 100%;
  height: 30px;
  margin: 10px 0;
  padding: 0 10px;
  border: 1px solid #ccc;
}
form .btn {
  width: 100%;
  border: none;
  cursor: pointer;
  margin: 10px 0;
}
form .btn:focus {
  outline: none;
}
#LoginForm {
  left: -300px;
}
#RegForm {
  left: 0px;
}
form a{
  font-size: 12px;
}
#Indicator {
  width: 100px;
  border: none;
  background: #ff523b;
  height: 3px;
  margin-top: 8px;
  transform: translateX(50px);
  transition: transform 1s;
}
.password-input {
        position: relative;
    }

    .password-input input {
        padding-right: 35px;
    }

    .password-toggle {
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
        cursor: pointer;
    }

  </style>
</head>
<body>

<div id="preloder">
		<div class="loader"></div>
	</div>

	<!-- Header section -->
	<?php
	include 'nav.php';
	?>

 

  <section class="hero-section">
  <div class="account-page">
    <div class="container">
        <div class="row">
          

            <div class="col-2">
                <div class="form-container">
                    <div class="form-btn">
                        <span onclick="login()">Login</span>
                        <span onclick="register()">Register</span>
                        <hr id="Indicator">
                    </div>

                  <form action="register.php" method="post" id="LoginForm">
                    <input name="email" type="email" placeholder="email" required>
                    <div class="password-input">
        <input name="password" type="password" placeholder="Password" required>
        <i class="fas fa-eye-slash password-toggle" onclick="togglePasswordVisibility(this)"></i>
    </div>
                    <button type="submit" class="btn" name="login">Login</button>
                   
                  </form>

                  <form action="signup.php" method="post" id="RegForm" >
                    <input name="username" type="text" placeholder="Username" required>
                    <input name="email" type="email" placeholder="Email" required >
                    <div class="password-input">
        <input name="password" type="password" placeholder="Password" required>
        <i class="fas fa-eye-slash password-toggle" onclick="togglePasswordVisibility(this)"></i>
    </div>
                    <button type="submit" class="btn" name="register">Register</button>
                   
                  </form>

                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.slicknav.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/mixitup.min.js"></script>
	<script src="js/main.js"></script>
  <script>
    var LoginForm = document.getElementById("LoginForm");
       var RegForm = document.getElementById("RegForm");
       var Indicator = document.getElementById("Indicator");

       function register() {

        RegForm.style.transform = "translateX(0px)";
        LoginForm.style.transform = "translateX(0px)";
        Indicator.style.transform = "translateX(100px)";
       }

       function login() {
        RegForm.style.transform = "translateX(300px)";
        LoginForm.style.transform = "translateX(300px)";
        Indicator.style.transform = "translateX(0px)";
       }

       function showLoginForm() {
        var RegForm = document.getElementById("RegForm");
        var LoginForm = document.getElementById("LoginForm");
        var Indicator = document.getElementById("Indicator");

        RegForm.style.transform = "translateX(300px)";
        LoginForm.style.transform = "translateX(0px)";
        Indicator.style.transform = "translateX(0px)";
    }
    function togglePasswordVisibility(iconElement) {
        var passwordInput = iconElement.previousElementSibling; // Get the previous sibling (password input)
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            iconElement.classList.remove("fa-eye-slash");
            iconElement.classList.add("fa-eye");
        } else {
            passwordInput.type = "password";
            iconElement.classList.remove("fa-eye");
            iconElement.classList.add("fa-eye-slash");
        }
    }


  </script>

<script>
    <?php if ($is_invalid): ?>
    var errorMessage = "<?php echo $error_message; ?>";
    alert(errorMessage);
    <?php endif; ?>
</script>

</body>
</html>
