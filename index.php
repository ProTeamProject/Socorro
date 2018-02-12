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
  $sql = "SELECT problem.Problem_ID, employee.Caller_Name, problem.Open_date, problem_status.Status_Date, problem_type.problem_type_name, problem.state
FROM Problem
INNER JOIN employee on employee.Caller_ID = problem.Caller_ID
INNER JOIN problem_status on problem_status.Problem_ID = problem.Problem_ID
INNER JOIN problem_type on problem_type.Problem_Type_ID = problem.Problem_Type_ID
WHERE problem.state != 'closed' ORDER BY problem.Open_date desc";
  $sql2 = "SELECT problem.Problem_ID, employee.Caller_Name, problem.Open_date, problem_status.Status_Date, problem_type.problem_type_name, problem.state
FROM Problem
INNER JOIN employee on employee.Caller_ID = problem.Caller_ID
INNER JOIN problem_status on problem_status.Problem_ID = problem.Problem_ID
INNER JOIN problem_type on problem_type.Problem_Type_ID = problem.Problem_Type_ID
WHERE problem.state != 'closed' ORDER BY problem.Open_date asc";

  $result = mysqli_query($con, $sql);
  $result2 = mysqli_query($con, $sql2);

  // Associative array
  while ($row = mysqli_fetch_assoc($result)) {
    echo "<a href='/problem/index.php?id=".$row['Problem_ID']."'</a>" . " " . $row['Problem_ID'] . " " . $row['Caller_Name'] . " " . date('jS F Y H:i', strtotime($row['Open_date'])) . " " . date('jS F Y H:i', strtotime($row['Status_Date'])) . " " . $row['problem_type_name'] . " " . $row['state'] . "<br />";
  }
  //needs styling to o/utput the two different arrays apart
  while ($row = mysqli_fetch_assoc($result2)) {
    echo "<a href='/problem/index.php?id=".$row['Problem_ID']."'</a>" . " " . $row['Problem_ID'] . " " . $row['Caller_Name'] . " " . date('jS F Y H:i', strtotime($row['Open_date'])) . " " . date('jS F Y H:i', strtotime($row['Status_Date'])) . " " . $row['problem_type_name'] . " " . $row['state'] . "<br />";
  }
  // Free result set
  mysqli_free_result($result);

  // Close the connection
  mysqli_close($con);

  ?>
</body>
</html>
