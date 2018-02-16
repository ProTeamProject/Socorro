<?php include_once 'includes/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Socorro</title>
</head>
<input type="submit" class="button" name="insert" onlcick = outputIncrease()/>;
  <?php
  $output = 1;
  // Create sql statement and query
  function outputIncrease(){
    $output = $output + 1;
      $stmt->execute();
  }

  $sql = "SELECT problem.Problem_ID, employee.Caller_Name, problem.Open_date, problem_status.Status_Date, problem_type.problem_type_name, problem.state
FROM Problem
INNER JOIN employee on employee.Caller_ID = problem.Caller_ID
INNER JOIN problem_status on problem_status.Problem_ID = problem.Problem_ID
INNER JOIN problem_type on problem_type.Problem_Type_ID = problem.Problem_Type_ID
WHERE problem.state != 'closed' ORDER BY problem.Open_date desc
LIMIT :output;";
  $sql2 = "SELECT problem.Problem_ID, employee.Caller_Name, problem.Open_date, problem_status.Status_Date, problem_type.problem_type_name, problem.state
FROM Problem
INNER JOIN employee on employee.Caller_ID = problem.Caller_ID
INNER JOIN problem_status on problem_status.Problem_ID = problem.Problem_ID
INNER JOIN problem_type on problem_type.Problem_Type_ID = problem.Problem_Type_ID
WHERE problem.state != 'closed' ORDER BY problem.Open_date asc";

  $stmt = $con->prepare($sql);
  $stmt->bindParam(':output', $output);
$stmt->execute();
  $stmt2 = $con->prepare($sql2);
  $stmt2->execute();



  // Associative array
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<a href='/problem/index.php?id=".$row['Problem_ID']."'>" . " " . $row['Problem_ID'] . " " . $row['Caller_Name'] . " " . date('jS F Y H:i', strtotime($row['Open_date'])) . " " . date('jS F Y H:i', strtotime($row['Status_Date'])) . " " . $row['problem_type_name'] . " " . $row['state'] . "></a><br />";
  }
  //needs styling to o/utput the two different arrays apart
  while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {
    echo "<a href='/problem/index.php?id=".$row['Problem_ID']."'>" . " " . $row['Problem_ID'] . " " . $row['Caller_Name'] . " " . date('jS F Y H:i', strtotime($row['Open_date'])) . " " . date('jS F Y H:i', strtotime($row['Status_Date'])) . " " . $row['problem_type_name'] . " " . $row['state'] . "</a><br />";
  }


  echo $output;
?>


</body>
</html>
