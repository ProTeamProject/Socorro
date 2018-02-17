<?php

  include_once '../includes/db.php';
  session_start();

  if (!isset($_SESSION['u_id'])) {
    header("Location: ../index.php");
    exit();
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Socorro</title>
</head>
<body>
  <?php
echo 'Problem ID: #';
$getId = $_GET['id'];
echo $getId;
  ?>
</body>
  </html>
