<?php

  include_once '../includes/db.php';
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

          <div class="form-group" id="caller-info">
            <input list="items" id="caller-name" type="text" name="caller-name" required="required"/>
            <label class="control-label" for="input">Caller Name</label><i class="bar"></i>
          </div>
          <div class="form-group" id="caller-info">
            <input list="items" id="caller-name" type="text" name="caller-id" required="required"/>
            <label class="control-label" for="input">Caller ID</label><i class="bar"></i>
          </div>


      </div>

      <button type="button" id="accordion_problem_info" class="accordion animated FadeIn"><i class="fa fa-info-circle" aria-hidden="true"></i>
Problem Info</button>
      <div class="panel">

          <div class="form-group">
            <textarea required="required" name="problem-desc" onkeyup="increaseHeight(this);"></textarea>
            <label class="control-label" for="textarea" >Problem Description</label><i class="bar"></i>
          </div>
          <div class="form-group">
            <select name="problem-type">
              <?php

              while ($row_type = $stmt3->fetch(PDO::FETCH_ASSOC)) {
                echo '<option value="' . $row_type['Problem_Type_ID'] . '"><strong>' . $row_type['Problem_Type_Name'] . '</strong>' . '</option>';
              }

               ?>
            </select>
            <label class="control-label" for="select">Problem Type</label><i class="bar"></i>
          </div>
          <div class="checkbox">
            <label>
              <input id="checkbox-create-problem-type" name="check-new-problem-type" value="1" type="checkbox"/><i class="helper"></i>Create New Problem Type
            </label>
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
            <input type="text" name="software"/>
            <label class="control-label" for="input">Software Serial Number</label><i class="bar"></i>
          </div>

          <div class="form-group">
            <input type="text" name="hardware"/>
            <label class="control-label" for="input">Hardware Serial Number</label><i class="bar"></i>
          </div>

          <div class="form-group">
            <select name="os">
              <option>MacOS</option>
              <option>Windows</option>
              <option>Linux</option>
            </select>
            <label class="control-label" for="select">Operating System</label><i class="bar"></i>
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
            <label class="control-label" for="select">Assign Specialist</label><i class="bar"></i>
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
          <div class="status">
            <div class="form-group desc">
              <textarea required="required" onkeyup="increaseHeight(this);" name="status"></textarea>
              <label class="control-label" for="textarea" >Opening Status</label><i class="bar"></i>
            </div>
          </div>

        </div>

      </div>
      </div>
      <div class="button-container">
        <button class="button" name="submit"><span>Create New Problem</span></button>
      </div>

  </form>



  <footer class="footer v-padding-xlarge">
    <p>
      ProTeam Project - Team 10
    </p>
  </footer>

    </section>

  </main>
  <div id="openModal" class="modalDialog">
    <div>	<a href="#close" title="Close" class="close">X</a>
          <h2 class="text-centered">Assign Specialist</h2>

              <p style="color:white;">
                <strong>Problem Type: </strong>Hardware
              </p>
              <div class="problems__inner__dash__specialists" style="color:white;">
                  <div class="problem__entry h-padding-small open" id="problem_27">
                    <p class="pid">Ext: 29867</p>
                    <strong><p class="caller__name">Jim Pickins</p></strong>
                    <p class="problem__type">Hardware</p>
                    <p class="date__created">10</p>
                    <div class="status__closed">
                      <p class="status__text">Busy</p>
                    </div>
                  </div>

                  <div id="specialist-entry_2" class="problem__entry h-padding-small open" id="problem_27">
                    <p class="pid">Ext: 29867</p>
                    <strong><p class="caller__name">Bert Rodgers</p></strong>
                    <p class="problem__type">Hardware</p>
                    <p class="date__created">5</p>
                    <div class="status__open">
                      <p class="status__text">Available</p>
                    </div>
                  </div>

                  <div id="specialist-entry_3" class="problem__entry h-padding-small open" id="problem_27">
                    <p class="pid">Ext: 29867</p>
                    <strong><p class="caller__name">Ronny Dilbert</p></strong>
                    <p class="problem__type">Hardware</p>
                    <p class="date__created">3</p>
                    <div class="status__open">
                      <p class="status__text">Available</p>
                    </div>
                  </div>

                  <div class="problem__entry h-padding-small open" id="problem_27">
                    <p class="pid">Ext: 29867</p>
                    <strong><p class="caller__name">John Middleton</p></strong>
                    <p class="problem__type">Hardware</p>
                    <p class="date__created">13</p>
                    <div class="status__closed">
                      <p class="status__text">Busy</p>
                    </div>
                  </div>
              </div>
            <div class="button__container">
            <button class="button__load" style="margin-bottom:10px;">Save</button>
        </div>
    </div>
  </div>
  <div id="openModal2" class="modalDialog">
    <div>	<a href="#close" title="Close" class="close">X</a>
          <h2 class="text-centered">Add Solution</h2>

              <div class="form-group desc">
                <textarea onkeyup="increaseHeight(this);" name="solution"></textarea>
                <label class="control-label" for="textarea">Solution</label><i class="bar"></i>
            </div>
            <div class="button__container">
            <button class="button__load" style="margin-bottom:10px;">Save</button>
        </div>
    </div>
  </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slideout/1.0.1/slideout.min.js"></script>
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
