<?php include_once '../includes/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Socorro</title>
</head>
<body>
  <?php

    //total problems for current month

    //find current month
    $month = date('m', strtotime('-1 month'));;
    $sql = "SELECT COUNT(Open_Date) as count FROM Problem WHERE MONTH(Open_Date) = $month;";


// average time to close 
 

  $sql = "SELECT Close_Date, Open_Date FROM Problem WHERE Close_Date IS NOT NULL"; 
  $stmt = $con->prepare($sql); 
  $stmt->execute();
 while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

  <?php

include 'includes/db.php';

$sql = "SELECT TIMESTAMPDIFF(second, Open_Date, Close_Date) AS DateDiff FROM Problem WHERE Close_Date IS NOT NULL";
$stmt = $con->prepare($sql);
$stmt->execute();
$count = $stmt->rowCount();
$sum = 0;
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
  $sum += $row['DateDiff'];
}
$average = $sum/$count;
echo secondsToTime($average);

function secondsToTime($seconds) {
    $dtF = new \DateTime('@0');
    $dtT = new \DateTime("@$seconds");
    return $dtF->diff($dtT)->format('%a days, %h hours, %i minutes and %s seconds');
}


 }


//count open, close and pending 

{ 


$sql="SELECT state,count(state) as count FROM Problem WHERE state IN ('open','pending','closed') GROUP BY state"

   $stmt = $con->prepare($sql); 
    $stmt->execute();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) 

    }



//count software and hardware problems


{
  
$sql="SELECT Software_or_Hardware,count(Software_or_Hardware) as count FROM problem_type WHERE Software_or_Hardware IN (6,7) GROUP BY Software_or_Hardware"  

   $stmt = $con->prepare($sql); 
    $stmt->execute();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) 

    }


//retrieve the closure time 



  //only for current month 

$month = date('m', strtotime('-1 month'));;
    $sql = "SELECT COUNT(Open_Date) as count FROM Problem WHERE MONTH(Open_Date) = $month;"


   $stmt = $con->prepare($sql); 
    $stmt->execute();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) 



 //1. software closure time: 


//when Problem_Type_ID is 1,2,3,5 from problem, therefore it is a software problem. assign as 'software closure time', find close time for these only 

//hardware closure time:    

//when column name 'Problem_Type_ID' IS NOT 1,2,3,5 from problem, therefore it is a hardware problem. assign as 'hardware closure time', and then find close time for these only 
 

//2. Count each problem type in software 

    //count problem_ID from equipment_problem table

//count problem_ID from software_problem table 


    //query sql database
    $result = mysqli_query($con, $sql);

    //return count
    while ($row = mysqli_fetch_assoc($result)) {
      $problemCount = $row['count'];
    }

    // Free result set
    mysqli_free_result($result);

    // Close the connection
    mysqli_close($con);

  ?>

  <h1>Total Problems for  <?php echo $text = date("F", strtotime("2001-" . $month . "-01")); ?> : <?php echo $problemCount ?></h1>


</body>
</html>
