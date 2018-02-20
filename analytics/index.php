<?php include_once '../includes/db.php';

//Start the session
session_start();

//Check if user is logged in
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
  <title>Socorro - Problem Analytics</title>
  <link rel="stylesheet" type="text/css" href="../css/style.css" />
  <link rel="stylesheet" type="text/css" href="../css/form.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
  <link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500" rel="stylesheet">
</head>


<body>
  <?php
  //Get current month int
  $month = 2;
  $year = 2018;
  $sid = 4;

  // Queries the database for Problem analytics
  include '../includes/db.php';
  $sql6 = "SELECT TIMESTAMPDIFF(second, Open_Date, Close_Date) AS DateDiff FROM Problem WHERE Close_Date IS NOT NULL"; // works out time in seconds for Problem completion
  $stmt6 = $con->prepare($sql6);
  $stmt6->execute();
  $count = $stmt6->rowCount();
  $sum = 0;
  while($row = $stmt6->fetch(PDO::FETCH_ASSOC)) {
    $sum += $row['DateDiff'];
  }
  $average = $sum/$count;

  function secondsToTime($seconds) {
      $dtF = new \DateTime('@0');
      $dtT = new \DateTime("@$seconds");
      return $dtF->diff($dtT)->format('%a days, %h hours, %i minutes and %s seconds');
  }


  $sql9 = "SELECT State,count(state) as count FROM Problem WHERE state IN ('open','pending','closed') GROUP BY State"; // total, closed, open and pending Problems
  $stmt9 = $con->prepare($sql9);
  $stmt9->execute();



  $sql4 = "SELECT count(Problem_ID) FROM Problem WHERE Open_Date BETWEEN :year'/':month'/01' and :year'/':month'/31'"; // Total Problems for selected month
  $stmt4 = $con->prepare($sql4);
  $stmt4->bindParam(':year', $year);
  $stmt4->bindParam(':month', $month);
  $stmt4->execute();
  $result4 = $stmt4->fetch(PDO::FETCH_ASSOC);


  $sql5 = "SELECT count(Problem_Type.Software_Or_Hardware) as 'Number'
  FROM Problem_Type
  INNER JOIN Problem ON Problem_Type.Problem_Type_ID = Problem.Problem_Type_ID
  WHERE Problem_Type.Software_Or_Hardware = 6 and
  Problem.Open_Date BETWEEN :year'/':month'/01' and :year'/':month'/31'"; //  number of software Problems for specific month
  $stmt5 = $con->prepare($sql5);
  $stmt5->bindParam(':year', $year);
  $stmt5->bindParam(':month', $month);
  $stmt5->execute();
  $result5 = $stmt5->fetch(PDO::FETCH_ASSOC);


  $sql3 = "SELECT count(Problem_Type.Software_Or_Hardware) as 'Number'
  FROM Problem_Type
  INNER JOIN Problem ON Problem_Type.Problem_Type_ID = Problem.Problem_Type_ID
  WHERE Problem_Type.Software_Or_Hardware = 7 and
  Problem.Open_Date BETWEEN :year'/':month'/01' and :year'/':month'/31'"; // number of hardware Problems for specific month
  $stmt3 = $con->prepare($sql3);
  $stmt3->bindParam(':year', $year);
  $stmt3->bindParam(':month', $month);
  $stmt3->execute();
  $result3 = $stmt3->fetch(PDO::FETCH_ASSOC);

  $sql7 = "SELECT Average_Time, Number_Solved, Problems_Assigned, Busy FROM Specialist
  WHERE Account_ID = :sid"; //Breakdown of individual specialist
  $stmt7 = $con->prepare($sql7);
  $stmt7->bindParam(':sid', $sid);
  $stmt7->execute();
