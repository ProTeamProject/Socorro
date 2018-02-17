<?php

session_start();

if (isset($_POST['submit'])) {

  // Connect to database
  include 'db.php';

  $busy = $_POST['busy'];
  $uid = $_SESSION['u_id'];

  if ($busy == 1) {
    $sql = "UPDATE Specialist SET busy = 1 WHERE Account_ID = :uid;";
  } else {
    $sql = "UPDATE Specialist SET busy = 0 WHERE Account_ID = :uid;";
  }

  $stmt = $con->prepare($sql);
  $stmt->bindParam(':uid', $uid);
  $stmt->execute();

  //return to page before you clicked busy
  header('Location: ' . $_SERVER['HTTP_REFERER']);
  exit();

}
?>
