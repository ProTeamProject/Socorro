<?php

// Checks if the specialist is busy

include '../includes/db.php';

// Retrieve user id
$uid = $_SESSION['u_id'];

// If user is a specialist
if ($_SESSION['u_type'] == 'specialist') {

// Set user busy state
$sql_busy = "SELECT Busy FROM Specialist WHERE Account_ID = :uid";
$stmt = $con->prepare($sql_busy);
$stmt->bindParam(':uid', $uid);
$stmt->execute();
$row_busy = $stmt->fetch(PDO::FETCH_ASSOC);

}
 ?>

<div id="openModal" class="modalDialog">
  <div>
    <a href="#close" title="Close" class="close">X</a>
        <h2 class="text-centered">Mark as Busy</h2>
        <form action="/includes/busy.php" method="post">
          <div class="form-group desc">
            <div class="checkbox">
              <label>
                <input id="checkbox-busy" type="checkbox" name="busy" value="1"/ <?php echo $row_busy['Busy'] == 1 ? 'checked' : '' ?>><i class="helper"></i>Mark as Busy
              </label>
              <br />
              <label>
                Any problems assigned to you will be given the "pending" state until you accept them.
              </label>
            </div>
          </div>
          <div class="button__container">
          <button class="button__load" style="margin-bottom:10px;" name='submit'>Save</button>
      </div>
      </form>
  </div>
</div>
