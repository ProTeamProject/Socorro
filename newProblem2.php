<?php include_once 'includes/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Socorro</title>
</head>

<form action='phpscript' method="post">
Caller Name:<input type="text" name="caller name"/>;
<br>
Problem Description <input type="text" name="problem description"/>;
<br>
Problem Type  <select>
  <?php>
      while ($row = $stmt3->fetch(PDO::FETCH_ASSOC)) {
      echo '<option value=' .$row["Problem_type"] . "</option">;
      }
  ?>
              </select>
Serial Number <input type="text" name ="Serial Number"/>
<br>
Operating System <select>
                <option value="Windows 10">Windows 10</option>;
                <option value="Macintosh">Macintosh</option>;
                <option value="Linux">Linux</option>;
                </select>
                <br>

                <br>
software      <input type="text" name="software"/>
<br>
hardware      <input type="text" name="hardware"/>
<br>

opening status   <input type="text" name ="Opening Status"/>

<?php

 $stmt = $con->prepare("INSERT INTO problem (Problem_ID, Operator_Account_ID, Specialist_Account_ID, Caller_ID,
 Problem_Desc, Close_Date, Problem_Type_ID,State,Open_Date)
 VALUES (:problem_ID,:Operator_Account_ID,:Specialist_Account_ID,
 :Caller_ID,:Problem_Desc,:Close_Date,:Problem_Type_ID,:State,:Open_Date)");

  $stmt2 = $con->prepare("INSERT INTO equipment_problem (problem_ID, Equipment_Serial_Number)
  VALUES (:problem_ID,:Equipment_Serial_Number)");
  $stmt3 = $con->prepare("SELECT Problem_type_Name From Problem_type");
  $stmt4 = $con->prepare("INSERT INTO problem_status (problem_status_ID,Problem_ID,Status_ID,
  Comment,Account_ID,Status_Date) VALUES (:problem_status_ID,:problem_ID,:Status_ID,:Comment,
  :Account_ID,:Status_Date) ");

 $stmt->bindParam(':problem_ID',$Problem_ID);
 $stmt2->bindParam(':problem_ID',$Problem_ID);
 $stmt2->bindParam(':Equipment_Serial_Number',$Equipment_Serial_Number);
 $stmt->bindParam(':Operator_Account_ID',$Operator_Account_ID);
 $stmt->bindParam(':Specialist_Account_ID', $Specialist_Account_ID);
 $stmt->bindParam(':Caller_ID', $Caller_ID);
 $stmt->bindParam(':Problem_Desc', $Problem_Desc);
 $stmt->bindParam(':Close_Date', $Close_Date);
 $stmt->bindParam(':Problem_Type_ID', $Problem_Type_ID);
 $stmt->bindParam(':State', $State);
 $stmt->bindParam(':Open_Date', $Open_date);
 $stmt4->bindParam(':problem_status_ID',$Problem_Type_ID);
 $stmt4->bindParam(':problem_ID',$Problem_ID);
 $stmt4->bindParam(':Status_ID',$Status_ID);
 $stmt4->bindParam(':Comment',$Comment);
 $stmt4->bindParam(':Account_ID',$Account_ID);
 $stmt4->bindParam(':Status_Date',$Status_Date);

?>
</body>
</html>
