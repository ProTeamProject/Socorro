<!-- edit the sql statement to return some information about the anayltics
then refer to the flowchart/database to work out what infomation needs to be retrieved
also http://socorro.co.uk/analytics
output to browser (echo)
-->
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
  $sql = "SELECT Problem.Problem_ID, Employee.Caller_Name, Problem.Open_Date, Problem.Problem_Type_ID, Problem.State FROM Problem, Employee WHERE Problem.Caller_ID = Employee.Caller_ID;";
  $result = mysqli_query($con, $sql);

  // Associative array
  while ($row = mysqli_fetch_assoc($result)) {
    echo $row['Problem_ID'] . " " . $row['Caller_Name'] . " " . $row['Open_Date'] . " " . $row['Problem_Type_ID'] . " " . $row['State'] . "<br />";
  }
//total problems


//$sql = "SELECT COUNT(open_date) FROM problem_table;";

//$date = new DateTime('2017-10-01');
//$date->add(new DateInterval('P10D'));
//echo $date->format('Y-m-d') . "\n";

$date = /*date('m');*/ "10";
echo $date;


//$result = mysqli_query($con, $sql);
//average time to close

/*
SELECT AVG(close_date) and AVG(open_date)
FROM problem_table
WHERE != NULL

if != NULL 
close_date - open_date as close_time ;
*/




  // Free result set
  mysqli_free_result($result);

  // Close the connection
  mysqli_close($con);

  ?>
  <h1>Total Problems for  <?php echo $month ?> : <?php echo $problemCount ?></h1>
  

</body>
</html>
