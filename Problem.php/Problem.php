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
  $sql_Desc = "SELECT Problem_Desc FROM Problem WHERE Problem_ID LIKE 1;";

  $sql_Type = "SELECT Problem_Type_Name FROM Problem_Type WHERE Problem_Type_ID LIKE(SELECT Problem_Type_ID FROM Problem WHERE Problem_ID LIKE 1);";

  $sql_Serial = "SELECT Equipment_Serial_Number FROM Equipment_Problem WHERE Problem_ID LIKE (SELECT Problem_ID FROM Problem WHERE Problem_ID LIKE 1);";

  $sql_OS = "SELECT Operating_System FROM Software_Problem WHERE Problem_ID LIKE(SELECT Problem_ID FROM Problem WHERE Problem_ID LIKE 1);";

  $sql_Software = "SELECT Operating_System FROM Software_Problem WHERE Problem_ID LIKE(SELECT Problem_ID FROM Problem WHERE Problem_ID LIKE 1);";

  $sql_Hardware= "SELECT Equipment_Name FROM Equipment_Register WHERE Equipment_NameLIKE (SELECT Equipment_Name FROM Equipment WHEREEquipment_Serial_Number LIKE (SELECT Equipment_Serial_Number FROMEquipment_Problem WHERE Problem_ID LIKE 1));";

  $sql_Operator = "SELECT Name FROM Account WHERE Account_ID LIKE (SELECTOperator_Account_ID FROM Problem WHERE Problem_ID LIKE 1);";
  
  ]$sql_Specialist = "SELECT Name FROM Account WHERE Account_ID LIKE (SELECTSpecialist_Account_ID FROM Problem WHERE Problem_ID LIKE 1);";

  $result_Desc = mysqli_query($con, $sql_Desc);
  $result_Type  = mysqli_query($con, $sql_Type);
  $result_Serial  = mysqli_query($con, $sql_Serial);
  $result_OS  = mysqli_query($con, $sql_OS);
  $result_Software  = mysqli_query($con, $sql_Software);
  $result_Hardware  = mysqli_query($con, $sql_Hardware);
  $result_Operator  = mysqli_query($con, $sql_Operator);
  $result_Specialist  = mysqli_query($con, $sql_Specialist);

  echo "$result_Desc";
  echo "$result_Type";
  echo "$result_Serial";
  echo "$result_OS";
  echo "$result_Software";
  echo "$result_Hardware";
  echo "$result_Operator";
  echo "$result_Specialist";

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