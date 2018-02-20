<?php


function specialistInfo($text) {
  //Connect to database
  include 'db.php';

  $sql7 = "SELECT Average_Time, Number_Solved, Problems_Assigned, Busy FROM Specialist WHERE Account_ID = :sid"; //Breakdown of individual specialist
  $stmt7 = $con->prepare($sql7);
  $stmt7->bindParam(':sid', $text, PDO::PARAM_INT);
  $stmt7->execute();
  $result7 = $stmt7->fetch(PDO::FETCH_ASSOC);
  $resultCheck = $stmt7->rowCount();
  if ($resultCheck < 1) {

  } else {
  echo 'Average time to solve a problem: ' . $result7['Average_Time'] . ' hours <br />' .  'Total number of problems solved: ' . $result7['Number_Solved'] . '<br />' . 'Number of problems currently assigned: ' . $result7['Problems_Assigned'] . '<br />' . 'Busy status: ' . $result7['Busy'] . '<br /> ';
}
}

specialistInfo($_GET['txt']);





 ?>
