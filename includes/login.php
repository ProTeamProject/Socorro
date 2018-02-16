<?php

session_start();

// Submit button pressed
if (isset($_POST['submit'])) {

  // Connect to database
  include 'db.php';

  // Retrieve username and password
  $uname = mysqli_real_escape_string($con, $_POST['uname']);
  $pword = mysqli_real_escape_string($con, $_POST['pword']);

  // Error handling
  if (empty($uname) || empty($pword)) {
    header("Location: ../index.php?login=empty");
    exit();
  } else {

    $sql = "SELECT * FROM Account WHERE Username = '$uname';";
    $result = mysqli_query($con, $sql);
    /*
    $sql = "SELECT * FROM Account WHERE Username = ?;";
    $stmt = mysqli_stmt_init($con);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      echo 'SQL Error';
    } else {
      mysqli_stmt_bind_param($stmt, "s", $uname);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
    }
    */
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck < 1) {
      header("Location: ../index.php?login=invaliduser");
      //mysqli_stmt_close($stmt);
      exit();
    } else {
      if ($row = mysqli_fetch_assoc($result)) {
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
