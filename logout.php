<?php
session_start();
echo "Logging out..."; // Debugging statement
session_destroy();
header("Location: index.php");
exit();
?>