$result7 = $stmt7->fetch(PDO::FETCH_ASSOC);

  $sql8 = "SELECT TIMESTAMPDIFF(second, Problem.Open_Date, Problem.Close_Date)/ count(Problem_Type.Software_Or_Hardware) AS averageTime
  FROM Problem INNER JOIN Problem_Type ON Problem_Type.Problem_Type_ID = Problem.Problem_Type_ID WHERE Problem.Close_Date IS NOT NULL
  and Problem_Type.Software_Or_Hardware = 6 and Problem.Open_Date BETWEEN :year'/':month'/01' and :year'/':month'/31'"; // average time to complete
  $stmt8 = $con->prepare($sql8);
  $stmt8->bindParam(':year', $year);
  $stmt8->bindParam(':month', $month);
  $stmt8->execute();
  $result8 = $stmt8->fetch(PDO::FETCH_ASSOC);

  $sql15 = "SELECT TIMESTAMPDIFF(second, Problem.Open_Date, Problem.Close_Date)/ count(Problem_Type.Software_Or_Hardware) AS averageTime
  FROM Problem INNER JOIN Problem_Type ON Problem_Type.Problem_Type_ID = Problem.Problem_Type_ID WHERE Problem.Close_Date IS NOT NULL
  and Problem_Type.Software_Or_Hardware = 7 and Problem.Open_Date BETWEEN :year'/':month'/01' and :year'/':month'/31'"; // average time to complete
  $stmt15 = $con->prepare($sql15);
  $stmt15->bindParam(':year', $year);
  $stmt15->bindParam(':month', $month);
  $stmt15->execute();
  $result15 = $stmt15->fetch(PDO::FETCH_ASSOC);

  $sqlSoftwareOverview = "SELECT count(Problem_Type.Software_Or_Hardware) as 'Number'
  FROM Problem_Type
  INNER JOIN Problem ON Problem_Type.Problem_Type_ID = Problem.Problem_Type_ID
  WHERE Problem_Type.Software_Or_Hardware = 6 and
  Problem.Open_Date BETWEEN :year'/01/01' and :year'/01/31'
  UNION ALL
  SELECT count(Problem_Type.Software_Or_Hardware) as 'Number'
  FROM Problem_Type
  INNER JOIN Problem ON Problem_Type.Problem_Type_ID = Problem.Problem_Type_ID
  WHERE Problem_Type.Software_Or_Hardware = 6 and
  Problem.Open_Date BETWEEN :year'/02/01' and :year'/02/31'
  UNION ALL
  SELECT count(Problem_Type.Software_Or_Hardware) as 'Number'
  FROM Problem_Type
  INNER JOIN Problem ON Problem_Type.Problem_Type_ID = Problem.Problem_Type_ID
  WHERE Problem_Type.Software_Or_Hardware = 6 and
  Problem.Open_Date BETWEEN :year'/03/01' and :year'/03/31'
  UNION ALL
  SELECT count(Problem_Type.Software_Or_Hardware) as 'Number'
  FROM Problem_Type
  INNER JOIN Problem ON Problem_Type.Problem_Type_ID = Problem.Problem_Type_ID
  WHERE Problem_Type.Software_Or_Hardware = 6 and
  Problem.Open_Date BETWEEN :year'/04/01' and :year'/04/31'
  UNION ALL
  SELECT count(Problem_Type.Software_Or_Hardware) as 'Number'
  FROM Problem_Type
  INNER JOIN Problem ON Problem_Type.Problem_Type_ID = Problem.Problem_Type_ID
  WHERE Problem_Type.Software_Or_Hardware = 6 and
  Problem.Open_Date BETWEEN :year'/05/01' and :year'/05/31'
  UNION ALL
  SELECT count(Problem_Type.Software_Or_Hardware) as 'Number'
  FROM Problem_Type
  INNER JOIN Problem ON Problem_Type.Problem_Type_ID = Problem.Problem_Type_ID
  WHERE Problem_Type.Software_Or_Hardware = 6 and
  Problem.Open_Date BETWEEN :year'/06/01' and :year'/06/31'
  UNION ALL
  SELECT count(Problem_Type.Software_Or_Hardware) as 'Number'
  FROM Problem_Type
  INNER JOIN Problem ON Problem_Type.Problem_Type_ID = Problem.Problem_Type_ID
  WHERE Problem_Type.Software_Or_Hardware = 6 and
  Problem.Open_Date BETWEEN :year'/07/01' and :year'/07/31'
  UNION ALL
  SELECT count(Problem_Type.Software_Or_Hardware) as 'Number'
  FROM Problem_Type
  INNER JOIN Problem ON Problem_Type.Problem_Type_ID = Problem.Problem_Type_ID
  WHERE Problem_Type.Software_Or_Hardware = 6 and
  Problem.Open_Date BETWEEN :year'/08/01' and :year'/08/31'
  UNION ALL
  SELECT count(Problem_Type.Software_Or_Hardware) as 'Number'
  FROM Problem_Type
  INNER JOIN Problem ON Problem_Type.Problem_Type_ID = Problem.Problem_Type_ID
  WHERE Problem_Type.Software_Or_Hardware = 6 and
  Problem.Open_Date BETWEEN :year'/09/01' and :year'/09/31'
  UNION ALL
  SELECT count(Problem_Type.Software_Or_Hardware) as 'Number'
  FROM Problem_Type
  INNER JOIN Problem ON Problem_Type.Problem_Type_ID = Problem.Problem_Type_ID
  WHERE Problem_Type.Software_Or_Hardware = 6 and
  Problem.Open_Date BETWEEN :year'/10/01' and :year'/10/31'
  UNION ALL
  SELECT count(Problem_Type.Software_Or_Hardware) as 'Number'
  FROM Problem_Type
  INNER JOIN Problem ON Problem_Type.Problem_Type_ID = Problem.Problem_Type_ID
  WHERE Problem_Type.Software_Or_Hardware = 6 and
  Problem.Open_Date BETWEEN :year'/11/01' and :year'/11/31'
  UNION ALL
  SELECT count(Problem_Type.Software_Or_Hardware) as 'Number'
  FROM Problem_Type
  INNER JOIN Problem ON Problem_Type.Problem_Type_ID = Problem.Problem_Type_ID
  WHERE Problem_Type.Software_Or_Hardware = 6 and
  Problem.Open_Date BETWEEN :year'/12/01' and :year'/12/31'"; //  number of software Problems for specific month
  $stmtSoftwareOverview = $con->prepare($sqlSoftwareOverview);
  $stmtSoftwareOverview->bindParam(':year', $year);
  $stmtSoftwareOverview->execute();
  while($row = $stmtSoftwareOverview->fetch(PDO::FETCH_ASSOC)) {
      $arrSWOverview[] = $row['Number'];
  }
  $sqlHardwareOverview = "SELECT count(Problem_Type.Software_Or_Hardware) as 'Number'
  FROM Problem_Type
  INNER JOIN Problem ON Problem_Type.Problem_Type_ID = Problem.Problem_Type_ID
  WHERE Problem_Type.Software_Or_Hardware = 7 and
  Problem.Open_Date BETWEEN :year'/01/01' and :year'/01/31'
  UNION ALL
  SELECT count(Problem_Type.Software_Or_Hardware) as 'Number'
  FROM Problem_Type
  INNER JOIN Problem ON Problem_Type.Problem_Type_ID = Problem.Problem_Type_ID
  WHERE Problem_Type.Software_Or_Hardware = 7 and
  Problem.Open_Date BETWEEN :year'/02/01' and :year'/02/31'
  UNION ALL
  SELECT count(Problem_Type.Software_Or_Hardware) as 'Number'
  FROM Problem_Type
  INNER JOIN Problem ON Problem_Type.Problem_Type_ID = Problem.Problem_Type_ID
  WHERE Problem_Type.Software_Or_Hardware = 7 and
  Problem.Open_Date BETWEEN :year'/03/01' and :year'/03/31'
  UNION ALL
  SELECT count(Problem_Type.Software_Or_Hardware) as 'Number'
  FROM Problem_Type
  INNER JOIN Problem ON Problem_Type.Problem_Type_ID = Problem.Problem_Type_ID
  WHERE Problem_Type.Software_Or_Hardware = 7 and
  Problem.Open_Date BETWEEN :year'/04/01' and :year'/04/31'
  UNION ALL
  SELECT count(Problem_Type.Software_Or_Hardware) as 'Number'
  FROM Problem_Type
  INNER JOIN Problem ON Problem_Type.Problem_Type_ID = Problem.Problem_Type_ID
  WHERE Problem_Type.Software_Or_Hardware = 7 and
  Problem.Open_Date BETWEEN :year'/05/01' and :year'/05/31'
  UNION ALL
  SELECT count(Problem_Type.Software_Or_Hardware) as 'Number'
  FROM Problem_Type
  INNER JOIN Problem ON Problem_Type.Problem_Type_ID = Problem.Problem_Type_ID
  WHERE Problem_Type.Software_Or_Hardware = 7 and
  Problem.Open_Date BETWEEN :year'/06/01' and :year'/06/31'
  UNION ALL
  SELECT count(Problem_Type.Software_Or_Hardware) as 'Number'
  FROM Problem_Type
  INNER JOIN Problem ON Problem_Type.Problem_Type_ID = Problem.Problem_Type_ID
  WHERE Problem_Type.Software_Or_Hardware = 7 and
  Problem.Open_Date BETWEEN :year'/07/01' and :year'/07/31'
  UNION ALL
  SELECT count(Problem_Type.Software_Or_Hardware) as 'Number'
  FROM Problem_Type
  INNER JOIN Problem ON Problem_Type.Problem_Type_ID = Problem.Problem_Type_ID
  WHERE Problem_Type.Software_Or_Hardware = 7 and
  Problem.Open_Date BETWEEN :year'/08/01' and :year'/08/31'
  UNION ALL
  SELECT count(Problem_Type.Software_Or_Hardware) as 'Number'
  FROM Problem_Type
  INNER JOIN Problem ON Problem_Type.Problem_Type_ID = Problem.Problem_Type_ID
  WHERE Problem_Type.Software_Or_Hardware = 7 and
  Problem.Open_Date BETWEEN :year'/09/01' and :year'/09/31'
  UNION ALL
  SELECT count(Problem_Type.Software_Or_Hardware) as 'Number'
  FROM Problem_Type
  INNER JOIN Problem ON Problem_Type.Problem_Type_ID = Problem.Problem_Type_ID
  WHERE Problem_Type.Software_Or_Hardware = 7 and
  Problem.Open_Date BETWEEN :year'/10/01' and :year'/10/31'
  UNION ALL
  SELECT count(Problem_Type.Software_Or_Hardware) as 'Number'
  FROM Problem_Type
  INNER JOIN Problem ON Problem_Type.Problem_Type_ID = Problem.Problem_Type_ID
  WHERE Problem_Type.Software_Or_Hardware = 7 and
  Problem.Open_Date BETWEEN :year'/11/01' and :year'/11/31'
  UNION ALL
  SELECT count(Problem_Type.Software_Or_Hardware) as 'Number'
  FROM Problem_Type
  INNER JOIN Problem ON Problem_Type.Problem_Type_ID = Problem.Problem_Type_ID
  WHERE Problem_Type.Software_Or_Hardware = 7 and
  Problem.Open_Date BETWEEN :year'/12/01' and :year'/12/31'
  "; // number of hardware Problems for specific month
  $stmtHardwareOverview = $con->prepare($sqlHardwareOverview);
  $stmtHardwareOverview->bindParam(':year', $year);
  $stmtHardwareOverview->execute();
  while($row = $stmtHardwareOverview->fetch(PDO::FETCH_ASSOC)) {
      $arrHWOverview[] = $row['Number'];
  }
  $sql = "SELECT Problem_Type.Problem_Type_Name as 'Software', count(Problem.Problem_Type_ID)
  as 'Number_of_Problems' FROM Problem_Type
  INNER JOIN Problem ON Problem_Type.Problem_Type_ID = Problem.Problem_Type_ID
  WHERE Problem_Type.Software_Or_Hardware = 6 and Problem_Type.Parent_Problem_ID
  IS NOT NULL and Problem.Open_Date
  BETWEEN :year'/':month'/01' and :year'/':month'/31'
  GROUP BY Problem.Problem_Type_ID";//breakdown of software Problems
  $stmt = $con->prepare($sql);
  $stmt->bindParam(':year', $year);
  $stmt->bindParam(':month', $month);
  $stmt->execute();
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $arrSoftwareLabels[] = $row['Software'];
    $arrSoftwareData[] = $row['Number_of_Problems'];
  }
  $sql2 = "SELECT Problem_Type.Problem_Type_Name as 'Hardware', count(Problem.Problem_Type_ID) as 'Number_of_Problems'
  FROM Problem_Type
  INNER JOIN Problem ON Problem_Type.Problem_Type_ID = Problem.Problem_Type_ID
  WHERE Problem_Type.Software_Or_Hardware = 7 and
  Problem_Type.Parent_Problem_ID IS NOT NULL and
  Problem.Open_Date BETWEEN :year'/':month'/01' and :year'/':month'/31'
  group by Problem.Problem_Type_ID"; //breakdown of hardware Problems
  $stmt2 = $con ->prepare($sql2);
  $stmt2->bindParam(':year', $year);
  $stmt2->bindParam(':month', $month);
  $stmt2->execute();
  while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {
    $arrHardwareLabels[] = $row['Hardware'];
    $arrHardwareData[] = $row['Number_of_Problems'];
  }
  ?>

