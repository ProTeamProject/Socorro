<?php include_once 'includes/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Socorro</title>
</head>

<form action='phpscript' method="post">
Problem_ID: <input type="int" name="Problem ID">
<br>
Operator_Account_ID: <input type="int" name="Operator Account ID"> <!-- this part can be auto ammended -->
<br>
Specialist_Account_ID: <input type="int" name="Specialist Account ID">
<br>
Caller_ID: <input type="text" name="Caller ID">
<br>
Problem_Desc: <input type="text" name ="Problem description">
<br>
Close_Date: <input type="date" name = "Closing Date">
<br>
Problem_Type_ID: <input type="int" name = "Problem Type ID">
<br>
State: <select>
  <option value="Open">open</option>
  <option value="Closed">closed</option>
  <option value="Pending">pending</option>
</select>
<br>
Open_Date: <input type="date" name="Open Date">
<?php

 $stmt = $con->prepare("INSERT INTO problem (Problem_ID, Operator_Account_ID, Specialist_Account_ID, Caller_ID,
 Problem_Desc, Close_Date, Problem_Type_ID,State,Open_Date, Close_Date");

 $stmt->bindParam(':problem_ID',$Problem_ID);
 $stmt->bindParam(':Operator_Account_ID',$Operator_Account_ID);
 $stmt->bindParam(':Specialist_Account_ID', $Specialist_Account_ID);
 $stmt->bindParam(':Caller_ID', $Caller_ID);
 $stmt->bindParam(':Problem_Desc', $Problem_Desc);
 $stmt->bindParam(':Close_Date', $Close_Date);
 $stmt->bindParam(':Problem_Type_ID', $Problem_Type_ID);
 $stmt->bindParam(':State', $State);
 $stmt->bindParam(':Open_Date', $Open_date);
?>
</body>
</html>
