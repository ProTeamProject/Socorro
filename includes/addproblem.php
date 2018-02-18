<?php

session_start();

if (isset($_POST['submit'])) {

  // Connect to database
  include 'db.php';

  echo "done";

}

?>
