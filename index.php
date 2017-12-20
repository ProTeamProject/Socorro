<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Socorro</title>
</head>
<body>
  <?php
  // Initialise credentials
  $mysql_host = 'localhost';
  $mysql_user = 'root';
  $mysql_pass = 'proteam';
  $mysql_db = 'sc-web';

  // Create connection
  $con = mysqli_connect($mysql_host, $mysql_user, $mysql_pass, $mysql_db);

  // Create sql statement and query
  $sql = 'SELECT Problem.Problem_ID, Employee.Caller_Name, Problem.Open_Date, Problem.Problem_Type_ID, Problem.State FROM Problem, Employee WHERE Problem.Caller_ID = Employee.Caller_ID';
  $result = mysqli_query($con, $sql);

  // Associative array
  $row = mysqli_fetch_assoc($result);
  printf ("%s (%s)\n", $row["Problem_ID"], $row["Caller_Name"], $row["Open_Date"], $row["Problem_Type_ID"], $row["State"]);

  // Free result set
  mysqli_free_result($result);

  // Close the connection
  mysqli_close($con);
  ?>
</body>
</html>
