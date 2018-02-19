<?php

// Logs the user out on button click

  // Destroy session
  session_start();
  session_destroy();
  // Return user to login
  header("Location: ../index.php");
  exit();


?>
