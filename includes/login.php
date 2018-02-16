<?php

session_start();

// Submit button pressed
if (isset($_POST['submit'])) {

  // Connect to database
  include 'db.php';

  // Retrieve username and password
  $uname = $_POST['uname'];
  $pword = $_POST['pword'];

  // Error handling
  if (empty($uname) || empty($pword)) {
    header("Location: ../index.php?login=empty");
    exit();
  } else {
    $sql = "SELECT * FROM Account WHERE Username = :uname;";
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':uname', $uname);
    $stmt->execute();
    $resultCheck = $stmt->rowCount();
    if ($resultCheck < 1) {
      header("Location: ../index.php?login=invaliduser");
      //mysqli_stmt_close($stmt);
      exit();
    } else {
      if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Dehash password
        $hashPwordCheck = password_verify($pword, $row['Password']);
        if (!$hashPwordCheck) {
          header("Location: ../index.php?login=incorrect");
          //mysqli_stmt_close($stmt);
          exit();
        } else if ($hashPwordCheck) {
          // Log in
          $_SESSION['u_id'] = $row['Account_ID'];
          $_SESSION['u_name'] = $row['Name'];
          $_SESSION['u_username'] = $row['Username'];
          $_SESSION['u_type'] = $row['Job_Type'];
          header("Location: ../dummy_dashboard.php?login=success");
          //mysqli_stmt_close($stmt);
          exit();
        }
      }
    }
  }
} else {
  header("Location: ../index.php?login=error");
  exit();
}

?>
