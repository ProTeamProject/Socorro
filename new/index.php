<?php

  include_once '../includes/db.php';
  session_start();

  // Check if user is logged in
  if (!isset($_SESSION['u_id'])) {
      header("Location: ../index.php");
      exit();
  }

  // Check if the user is a specialist
  if ($_SESSION['u_type'] == 'specialist') {
      // Return to dashboard
    header("Location: ../dashboard");
      exit();
  }

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1,user-scalable=0"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Socorro - New Problem</title>
  <link rel="stylesheet" type="text/css" href="../css/style.css" />
  <link rel="stylesheet" type="text/css" href="../css/form.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
  <link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500" rel="stylesheet">
</head>

<body>
  <?php include '../header.php' ?>
  <?php

  //query problem db select last problem
  $sql = "SELECT `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = 'Problem';";

$stmt = $con->prepare($sql);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

//query for list of specialists
$sql = "SELECT Specialist.Busy, Specialist.Problems_Assigned, Account.Name, Account.Account_ID, Problem_Type_Specialist.Problem_Type_ID, Problem_Type.Problem_Type_Name FROM Specialist INNER JOIN Account ON Account.Account_ID = Specialist.Account_ID INNER JOIN Problem_Type_Specialist ON Account.Account_ID = Problem_Type_Specialist.Account_ID INNER JOIN Problem_Type ON Problem_Type_Specialist.Problem_Type_ID = Problem_Type.Problem_Type_ID;";
$stmt2 = $con->prepare($sql);
$stmt2->execute();

//query list of problem types
$sql = "SELECT Problem_Type_ID, Problem_Type_Name, Parent_Problem_ID FROM Problem_Type;";
$stmt3 = $con->prepare($sql);
$stmt3->execute();

   ?>
  <main id="panel" class="main__section">
    <section id="new" class="h-padding-xlarge animated fadeIn">
      <h2 class="animated fadeInUp"><a class="back__button" href="/dashboard">Back to Dashboard</a></h2>
        <div class="heading">
      <h1 class="animated fadeInUp">New Problem ID: #<?php echo $row['AUTO_INCREMENT'] ?></h1>
      <div class="date__status__container">
        <p class="date__status animated fadeInUp">
          Created on <?php $date = date('jS F Y H:i'); echo $date; ?>
        </p>
      </div>
    </div>

    <form action="../includes/addproblem.php?id=<?php echo $row['AUTO_INCREMENT'] ?>" method="post">
    <div class="accordian__container">
      <button type="button" id="accordion_caller_info" class="accordion animated FadeIn">
      <i class="fa fa-user" aria-hidden="true"></i> Caller Info
    </button>
      <div class="panel">
        <div class="form-group">
          <select name="caller-id">
            <?php

            $sql = "SELECT Caller_ID, Caller_Name, Job, Department, Extension FROM Employee ORDER BY Caller_Name ASC;";
            $stmt4 = $con->prepare($sql);
            $stmt4->execute();

            while ($row_emp = $stmt4->fetch(PDO::FETCH_ASSOC)) {
                echo '<option value="' . $row_emp['Caller_ID'] . '">' . $row_emp['Caller_Name'] . ', ' . 'ID: ' . $row_emp['Caller_ID'] . ', Ext: ' . $row_emp['Extension'] . ', ' . $row_emp['Job'] . ', '. $row_emp['Department'] . '</option>';
            }

             ?>
          </select>
          <label class="control-label" for="select">Select Employee*</label><i class="bar"></i>
        </div>
      </div>

      <button type="button" id="accordion_problem_info" class="accordion animated FadeIn"><i class="fa fa-info-circle" aria-hidden="true"></i>
