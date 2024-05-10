<?php
session_start();
session_unset(); // Clear all session variables
session_destroy(); // Destroy the session

// Redirect to login page after logout
header("Location: index.php");
exit();
?>
