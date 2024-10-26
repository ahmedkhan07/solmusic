<?php
session_start();

// Destroy the session
session_destroy();

// Redirect to the login page (index.php in this case)
header("Location: index.php");
exit();
?>
