<?php
session_start();

// Destroy the session
session_destroy();

// Redirect to the login page with an error message
header("Location:index.php");
?>