<?php include '../header.php' ?>
  <main id="panel" class="main__section">
    <section id="new" class="h-padding-xlarge animated fadeIn">
      <h2 class="animated fadeInUp"><a class="back__button" href="../dashboard">Back to Dashboard</a></h2>
      <h1 class="animated fadeInUp">Problem Analytics</h1>
      <div class="month_picker">
        <button class="button__load">
            Current Month
          </button>
        <button class="button__load">
            January
          </button>
        <button class="button__load">
            February
          </button>
        <button class="button__load">
            March
          </button>
        <button class="button__load">
            April
          </button>
        <button class="button__load">
            May
          </button>
        <button class="button__load">
            June
          </button>
        <button class="button__load">
            July
          </button>
        <button class="button__load">
            August
          </button>
        <button class="button__load">
            September
          </button>
        <button class="button__load">
            October
          </button>
        <button class="button__load">
            November
          </button>
        <button class="button__load">
            December
          </button>
      </div>
      <hr class="animated fadeInUp" />
      <h1 class="animated fadeInUp">Total Problems for  <?php echo date('F') . ': ' . $result4['count(Problem_ID)']; ?></h1>
      <h3 class="graph__subtitle">Average time to close: <?php echo secondsToTime(ceil($average)); ?></h3>
      <h3 class="graph__subtitle animated fadeInUp">
        <?php
          while($result9 = $stmt9->fetch(PDO::FETCH_ASSOC)) {
            if ($result9['State'] == 'open') {
              echo 'Open Problems: ' . $result9['count'] . ', ';
            } else if ($result9['State'] == 'pending') {
              echo 'Pending Problems: ' . $result9['count'] . ' ';
            } else if ($result9['State'] == 'closed') {
              echo 'Total Closed Problems: ' . $result9['count'] . ', ';
            }
          }
       ?></h3>
      <div class="graph__container animated fadeIn">
        <div class="graph graph1">
          <h1 class="graph__title animated fadeInUp">Total Problems</h1>
          <h3 class="graph__subtitle animated fadeInUp">Breakdown of Total Problems</h3>
          <canvas id="myChart" width="400" height="200"></canvas>
          <h1 class="graph__title animated fadeInUp">Problem Overview</h1>
          <h3 class="graph__subtitle animated fadeInUp">Breakdown of Problems with Average Time</h3>
            <table class="Problem__table">
              <tbody>
                <tr>
                  <th></th>
                  <th>No. Of Problems</th>
                  <th>Avg. Time to Close</th>
                </tr>
                <tr>
                  <td>Software</td>
                  <td><?php echo $result5['Number'] ?></td>
                  <td><?php echo secondsToTime(ceil($result8['averageTime'])); ?></td>
                </tr>
                <tr>
                  <td>Hardware</td>
                  <td><?php echo $result3['Number'] ?></td>
                  <td><?php echo secondsToTime(ceil($result15['averageTime'])); ?></td>
                </tr>
              </tbody>
            </table>
        </div>
        <div class="graph graph5">
          <h1 class="graph__title">Software Problems</h1>
          <h3 class="graph__subtitle">Top 5 Software Problems this Month</h3>
          <canvas id="myChart5"></canvas>
        </div>
        <div class="graph graph6">
          <h1 class="graph__title">Hardware Problems</h1>
          <h3 class="graph__subtitle">Top 5 Hardware Problems this Month</h3>
          <canvas id="myChart6"></canvas>
        </div>
        <div class="overview__title">
          <h1 class="graph__title">Specialist Overview</h1>
          <h3 class="graph__subtitle">A summary of specialist's performance</h3>
        </div>
        <div class="overview">

		<p>
      <div class="form-group">
        <select name="specialist">
          <?php

          //query for list of specialists
          $sql = "SELECT Specialist.Busy, Specialist.Problems_Assigned, Account.Name, Account.Account_ID, Problem_Type_Specialist.Problem_Type_ID, Specialist.Account_ID, GROUP_CONCAT(Problem_Type.Problem_Type_Name) As Problem_Types FROM Specialist INNER JOIN Account ON Account.Account_ID = Specialist.Account_ID INNER JOIN Problem_Type_Specialist ON Account.Account_ID = Problem_Type_Specialist.Account_ID INNER JOIN Problem_Type ON Problem_Type_Specialist.Problem_Type_ID = Problem_Type.Problem_Type_ID GROUP BY Specialist.Account_ID;";
          $stmt2 = $con->prepare($sql);
          $stmt2->execute();

          while ($row_specialists = $stmt2->fetch(PDO::FETCH_ASSOC)) {
              $busy = $row_specialists['Busy'] == 1 ? ', Busy' : '';
              echo '<option value="' . $row_specialists['Account_ID'] . '"><strong>' . $row_specialists['Name'] . '</strong></option>';
          }

           ?>
        </select>
        <label class="control-label" for="select">Select Specialist</label><i class="bar"></i>

        <?php echo 'Average time to solve a problem: ' . $result7['Average_Time'] . ' hours <br />' .  'Total number of problems solved: ' . $result7['Number_Solved'] . '<br />' . 'Number of problems currently assigned: ' . $result7['Problems_Assigned'] . '<br />' . 'Busy status: ' . $result7['Busy'] . '<br /> ';?>
      </div>


    </p>
	 </div>
      </div>
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
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
<script type="text/javascript" src="../js/main.js"></script>

