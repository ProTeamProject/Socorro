<?php

// Adds a new status to a specific problem id

session_start();

if (isset($_POST['submit'])) {

  // Connect to database
  include 'db.php';

  $pid = $_GET['id'];
  $uid = $_SESSION['u_id'];
  $type = $_POST['type'];
  $cid = $_POST['cid'];
  $comment = $_POST['comment'];
  $solved = $_POST['solved'];
  $solution = $_POST['solution'];

  // If status type is a call
  if ($type == 'Call') {
    // Insert as call
    $sql = "INSERT INTO Problem_Status (Problem_ID, Status_ID, Comment, Account_ID, Status_Date, Caller_ID) VALUES (:id, 1, :comment, :uid, :status_date, :cid)";
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':cid', $cid);
  } else {
    // Insert as note
    $sql = "INSERT INTO Problem_Status (Problem_ID, Status_ID, Comment, Account_ID, Status_Date, Caller_ID) VALUES (:id, 5, :comment, :uid, :status_date, 0)";
    $stmt = $con->prepare($sql);
  }

  $stmt->bindParam(':id', $pid);
  $stmt->bindParam(':comment', $comment);
  $stmt->bindParam(':uid', $uid);
  $date_status = date("Y-m-d H:i:s");
  $stmt->bindParam(':status_date', $date_status);
  $stmt->execute();


  // If problem is solved
  if ($solved == 1) {
    //Add solution
    $sql_solution = "INSERT INTO Solution (Solution_Desc, Solution_Counter) VALUES (:solution, 1)";
    $stmt = $con->prepare($sql_solution);
    $stmt->bindParam(':solution', $solution);
    $stmt->execute();

    //Assign solution to problem
    $sql_solution2 = "INSERT INTO Solution_Problem (Solution_ID, Problem_ID) VALUES (LAST_INSERT_ID(), :pid)";
    $stmt2 = $con->prepare($sql_solution2);
    $stmt2->bindParam(':pid', $pid);
    $stmt2->execute();

    //Mark problem as closed
    $sql_close = "UPDATE Problem SET State = 'closed', Close_Date = :date_close WHERE Problem_ID = :pid;";
    $stmt3 = $con->prepare($sql_close);
    $date_close = date("Y-m-d H:i:s");
    $stmt3->bindParam(':date_close', $date_close);
    $stmt3->bindParam(':pid', $pid);
    $stmt3->execute();

    //Post closed status
    $sql = "INSERT INTO Problem_Status (Problem_ID, Status_ID, Comment, Account_ID, Status_Date, Caller_ID) VALUES (:id, 3, :comment, :uid, :status_date, 0)";
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':id', $pid);
    $solution_text = 'Problem closed with solution: ' . $solution;
    $stmt->bindParam(':comment', $solution_text);
    $stmt->bindParam(':uid', $uid);
    $second = date("s");
    $second += 1;
    $stmt->bindParam(':status_date', date("Y-m-d H:i:$second"));
    $stmt->execute();

    //Update specialist analytics
      //Retrieve number solved, average time

  }



  //return to page before you added status
  header('Location: ' . $_SERVER['HTTP_REFERER']);
  exit();

}
?>
