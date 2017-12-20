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
  $sql = "SELECT Problem.Problem_ID, Employee.Caller_Name, Problem.Open_Date, Problem.Problem_Type_ID, Problem.State FROM Problem, Employee WHERE Problem.Caller_ID = Employee.Caller_ID;";
  $result = mysqli_query($con, $sql);

  // Associative array
  while ($row = mysqli_fetch_assoc($result)) {
    echo $row['Problem_ID'];
  }


  // Free result set
  mysqli_free_result($result);

  // Close the connection
  mysqli_close($con);
  ?>
</body>
</html>