Problem Info</button>
      <div class="panel">

          <div class="form-group">
            <textarea required="required" name="problem-desc" ></textarea>
            <label class="control-label" for="textarea" >Problem Description*</label><i class="bar"></i>
          </div>
          <div class="checkbox">
            <label>
              <input id="checkbox-create-problem-type" name="check-new-problem-type" value="1" type="checkbox"/><i class="helper"></i>Create New Problem Type
            </label>
          </div>
          <div id="problem-type" class="form-group">
            <select  name="problem-type">
              <?php

              while ($row_type = $stmt3->fetch(PDO::FETCH_ASSOC)) {
                  echo '<option value="' . $row_type['Problem_Type_ID'] . '"><strong>' . $row_type['Problem_Type_Name'] . '</strong>' . '</option>';
              }

               ?>
            </select>
            <label class="control-label" for="select">Problem Type</label><i class="bar"></i>
          </div>
          <div style="display:none;" id="new-problem-type">
            <div class="form-group">
              <select name="parent-problem-type">
                <?php

                $sql = "SELECT Problem_Type_ID, Problem_Type_Name, Parent_Problem_ID FROM Problem_Type;";
                $stmt4 = $con->prepare($sql);
                $stmt4->execute();

                while ($row_type = $stmt4->fetch(PDO::FETCH_ASSOC)) {
                    echo '<option value="' . $row_type['Problem_Type_ID'] . '"><strong>' . $row_type['Problem_Type_Name'] . '</strong>' . '</option>';
                }

                 ?>
              </select>
              <label class="control-label" for="select">Parent Problem Type</label><i class="bar"></i>
            </div>
            <div class="form-group">
              <input type="text" name="new-problem-type"/>
              <label class="control-label" for="input">New Problem Type</label><i class="bar"></i>
            </div>
          </div>

          <div class="form-group">
            <input id="software-number" type="text" name="software"/>
            <label class="control-label" for="input">Software Serial Number</label><i class="bar"></i>

              <div id="alert-area"></div>
          </div>

          <div class="form-group">
            <input id="hardware-number" type="text" name="hardware"/>
            <label class="control-label" for="input">Hardware Serial Number</label><i class="bar"></i>
            <div id="alert-area-2"></div>
          </div>

          <div  class="form-group">
            <select id="os-type" name="os">
              <option>MacOS</option>
              <option>Windows</option>
              <option>Linux</option>
            </select>
            <label class="control-label" for="select">Operating System</label><i class="bar"></i>
          </div>
          <div class="form-group">
            <select id="os-version" name="os-ver">

            </select>
            <label class="control-label" for="select">Version</label><i class="bar"></i>
          </div>

          <div class="form-group">
            <select name="specialist">
              <?php

              while ($row_specialists = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                  $busy = $row_specialists['Busy'] == 1 ? ', Busy' : '';
                  echo '<option value="' . $row_specialists['Account_ID'] . '"><strong>' . $row_specialists['Name'] . '</strong>, Problem Types: ' . $row_specialists['Problem_Type_Name'] . ', Curent Problems: ' . $row_specialists['Problems_Assigned'] . $busy . '</option>';
              }

               ?>
            </select>
            <label class="control-label" for="select">Assign Specialist*</label><i class="bar"></i>
          </div>
          <div class="checkbox">
            <label>
              <input id="checkbox-solved" type="checkbox" value="1" name="solved"/><i class="helper"></i>Problem Solved (Closed)
            </label>
            <a href="#openModal2"><button type="button" id="solution-button"class="button__main" style="display:none;color:black;margin-top:20px;">Enter Solution</button></a>
          </div>
          <div style="height:170px;">

          </div>

      </div>

      <button type="button" id="accordion_status" class="accordion animated FadeIn"><i class="fa fa-commenting" aria-hidden="true"></i> Status</button>
      <div class="panel">
        <div class="status__container">
          <div class="status openingstatus">
            <div class="form-group desc">
              <textarea required="required" name="status"></textarea>
              <label class="control-label" for="textarea" >Opening Status*</label><i class="bar"></i>
            </div>
          </div>

        </div>

      </div>
      </div>
      <div class="button-container">
        <button class="button" name="submit"><span>Create New Problem</span></button>
      </div>
      <div id="openModal2" class="modalDialog">
        <div>	<a href="#close" title="Close" class="close">X</a>
              <h2 class="text-centered">Add Solution</h2>

                  <div class="form-group desc">
                    <textarea name="solution"></textarea>
                    <label class="control-label" for="textarea">Solution</label><i class="bar"></i>
                </div>
                <div class="button__container">
                <a href="#close"><button type="button" class="button__load" style="margin-bottom:10px;" >Save</button></a>
            </div>
        </div>
      </div>
  </form>



  <footer class="footer v-padding-xlarge">
    <p>
      ProTeam Project - Team 10
    </p>
  </footer>

    </section>

  </main>
  <?php include '../includes/busy_modal.php' ?>


</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="../js/main.js"></script>
<script type="text/javascript">
  function googleTranslateElementInit() {
    new google.translate.TranslateElement({
      pageLanguage: 'en',
      layout: google.translate.TranslateElement.InlineLayout.SIMPLE
    }, 'google_translate_element');
  }
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</html>
