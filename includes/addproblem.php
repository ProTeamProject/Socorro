<?php

// Allows operators to add new problems from the new problem page
session_start();

if (isset($_POST['submit'])) {

  // Connect to database
  include 'db.php';

  //session variables
  $uid = $_SESSION['u_id'];

  $pid = $_GET['id'];

  $opendate = date("Y-m-d H:i:s");

  $name = $_POST['caller-name'];
  $cid = $_POST['caller-id'];
  $pdesc = $_POST['problem-desc'];
  $type = $_POST['problem-type'];

  //new problem type
  $checkbox = $_POST['check-new-problem-type'];
  $parent = $_POST['parent-problem-type'];
  $newtype = $_POST['new-problem-type'];

  //other
  $softwareno = $_POST['software'];
  $hardwareno = $_POST['hardware'];
  $os = $_POST['os'];
  $osVersion = $_POST['os-ver'];
  $solved = $_POST['solved'];
  $solution = $_POST['solution'];
  $status = $_POST['status'];
  $sid = $_POST['specialist'];
  $assignstatus = 'Problem assigned';

  //check if new problem type is checked
  if ($checkbox == 1) {
    //get parent problems type
    $sql = "SELECT Software_Or_Hardware FROM Problem_Type WHERE Problem_Type_ID = :parent";
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':parent', $parent);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $parenttype = $row['Software_Or_Hardware'];
    //insert new problem type into database
    $sql = "INSERT INTO Problem_Type (Problem_Type_Name, Parent_Problem_ID, Software_Or_Hardware) VALUES (:newtype, :parent, :parenttype)";
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':newtype', $newtype);
    $stmt->bindParam(':parent', $parent);
    $stmt->bindParam(':parenttype', $parenttype);
    $stmt->execute();
    //assign selected specialist to new problem type
    $sql = "INSERT INTO Problem_Type_Specialist (Problem_Type_ID, Account_ID) VALUES (LAST_INSERT_ID(), :sid)";
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':sid', $sid);
    $stmt->execute();
    //change type
    $sql = "SELECT Problem_Type_ID FROM Problem_Type WHERE Problem_Type_Name = :problemtype";
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':problemtype', $newtype, PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $parenttype = $row['Problem_Type_ID'];
    $type = $parenttype;
  }


  //retrieve specialist data to update
  $sql = "SELECT Busy, Average_Time, Number_Solved, Problems_Assigned, email FROM Specialist WHERE Account_ID = :sid;";
  $stmt2 = $con->prepare($sql);
  $stmt2->bindParam(':sid', $sid);
  $stmt2->execute();
  $row_specialist_data = $stmt2->fetch(PDO::FETCH_ASSOC);

  //check if assigned specialist is busy
  if ($row_specialist_data['Busy'] == 1) {
    //set state to open or pending
    $state = 'pending';
  } else {
    $state = 'open';
  }


  //insert problem into database
  $sql = "INSERT INTO Problem (Operator_Account_ID, Specialist_Account_ID, Caller_ID, Problem_Desc, Problem_Type_ID, State, Open_Date, Close_Date) VALUES (:uid, :sid, :cid, :pdesc, :type, :state, :opendate, NULL)";
  $stmt = $con->prepare($sql);
  $stmt->bindParam(':uid', $uid);
  $stmt->bindParam(':sid', $sid);
  $stmt->bindParam(':cid', $cid);
  $stmt->bindParam(':state', $state);
  $stmt->bindParam(':pdesc', $pdesc);
  $stmt->bindParam(':type', $type);
  $stmt->bindParam(':opendate', $opendate);
  $stmt->execute();

  $sql = "INSERT INTO Software_Problem (Problem_ID, Software_License_Number, Operating_System) VALUES (:pid, :softwareno, :os)";
  $stmt = $con->prepare($sql);
  $stmt->bindParam(':softwareno', $softwareno);
  $operatingsystem = $os . ' ' . $osVersion;
  $stmt->bindParam(':os', $operatingsystem);
  $stmt->bindParam(':pid', $pid);
  $stmt->execute();

  $sql = "INSERT INTO Equipment_Problem (Problem_ID, Equipment_Serial_Number) VALUES (:pid, :hardwareno)";
  $stmt = $con->prepare($sql);
  $stmt->bindParam(':hardwareno', $hardwareno);
  $stmt->bindParam(':pid', $pid);
  $stmt->execute();

  //post opening status
  $sql = "INSERT INTO Problem_Status (Problem_ID, Status_ID, Comment, Account_ID, Status_Date, Caller_ID) VALUES (:pid, 2, :comment, :uid, :status_date, :cid)";
  $stmt = $con->prepare($sql);
  $stmt->bindParam(':cid', $cid);
  $stmt->bindParam(':uid', $uid);
  $stmt->bindParam(':comment', $status);
  $stmt->bindParam(':pid', $pid);
  $date = date("Y-m-d H:i:s");
  $stmt->bindParam(':status_date', $date);
  $stmt->execute();

  //post assign status
  $sql = "INSERT INTO Problem_Status (Problem_ID, Status_ID, Comment, Account_ID, Status_Date, Caller_ID) VALUES (:pid, 4, :comment, :uid, :status_date, :cid)";
  $stmt = $con->prepare($sql);
  $stmt->bindParam(':cid', $cid);
  $stmt->bindParam(':uid', $uid);
  $stmt->bindParam(':comment', $assignstatus);
  $stmt->bindParam(':pid', $pid);
  $date = date("Y-m-d H:i:s");
  $stmt->bindParam(':status_date', $date);
  $stmt->execute();

  //email specialist with link
  include 'email.php';
  $to = $row_specialist_data['email'];
  $subject = 'You have a new Problem assigned!';
  $headers  = "From: testsite < mail@testsite.com >\n";
  $headers .= "Cc: testsite < mail@testsite.com >\n";
  $headers .= "X-Sender: testsite < mail@testsite.com >\n";
  $headers .= 'X-Mailer: PHP/' . phpversion();
  $headers .= "X-Priority: 1\n"; // Urgent message!
  $headers .= "Return-Path: mail@testsite.com\n"; // Return path for errors
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/html; charset=iso-8859-1\n";
  mail($to, $subject, $message, $headers);

  //update specialist details

  //check if solved is checked
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
    $stmt->bindParam(':status_date', date("Y-m-d H:i:s"));
    $stmt->execute();

    //update specialist details
  }

  //redirect to new problem page
  header('Location: ../problem/index.php?id=' . $pid);
  exit();

  //live stuff
  //output full list of specialists with their problem types listed
  //query database to check if serial numbers are valid
  //hide problem type when new problem type selected

}

?>
