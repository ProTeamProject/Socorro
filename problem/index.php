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
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1,user-scalable=0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Socorro - Problem Info</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
    <link rel="stylesheet" type="text/css" href="../css/form.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500" rel="stylesheet">
  </head>

  <body>
    <?php
  $pid = $_GET['id'];
  $sql = "SELECT Problem.Problem_ID, Problem.State, Employee.Caller_Name, Employee.Caller_ID, Employee.Job,
  Employee.Extension, Employee.Department, Problem.Problem_Desc, Problem_Type.Problem_Type_Name,
  Software_Problem.Software_License_Number, Software_Problem.Operating_System, Software.Software_Name, Equipment.Equipment_Name,
  Equipment_Problem.Equipment_Serial_Number, A1.Name As Operator, A2.Name As Specialist, A2.Account_ID As Specialist_ID, MAX(Problem_Status.Status_Date) As Status_Date
  FROM Problem
  LEFT JOIN Employee ON Employee.Caller_ID = Problem.Caller_ID
  LEFT JOIN Problem_Type ON Problem_Type.Problem_Type_ID = Problem.Problem_Type_ID
  LEFT JOIN Software_Problem ON Software_Problem.Problem_ID = Problem.Problem_ID
  LEFT JOIN Equipment_Problem ON Equipment_Problem.Problem_ID = Problem.Problem_ID
  LEFT JOIN Account A1 ON A1.Account_ID = Problem.Operator_Account_ID
  LEFT JOIN Account A2 ON A2.Account_ID = Problem.Specialist_Account_ID
  LEFT JOIN Software ON Software.Software_License_Number = Software_Problem.Software_License_Number
  LEFT JOIN Equipment ON Equipment.Equipment_Serial_Number = Equipment_Problem.Equipment_Serial_Number
  LEFT JOIN Problem_Status on Problem_Status.Problem_ID = Problem.Problem_ID
  WHERE Problem.Problem_ID = :id GROUP BY Problem.Problem_ID, Problem.State, Employee.Caller_Name, Employee.Caller_ID, Employee.Job,
  Employee.Extension, Employee.Department, Problem.Problem_Desc, Problem_Type.Problem_Type_Name,
  Software_Problem.Software_License_Number, Software_Problem.Operating_System, Software.Software_Name, Equipment.Equipment_Name,
  Equipment_Problem.Equipment_Serial_Number, Operator, Specialist";

  $stmt = $con->prepare($sql);
  $stmt->bindParam(':id', $pid, PDO::PARAM_INT);
  $stmt->execute();

  $sql_status = "SELECT Problem_Status.Status_Date, Status.Status_Type, Problem_Status.Comment, Account.Name
  FROM Problem_Status
  INNER JOIN Account ON Problem_Status.Account_ID = Account.Account_ID
  INNER JOIN Status ON Status.Status_ID = Problem_Status.Status_ID
  WHERE Problem_Status.Problem_ID = :id;
  ORDER BY Problem_Status.Status_Date ASC";

  $stmt_status = $con->prepare($sql_status);
  $stmt_status->bindParam(':id', $pid, PDO::PARAM_INT);
  $stmt_status->execute();

  $row = $stmt->fetch(PDO::FETCH_ASSOC);




    ?>
    <?php include '../header.php' ?>
    <main id="panel" class="main__section">
      <section id="new" class="h-padding-xlarge animated fadeIn">
        <h2 class="animated fadeInUp"><a  class="back__button" href="../dashboard">Back to Dashboard</a></h2>
        <div class="heading">
          <h1 class="animated fadeInUp">Problem ID: #<?php echo $row['Problem_ID']; ?></h1>
          <div class="status__<?php echo $row['State']; ?> animated fadeInUp">
            <p class="status__text">
              <?php $state = $row['State']; echo $state; ?>
            </p>
          </div>
          <div class="date__status__container">
            <p class="date__status animated fadeInUp">
              Last Updated <?php echo date('jS F Y H:i', strtotime($row['Status_Date'])); ?>
            </p>
          </div>
        </div>
        <div class="problem__info">
          <div class="accordian__container">
            <button id="accordion_caller_info" class="accordion animated FadeIn">
            <i class="fa fa-user" aria-hidden="true"></i> Caller Info
          </button>
            <div class="panel">
              <div class="flexbox-container">
                <div>
                  <table cellspacing="10" cellpadding="2">
                    <tr>
                      <td class="first">
                        <h4>Original Caller</h4></td>
                      <td>
                        <?php echo $row['Caller_Name']; ?>
                      </td>
                    </tr>
                    <tr>
                      <td class="first">
                        <h4>Caller ID</h4></td>
                      <td>
                        <?php echo $row['Caller_ID']; ?>
                      </td>
                    </tr>
                    <tr>
                      <td class="second">
                        <h4>Job</h4></td>
                      <td>
                        <?php echo $row['Job']; ?>
                      </td>
                    </tr>
                    <tr>
                      <td class="second">
                        <h4>Department</h4></td>
                      <td>
                        <?php echo $row['Department']; ?>
                      </td>
                    </tr>
                    <tr>
                      <td class="second">
                        <h4>Extension</h4></td>
                      <td>
                        <?php echo $row['Extension']; ?>
                      </td>
                    </tr>
                  </table>

                </div>
              </div>
            </div>

            <button id="accordion_problem_info" class="accordion animated FadeIn"><i class="fa fa-info-circle" aria-hidden="true"></i>
     Problem Info</button>
            <div class="panel">
              <div class="flexbox-container">
                <div>
                  <table cellspacing="10" cellpadding="2">
                    <tbody>
                      <tr>
                        <td class="first">
                          <h4>Problem Description</h4></td>
                        <td>
                          <p><?php echo $row['Problem_Desc']; ?></p>
                        </td>
                      </tr>
                      <tr>
                        <td class="second">
                          <h4>Problem Type</h4></td>
                        <td>
                          <?php echo $row['Problem_Type_Name']; ?>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div>
                  <table cellspacing="10" cellpadding="2">
                    <tr>
                      <td class="first">
                        <h4>Serial Numbers</h4></td>
                      <td>
                        Software: <?php echo $row['Software_License_Number']; ?>
                        Hardware: <?php echo $row['Equipment_Serial_Number']; ?>
                      </td>
                    </tr>
                    <tr>
                      <td class="second">
                        <h4>Operating System</h4></td>
                      <td>
                        <?php echo $row['Operating_System']; ?>
                      </td>
                    </tr>
                    <tr>
                      <td class="second">
                        <h4>Software</h4></td>
                      <td>
                        <?php echo $row['Software_Name']; ?>
                      </td>
                    </tr>
                    <tr>
                      <td class="second">
                        <h4>Hardware</h4></td>
                      <td>
                        <?php echo $row['Equipment_Name']; ?>
                      </td>
                    </tr>
                  </table>
                </div>
                <div>
                  <table cellspacing="10" cellpadding="2">
                    <tr>
                      <td class="first">
                        <h4>Opertor Name</h4></td>
                      <td>
                        <?php echo $row['Operator']; ?>
                      </td>
                    </tr>
                    <tr>
                      <td class="first">
                        <h4>Assigned Specialist</h4></td>
                      <td>
                        <?php echo $row['Specialist']; ?>
                      </td>
                    </tr>

                    <?php

                    //check if specialist
                    if ($state == 'pending') {
                      if ($_SESSION['u_type'] == 'specialist') {
                        //check if specialist assigned = specialist logged in
                        if ($_SESSION['u_id'] == $row['Specialist_ID']) {
                          //echo accept button
                          echo '
                          <tr>
                            <td class="first">
                              <h4>Accept Problem?</h4></td>
                            <td>
                            <form action="../includes/accept.php?pid=' . $pid . '" method="post">
                              <button id="accept-button" name="submit">Accept</button>
                            </form>
                            </td>
                          </tr>';
                        }
                      }
                    }



                     ?>
                  </table>
                </div>
              </div>
            </div>

            <button id="accordion_status" class="accordion animated FadeIn"><i class="fa fa-commenting" aria-hidden="true"></i> Status</button>
            <div class="panel">
              <div class="status__container">
                <?php

                while ($row_status = $stmt_status->fetch(PDO::FETCH_ASSOC)) {
                  echo '<div class="status"><p>' . date('jS F Y H:i', strtotime($row_status['Status_Date'])) . '</p>
                  <p class="status__type"><span style="font-family: FontAwesome;">' . $row_status['Status_Type'] . '</span></p>
                  <p class="desc">' . $row_status['Comment'] . '</p><p>' . $row_status['Name'] . '</p></div>';
                }

                //check if state is closed
                if ($row['State'] != 'closed') {
                  echo '<div class="button__container v-padding-mid">
                    <a href="#openModal1"><button class="button__load">Add Status</button></a>
                  </div>';
                }
                ?>
            </div>

      </section>
      <footer class="footer v-padding-xlarge">
        <p>
          ProTeam Project - Team 10
        </p>
      </footer>
      </div>
      </div>

    </main>
    <?php include '../includes/busy_modal.php' ?>
    <div id="openModal1" class="modalDialog">
      <div>
        <form action="<?php echo "/includes/addstatus.php?id=" . $_GET['id']; ?>" method="post">
        <a href="#close" title="Close" class="close">X</a>
            <h2 class="text-centered">Add New Status</h2>
                <div class="form-group">
                  <select id="status-type" name="type">
                    <option>Call</option>
                    <option>Note</option>
                  </select>
                  <label class="control-label" for="select">Status Type</label><i class="bar"></i>
                </div>
                <div id="name-input" class="form-group">
                  <input type="text" name="cid" />
                  <label class="control-label" for="input">Caller ID</label><i class="bar"></i>
                </div>
                <div class="form-group desc">
                  <textarea required="required" onkeyup="increaseHeight(this);" name="comment"></textarea>
                  <label class="control-label" for="textarea">Status Message</label><i class="bar"></i>

                <div class="checkbox">
                  <label>
                    <input id="checkbox-solved-status" type="checkbox" value="1" name="solved"/><i class="helper"></i>Problem Solved (Closed)
                  </label>
                </div>

              </div>
              <div class="form-group desc" id="enter-solution" style="display:none;">
                <textarea  onkeyup="increaseHeight(this);" name="solution"></textarea>
                <label class="control-label" for="textarea">Solution</label><i class="bar"></i>
                </div>
              <div class="button__container">
              <button class="button__load" style="margin-bottom:10px;" name="submit">Add Status</button>
          </div>
        </form>
      </div>
    </div>
    <div id="openModal2" class="modalDialog">
      <div>	<a href="#close" title="Close" class="close">X</a>
            <h2 class="text-centered">Add Solution</h2>

                <div class="form-group desc">
                  <textarea required="required" onkeyup="increaseHeight(this);"></textarea>
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
