<?php include_once 'includes/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Socorro</title>
</head>
<body>
  <?php

  // Create sql statement and query
  $sql = "SELECT Problem_ID, caller_iD, Open_date, state FROM Problem WHERE state != 'closed' ORDER BY Open_date desc;";
  $sql2 = "SELECT Problem_ID, caller_iD, Open_date, state FROM Problem WHERE state != 'closed' ORDER BY Open_date asc;";
  $result = mysqli_query($con, $sql);
  $result2 = mysqli_query($con, $sql2);

  // Associative array
  while ($row = mysqli_fetch_assoc($result)) {
    echo $row['Problem_ID'] . " " . $row['caller_iD'] . " " . $row['Open_date'] . " " . $row['state'] . " " . $row['State'] . "<br />";
  }
  //needs styling to output the two different arrays apart
  while ($row = mysqli_fetch_assoc($result2)) {
    echo $row['Problem_ID'] . " " . $row['caller_iD'] . " " . $row['Open_date'] . " " . $row['state'] . " " . $row['State'] . "<br />";
  }

  // Free result set
  mysqli_free_result($result);

  // Close the connection
  mysqli_close($con);

  ?>
</body>
</html>
