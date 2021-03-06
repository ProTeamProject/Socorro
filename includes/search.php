<?php
// Searchs the database for a given string

function search($text) {

  //Connect to database
  include 'db.php';

  // Filter text
  $text = htmlspecialchars($text);

  $sql = "SELECT Problem.Problem_ID, Employee.Caller_Name, Problem.Open_date, MAX(Problem_Status.Status_Date) As Status_Date, Problem_Type.Problem_Type_Name, Problem.state FROM Problem INNER JOIN Employee on Employee.Caller_ID = Problem.Caller_ID INNER JOIN Problem_Status on Problem_Status.Problem_ID = Problem.Problem_ID INNER JOIN Problem_Type on Problem_Type.Problem_Type_ID = Problem.Problem_Type_ID WHERE Employee.Caller_Name LIKE CONCAT('%', :name, '%') OR Problem.Problem_ID LIKE CONCAT('%', :name, '%') OR Problem_Type.Problem_Type_Name LIKE CONCAT('%', :name, '%') GROUP BY Problem.Problem_ID, Employee.Caller_Name, Problem.Open_date, Problem_Type.Problem_Type_Name, Problem.state";

  $stmt = $con->prepare($sql);
  $stmt->bindParam(':name', $text);
  $stmt->execute();

  $resultCheck = $stmt->rowCount();
  // Check if there are results
  if ($resultCheck < 1) {
    echo '<h2 style="color:black;">
    No Results Found
    </h2>';
  } else {
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      // Output
      echo '<a class="' . $row['state'] . '"href="/problem/index.php?id=' . $row['Problem_ID'] . '"><div class="problem__entry h-padding-small ' . $row['state']. ' id="problem_27"><p class="pid">#' . $row['Problem_ID'] . '</p><p class="caller__name">' . $row['Caller_Name'] . '</p><p class="date__created">' . date('jS F Y H:i', strtotime($row['Open_date'])) . '</p><p class="updated">' . date('jS F Y H:i', strtotime($row['Status_Date'])) . '</p><p class="problem__type">' . $row['Problem_Type_Name'] . '</p><div class="status__' . $row['state'] . '"><p class="status__text">' . $row['state'] . '</p></div></div></a>';
    }
  }

}
// Run search function
search($_GET['txt']);

 ?>
