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

    //count number of problems
    $sql = "SELECT COUNT(Open_Date) as count FROM Problem WHERE MONTH(Open_Date) = $month;";

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
