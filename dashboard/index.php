<?php

include_once '../includes/db.php';
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Socorro</title>
</head>
  <?php

  if (isset($_SESSION['u_type'])) {
    if ($_SESSION['u_type'] == 'operator') {
      $sql = "SELECT problem.Problem_ID, employee.Caller_Name, problem.Open_date, problem_status.Status_Date, problem_type.problem_type_name, problem.state
    FROM Problem
    LEFT JOIN employee on employee.Caller_ID = problem.Caller_ID
    LEFT JOIN problem_status on problem_status.Problem_ID = problem.Problem_ID
    LEFT JOIN problem_type on problem_type.Problem_Type_ID = problem.Problem_Type_ID ORDER BY problem.Open_date desc";
      $sql2 = "SELECT problem.Problem_ID, employee.Caller_Name, problem.Open_date, problem_status.Status_Date, problem_type.problem_type_name, problem.state
    FROM Problem
    LEFT JOIN employee on employee.Caller_ID = problem.Caller_ID
    LEFT JOIN problem_status on problem_status.Problem_ID = problem.Problem_ID
    LEFT JOIN problem_type on problem_type.Problem_Type_ID = problem.Problem_Type_ID
    WHERE problem.state != 'closed' ORDER BY problem.Open_date asc";

      $stmt = $con->prepare($sql);
      $stmt->bindParam(':output', $output, PDO::PARAM_INT);
      $stmt->execute();
      $stmt2 = $con->prepare($sql2);
      $stmt2->execute();
      echo 'most recent problems<br />';
      // Associative array
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          echo "<a href='/problem/index.php?id=".$row['Problem_ID']."'>" . " #" . $row['Problem_ID'] . " " . $row['Caller_Name'] . " " . date('jS F Y H:i', strtotime($row['Open_date'])) . " " . date('jS F Y H:i', strtotime($row['Status_Date'])) . " " . $row['problem_type_name'] . " " . $row['state'] . "</a><br />";
      }
      echo '<br />';
      echo 'longest unsolved problems<br />';
      //needs styling to o/utput the two different arrays apart
      while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {
          echo "<a href='/problem/index.php?id=".$row['Problem_ID']."'>" . " #" . $row['Problem_ID'] . " " . $row['Caller_Name'] . " " . date('jS F Y H:i', strtotime($row['Open_date'])) . " " . date('jS F Y H:i', strtotime($row['Status_Date'])) . " " . $row['problem_type_name'] . " " . $row['state'] . "</a><br />";
      }
    } else {
      echo 'specialist dashboard';
    }
  }

?>
</body>
</html>
