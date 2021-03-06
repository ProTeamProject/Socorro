<?php
// Allows specialists to accept problem
session_start();

if (isset($_POST['submit'])) {

  // Connect to database
  include 'db.php';

  // Retrieve variables
  $pid = $_GET['pid'];
  $uid = $_SESSION['u_id'];
  $uname = $_SESSION['u_name'];

  // Set problem state to open
  $sql = "UPDATE Problem SET State = 'open' WHERE Problem_ID = :pid";
  $stmt = $con->prepare($sql);
  $stmt->bindParam(':pid', $pid);
  $stmt->execute();

  $comment = $uname . " accepted the problem";
  // Post accepted status
  $sql = "INSERT INTO Problem_Status (Problem_ID, Status_ID, Comment, Account_ID, Status_Date, Caller_ID) VALUES (:id, 5, :comment, :uid, :status_date, 0)";
  $stmt = $con->prepare($sql);
  $stmt->bindParam(':id', $pid);
  $stmt->bindParam(':comment', $comment);
  $stmt->bindParam(':uid', $uid);
  $date_status = date("Y-m-d h:i:s");
  $stmt->bindParam(':status_date', $date_status);
  $stmt->execute();

  // Return to previous page
  header('Location: ' . $_SERVER['HTTP_REFERER']);
  exit();

}

?>
