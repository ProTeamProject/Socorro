<?php include_once '../includes/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Socorro</title>
</head>
<body>
  <?php

  //$problem_id = $_GET['id'];

  $problem_id = '1';

  // Create sql statement and query


  $sql_Desc = "SELECT Problem_Desc, Problem_ID, State FROM Problem WHERE Problem_ID LIKE $problem_id;";

  $sql_Status = "SELECT Comment, Account_ID, Status_Date FROM Problem_Status WHERE Problem_ID LIKE $problem_id ORDER BY Status_Date DESC;";

  $sql_Type = "SELECT Problem_Type_Name FROM Problem_Type WHERE Problem_Type_ID LIKE(SELECT Problem_Type_ID FROM Problem WHERE Problem_ID LIKE $problem_id);";

  $sql_Serial = "SELECT Equipment_Serial_Number FROM Equipment_Problem WHERE Problem_ID LIKE (SELECT Problem_ID FROM Problem WHERE Problem_ID LIKE $problem_id);";

  $sql_OS = "SELECT Operating_System FROM Software_Problem WHERE Problem_ID LIKE(SELECT Problem_ID FROM Problem WHERE Problem_ID LIKE $problem_id);";

  $sql_Software = "SELECT Software_Name FROM Software WHERE Software_License_Number LIKE(SELECT Software_License_Number FROM Software_Problem WHERE Problem_ID LIKE $problem_id);";

  $sql_Hardware= "SELECT Equipment_Name FROM Equipment_Register WHERE Equipment_Name LIKE (SELECT Equipment_Name FROM Equipment WHERE Equipment_Serial_Number LIKE (SELECT Equipment_Serial_Number FROM Equipment_Problem WHERE Problem_ID LIKE $problem_id));";

  $sql_Operator = "SELECT Name FROM Account WHERE Account_ID LIKE (SELECT Operator_Account_ID FROM Problem WHERE Problem_ID LIKE $problem_id);";

  $sql_Specialist = "SELECT Name FROM Account WHERE Account_ID LIKE (SELECT Specialist_Account_ID FROM Problem WHERE Problem_ID LIKE $problem_id);";

  $result_Desc = mysqli_query($con, $sql_Desc);
  $result_Status = mysqli_query($con, $sql_Status);
  $result_Type  = mysqli_query($con, $sql_Type);
  $result_Serial  = mysqli_query($con, $sql_Serial);
  $result_OS  = mysqli_query($con, $sql_OS);
  $result_Software  = mysqli_query($con, $sql_Software);
  $result_Hardware  = mysqli_query($con, $sql_Hardware);
  $result_Operator  = mysqli_query($con, $sql_Operator);
  $result_Specialist  = mysqli_query($con, $sql_Specialist);

  //$row = mysqli_fetch_array($result_Status)
  //$last_updated = $row['Status_Date'];
  while ($row = mysqli_fetch_assoc($result_Desc)) {
    echo "Problem ID: #" . $row['Problem_ID'] . " " . $row['State'] . " Last Updated: " . "</br>" . $row['Problem_Desc'] . "</br>";
  }
  while ($row = mysqli_fetch_assoc($result_Type)) {
    echo $row['Problem_Type_Name'] . "</br>";
  }
  while ($row = mysqli_fetch_assoc($result_Status)) {
    echo $row['Comment'] . " " . $row['Account_ID'] . " " . $row['Status_Date'] . "</br>";
  }
  while ($row = mysqli_fetch_assoc($result_Serial)) {
    echo $row['Equipment_Serial_Number']. "</br>";
  }
  while ($row = mysqli_fetch_assoc($sql_OS)) {
    echo $row['Operating_System']. "</br>";
  }
  while ($row = mysqli_fetch_assoc($result_Software)) {
    echo $row['Software_Name']. "</br>";
  }
  while ($row = mysqli_fetch_assoc($result_Hardware)) {
    echo $row['Equipment_Name']. "</br>";
  }
  while ($row = mysqli_fetch_assoc($result_Operator)) {
    echo $row['Name']. "</br>";
  }
  while ($row = mysqli_fetch_assoc($result_Specialist)) {
    echo $row['Name']. "</br>";
  }

  // Free result set
  mysqli_free_result($result_Desc);
  mysqli_free_result($result_Type);
  mysqli_free_result($result_Serial);
  mysqli_free_result($result_OS);
  mysqli_free_result($result_Software);
  mysqli_free_result($result_Hardware);
  mysqli_free_result($result_Operator);
  mysqli_free_result($result_Specialist);


  // Close the connection
  mysqli_close($con);

  ?>

</body>
</html>