<script>
var arrSoftwareLabels = <?php echo json_encode($arrSoftwareLabels); ?>;
var arrSoftwareData = <?php echo json_encode($arrSoftwareData, JSON_NUMERIC_CHECK); ?>;
var arrHardwareLabels = <?php echo json_encode($arrHardwareLabels); ?>;
var arrHardwareData = <?php echo json_encode($arrHardwareData, JSON_NUMERIC_CHECK); ?>;
var arrSoftwareOverview = <?php echo json_encode($arrSWOverview, JSON_NUMERIC_CHECK); ?>;
var arrHardwareOverview = <?php echo json_encode($arrHWOverview, JSON_NUMERIC_CHECK); ?>;
</script>
<script type="text/javascript">
  function googleTranslateElementInit() {
    new google.translate.TranslateElement({
      pageLanguage: 'en',
      layout: google.translate.TranslateElement.InlineLayout.SIMPLE
    }, 'google_translate_element');
  }
  var ctx = document.getElementById("myChart").getContext('2d');
  var myChart = new Chart(ctx, {
      type: 'line',
      data: {
          labels: ["January", "Febuary", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
          datasets: [{
              label: '# Software Problems',
              data: arrSoftwareOverview,
              backgroundColor: [
                  'rgba(255, 99, 132, 0.2)',
                  'rgba(54, 162, 235, 0.2)',
                  'rgba(255, 206, 86, 0.2)',
                  'rgba(75, 192, 192, 0.2)',
                  'rgba(153, 102, 255, 0.2)',
                  'rgba(255, 159, 64, 0.2)'
              ],
              borderColor: [
                  'rgba(255,99,132,1)',
                  'rgba(54, 162, 235, 1)',
                  'rgba(255, 206, 86, 1)',
                  'rgba(75, 192, 192, 1)',
                  'rgba(153, 102, 255, 1)',
                  'rgba(255, 159, 64, 1)'
              ],
              borderWidth: 1
          },{label: '# Hardware Problems',
              data: arrHardwareOverview,
              backgroundColor: [
                  'rgba(54, 162, 235, 0.2)',
                  'rgba(255, 206, 86, 0.2)',
                  'rgba(75, 192, 192, 0.2)',
                  'rgba(153, 102, 255, 0.2)',
                  'rgba(255, 159, 64, 0.2)'
              ],
              borderColor: [
                  'rgba(54, 162, 235, 1)',
                  'rgba(255, 206, 86, 1)',
                  'rgba(75, 192, 192, 1)',
                  'rgba(153, 102, 255, 1)',
                  'rgba(255, 159, 64, 1)'
              ],
  		borderWidth: 1}]
      },
      options: {
        legend: {
          display: true
        },
        responsive: true,
        maintainAspectRatio: true,
          scales: {
              yAxes: [{
                  ticks: {
                      beginAtZero:true,
                      fontColor: '#fff'
                  }
              }]
          }
      }
  });


  var ctx = document.getElementById("myChart6").getContext('2d');
  var myChart4 = new Chart(ctx, {
      type: 'bar',
      data: {
          labels: arrSoftwareLabels,
          datasets: [{
              label: '# of Problems',
              data: arrSoftwareData,
              backgroundColor: [
                  'rgba(255, 99, 132, 0.2)',
                  'rgba(54, 162, 235, 0.2)',
                  'rgba(255, 206, 86, 0.2)',
                  'rgba(75, 192, 192, 0.2)',
                  'rgba(153, 102, 255, 0.2)',

              ],
              borderColor: [
                  'rgba(255,99,132,1)',
                  'rgba(54, 162, 235, 1)',
                  'rgba(255, 206, 86, 1)',
                  'rgba(75, 192, 192, 1)',
                  'rgba(153, 102, 255, 1)',

              ],
              borderWidth: 1
          }]
      },
      options: {
          scales: {
              yAxes: [{
                  ticks: {
                      beginAtZero:true,
                      fontColor: '#fff'
                  }
              }]
          }
      }
  });

  var ctx = document.getElementById("myChart5").getContext('2d');
  var myChart5 = new Chart(ctx, {
      type: 'bar',
      data: {
          labels: arrHardwareLabels,
          datasets: [{
              label: '# of Problems',
              data: arrHardwareData,
              backgroundColor: [
                  'rgba(255, 99, 132, 0.2)',
                  'rgba(54, 162, 235, 0.2)',
                  'rgba(255, 206, 86, 0.2)',
                  'rgba(75, 192, 192, 0.2)',
                  'rgba(153, 102, 255, 0.2)',
              ],
              borderColor: [
                  'rgba(255,99,132,1)',
                  'rgba(54, 162, 235, 1)',
                  'rgba(255, 206, 86, 1)',
                  'rgba(75, 192, 192, 1)',
                  'rgba(153, 102, 255, 1)',

              ],
              borderWidth: 1
          }]
      },
      options: {
          scales: {
              yAxes: [{
                  ticks: {
                      beginAtZero:true,
                      fontColor: '#fff',
                      color: 'rgba(255, 255, 255, 0.6)',
                  }
              }]
          }
      }
  });

</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>


</html>
