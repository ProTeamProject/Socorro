<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Socorro</title>
</head>
<body>
  <?php
  $mysql_host = 'localhost';
  $mysql_user = 'root';
  $mysql_pass = 'proteam';
  $mysql_db = 'sc-web';

  // Create connection
  $con = mysqli_connect($mysql_host, $mysql_user, $mysql_pass, $mysql_db);

  // Check connection
  if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

  // Close the connection
  mysqli_close($con);
  ?>
</body>
</html>
