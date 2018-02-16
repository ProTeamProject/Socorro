<?php
  session_start();

  if (!isset($_SESSION['u_id'])) {
    header("Location: ../index.php");
    exit();
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1,user-scalable=0" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Socorro - Log In</title>
  <link rel="stylesheet" type="text/css" href="../css/login.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
  <link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500" rel="stylesheet">
</head>
<body>
  <h1>
    Welcome <?php echo $_SESSION['u_name'] ?>
  </h1>
  <form action="includes/logout.php" method="post">
      <button type="submit" name="submit">Log Out</button>
  </form>
  <h2>Search Problems</h2>
  <input type="text" id="search" />

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</html>
