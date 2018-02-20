<?php
// Searchs the database for a given string

function searchHardware($text) {

  //Connect to database
  include 'db.php';

  // Filter text
  $text = htmlspecialchars($text);

  $sql = "SELECT Equipment_Serial_Number, Equipment_Name FROM Equipment WHERE Equipment_Serial_Number = :no;";

  $stmt = $con->prepare($sql);
  $stmt->bindParam(':no', $text);
  $stmt->execute();

  $resultCheck = $stmt->rowCount();
  // Check if there are results
  if ($resultCheck < 1) {
    echo '<div class="alert">
          Serial Number is not in database.
      </div>';
  } else {
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      // Output
      echo '<div class="alert success">
            Serial Number is in database - Hardware Name: ' . $row['Equipment_Name'] . '
        </div>';
    }
  }

}
// Run search function
searchHardware($_GET['txt']);

 ?>
