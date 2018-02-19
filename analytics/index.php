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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
  <link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500" rel="stylesheet">
</head>


<body>
  <?php
  // Queries the database for problem analytics
  include '../includes/db.php';
  $sql6 = "SELECT TIMESTAMPDIFF(second, Open_Date, Close_Date) AS DateDiff FROM Problem WHERE Close_Date IS NOT NULL"; // works out time in seconds for problem completion
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


  $sql9 = "SELECT state,count(state) as count FROM Problem WHERE state IN ('open','pending','closed') GROUP BY state"; // total, closed, open and pending problems
  $stmt9 = $con->prepare($sql9);
  $stmt9->execute();
  $result9 = $stmt9->fetchAll(PDO::FETCH_ASSOC);


  $sql4 = "SELECT count(problem_ID) FROM problem WHERE Open_Date BETWEEN $startDate and $endDate"; // Total problems for selected month
  $stmt4 = $con->prepare($sql4);
  $stmt4->execute();
  $result4 = $stmt4->fetchAll(PDO::FETCH_ASSOC);


  $sql5 = "SELECT count(problem_type.software_or_Hardware) as 'Number'
  FROM problem_type
  INNER JOIN problem ON problem_type.Problem_Type_ID = problem.Problem_Type_ID
  WHERE problem_type.Software_Or_Hardware = 6 and
  problem.Open_Date BETWEEN $startDate and $endDate"; //  number of software problems for specific month
  $stmt5 = $con->prepare($sql5);
  $stmt5->execute();
  $result5 = $stmt5->fetchAll(PDO::FETCH_ASSOC);


  $sql3 = "SELECT count(problem_type.software_or_Hardware) as 'Number'
  FROM problem_type
  INNER JOIN problem ON problem_type.Problem_Type_ID = problem.Problem_Type_ID
  WHERE problem_type.Software_Or_Hardware = 7 and
  problem.Open_Date BETWEEN $startDate and $endDate"; // number of hardware problems for specific month
  $stmt3 = $con->prepare($sql3);
  $stmt3->execute();
  $result3 = $stmt3->fetchAll(PDO::FETCH_ASSOC);

  $sql7 = "SELECT Average_Time, Number_Solved, Problems_Assigned, Busy FROM specialist
  WHERE Account_ID = 2"; //Breakdown of individual specialist
  $stmt7 = $con->prepare($sql7);
  $stmt7->execute();
  $result7 = $stmt7->fetchAll(PDO::FETCH_ASSOC);


  $sql8 = "SELECT sum(TIMESTAMPDIFF(hour, problem.Open_Date, problem.Close_Date))/ count(problem_type.software_or_Hardware) AS averageTime
  FROM Problem INNER JOIN problem_type ON problem_type.Problem_Type_ID = problem.Problem_Type_ID WHERE problem.Close_Date IS NOT NULL
  and problem_type.Software_Or_Hardware = 6 and problem.Open_Date BETWEEN $startDate and $endDate"; // average time to complete
  $stmt8 = $con->prepare($sql8);
  $stmt8->execute();
  $result8 = $stmt8->fetchAll(PDO::FETCH_ASSOC);

  $sql15 = "SELECT sum(TIMESTAMPDIFF(hour, problem.Open_Date, problem.Close_Date))/ count(problem_type.software_or_Hardware) AS averageTime
  FROM Problem INNER JOIN problem_type ON problem_type.Problem_Type_ID = problem.Problem_Type_ID WHERE problem.Close_Date IS NOT NULL
  and problem_type.Software_Or_Hardware = 7 and problem.Open_Date BETWEEN $startDate and $endDate"; // average time to complete
  $stmt15 = $con->prepare($sql15);
  $stmt15->execute();
  $result15 = $stmt15->fetchAll(PDO::FETCH_ASSOC);

  $startDate = date('2017/m/01');
  $endDate = date('2017/m/t');
  $sqlSoftwareOverview = "SELECT count(problem_type.software_or_Hardware) as 'Number'
  FROM problem_type
  INNER JOIN problem ON problem_type.Problem_Type_ID = problem.Problem_Type_ID
  WHERE problem_type.Software_Or_Hardware = 6 and
  problem.Open_Date BETWEEN '2017/01/01' and '2017/01/31'
  UNION ALL
  SELECT count(problem_type.software_or_Hardware) as 'Number'
  FROM problem_type
  INNER JOIN problem ON problem_type.Problem_Type_ID = problem.Problem_Type_ID
  WHERE problem_type.Software_Or_Hardware = 6 and
  problem.Open_Date BETWEEN '2017/02/01' and '2017/02/31'
  UNION ALL
  SELECT count(problem_type.software_or_Hardware) as 'Number'
  FROM problem_type
  INNER JOIN problem ON problem_type.Problem_Type_ID = problem.Problem_Type_ID
  WHERE problem_type.Software_Or_Hardware = 6 and
  problem.Open_Date BETWEEN '2017/03/01' and '2017/03/31'
  UNION ALL
  SELECT count(problem_type.software_or_Hardware) as 'Number'
  FROM problem_type
  INNER JOIN problem ON problem_type.Problem_Type_ID = problem.Problem_Type_ID
  WHERE problem_type.Software_Or_Hardware = 6 and
  problem.Open_Date BETWEEN '2017/04/01' and '2017/04/31'
  UNION ALL
  SELECT count(problem_type.software_or_Hardware) as 'Number'
  FROM problem_type
  INNER JOIN problem ON problem_type.Problem_Type_ID = problem.Problem_Type_ID
  WHERE problem_type.Software_Or_Hardware = 6 and
  problem.Open_Date BETWEEN '2017/05/01' and '2017/05/31'
  UNION ALL
  SELECT count(problem_type.software_or_Hardware) as 'Number'
  FROM problem_type
  INNER JOIN problem ON problem_type.Problem_Type_ID = problem.Problem_Type_ID
  WHERE problem_type.Software_Or_Hardware = 6 and
  problem.Open_Date BETWEEN '2017/06/01' and '2017/06/31'
  UNION ALL
  SELECT count(problem_type.software_or_Hardware) as 'Number'
  FROM problem_type
  INNER JOIN problem ON problem_type.Problem_Type_ID = problem.Problem_Type_ID
  WHERE problem_type.Software_Or_Hardware = 6 and
  problem.Open_Date BETWEEN '2017/07/01' and '2017/07/31'
  UNION ALL
  SELECT count(problem_type.software_or_Hardware) as 'Number'
  FROM problem_type
  INNER JOIN problem ON problem_type.Problem_Type_ID = problem.Problem_Type_ID
  WHERE problem_type.Software_Or_Hardware = 6 and
  problem.Open_Date BETWEEN '2017/08/01' and '2017/08/31'
  UNION ALL
  SELECT count(problem_type.software_or_Hardware) as 'Number'
  FROM problem_type
  INNER JOIN problem ON problem_type.Problem_Type_ID = problem.Problem_Type_ID
  WHERE problem_type.Software_Or_Hardware = 6 and
  problem.Open_Date BETWEEN '2017/09/01' and '2017/09/31'
  UNION ALL
  SELECT count(problem_type.software_or_Hardware) as 'Number'
  FROM problem_type
  INNER JOIN problem ON problem_type.Problem_Type_ID = problem.Problem_Type_ID
  WHERE problem_type.Software_Or_Hardware = 6 and
  problem.Open_Date BETWEEN '2017/10/01' and '2017/10/31'
  UNION ALL
  SELECT count(problem_type.software_or_Hardware) as 'Number'
  FROM problem_type
  INNER JOIN problem ON problem_type.Problem_Type_ID = problem.Problem_Type_ID
  WHERE problem_type.Software_Or_Hardware = 6 and
  problem.Open_Date BETWEEN '2017/11/01' and '2017/11/31'
  UNION ALL
  SELECT count(problem_type.software_or_Hardware) as 'Number'
  FROM problem_type
  INNER JOIN problem ON problem_type.Problem_Type_ID = problem.Problem_Type_ID
  WHERE problem_type.Software_Or_Hardware = 6 and
  problem.Open_Date BETWEEN '2017/12/01' and '2017/12/31'"; //  number of software problems for specific month
  $stmtSoftwareOverview = $con->prepare($sqlSoftwareOverview);
  $stmtSoftwareOverview->execute();
  while($row = $stmtSoftwareOverview->fetch(PDO::FETCH_ASSOC)) {
      $arrSWOverview[] = $row['Number'];
  }
  $sqlHardwareOverview = "SELECT count(problem_type.software_or_Hardware) as 'Number'
  FROM problem_type
  INNER JOIN problem ON problem_type.Problem_Type_ID = problem.Problem_Type_ID
  WHERE problem_type.Software_Or_Hardware = 7 and
  problem.Open_Date BETWEEN '2017/01/01' and '2017/01/31'
  UNION ALL
  SELECT count(problem_type.software_or_Hardware) as 'Number'
  FROM problem_type
  INNER JOIN problem ON problem_type.Problem_Type_ID = problem.Problem_Type_ID
  WHERE problem_type.Software_Or_Hardware = 7 and
  problem.Open_Date BETWEEN '2017/02/01' and '2017/02/31'
  UNION ALL
  SELECT count(problem_type.software_or_Hardware) as 'Number'
  FROM problem_type
  INNER JOIN problem ON problem_type.Problem_Type_ID = problem.Problem_Type_ID
  WHERE problem_type.Software_Or_Hardware = 7 and
  problem.Open_Date BETWEEN '2017/03/01' and '2017/03/31'
  UNION ALL
  SELECT count(problem_type.software_or_Hardware) as 'Number'
  FROM problem_type
  INNER JOIN problem ON problem_type.Problem_Type_ID = problem.Problem_Type_ID
  WHERE problem_type.Software_Or_Hardware = 7 and
  problem.Open_Date BETWEEN '2017/04/01' and '2017/04/31'
  UNION ALL
  SELECT count(problem_type.software_or_Hardware) as 'Number'
  FROM problem_type
  INNER JOIN problem ON problem_type.Problem_Type_ID = problem.Problem_Type_ID
  WHERE problem_type.Software_Or_Hardware = 7 and
  problem.Open_Date BETWEEN '2017/05/01' and '2017/05/31'
  UNION ALL
  SELECT count(problem_type.software_or_Hardware) as 'Number'
  FROM problem_type
  INNER JOIN problem ON problem_type.Problem_Type_ID = problem.Problem_Type_ID
  WHERE problem_type.Software_Or_Hardware = 7 and
  problem.Open_Date BETWEEN '2017/06/01' and '2017/06/31'
  UNION ALL
  SELECT count(problem_type.software_or_Hardware) as 'Number'
  FROM problem_type
  INNER JOIN problem ON problem_type.Problem_Type_ID = problem.Problem_Type_ID
  WHERE problem_type.Software_Or_Hardware = 7 and
  problem.Open_Date BETWEEN '2017/07/01' and '2017/07/31'
  UNION ALL
  SELECT count(problem_type.software_or_Hardware) as 'Number'
  FROM problem_type
  INNER JOIN problem ON problem_type.Problem_Type_ID = problem.Problem_Type_ID
  WHERE problem_type.Software_Or_Hardware = 7 and
  problem.Open_Date BETWEEN '2017/08/01' and '2017/08/31'
  UNION ALL
  SELECT count(problem_type.software_or_Hardware) as 'Number'
  FROM problem_type
  INNER JOIN problem ON problem_type.Problem_Type_ID = problem.Problem_Type_ID
  WHERE problem_type.Software_Or_Hardware = 7 and
  problem.Open_Date BETWEEN '2017/09/01' and '2017/09/31'
  UNION ALL
  SELECT count(problem_type.software_or_Hardware) as 'Number'
  FROM problem_type
  INNER JOIN problem ON problem_type.Problem_Type_ID = problem.Problem_Type_ID
  WHERE problem_type.Software_Or_Hardware = 7 and
  problem.Open_Date BETWEEN '2017/10/01' and '2017/10/31'
  UNION ALL
  SELECT count(problem_type.software_or_Hardware) as 'Number'
  FROM problem_type
  INNER JOIN problem ON problem_type.Problem_Type_ID = problem.Problem_Type_ID
  WHERE problem_type.Software_Or_Hardware = 7 and
  problem.Open_Date BETWEEN '2017/11/01' and '2017/11/31'
  UNION ALL
  SELECT count(problem_type.software_or_Hardware) as 'Number'
  FROM problem_type
  INNER JOIN problem ON problem_type.Problem_Type_ID = problem.Problem_Type_ID
  WHERE problem_type.Software_Or_Hardware = 7 and
  problem.Open_Date BETWEEN '2017/12/01' and '2017/12/31'
  "; // number of hardware problems for specific month
  $stmtHardwareOverview = $con->prepare($sqlHardwareOverview);
  $stmtHardwareOverview->execute();
  while($row = $stmtHardwareOverview->fetch(PDO::FETCH_ASSOC)) {
      $arrHWOverview[] = $row['Number'];
  }
  $sql = "SELECT Problem_Type.Problem_Type_Name as 'Software', count(Problem.Problem_Type_ID)
  as 'Number_of_Problems' FROM Problem_Type
  INNER JOIN Problem ON Problem_Type.Problem_Type_ID = Problem.Problem_Type_ID
  WHERE Problem_Type.Software_Or_Hardware = 6 and Problem_Type.Parent_Problem_ID
  IS NOT NULL and Problem.Open_Date
  BETWEEN $startDate and $endDate
  GROUP BY Problem.Problem_Type_ID";//breakdown of software problems
  $stmt = $con->prepare($sql);
  $stmt->execute();
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $arrSoftwareLabels[] = $row['Software'];
    $arrSoftwareData[] = $row['Number_of_Problems'];
  }
  $sql2 = "SELECT problem_type.Problem_Type_Name as 'Hardware', count(problem.Problem_Type_ID) as 'Number_of_Problems'
  FROM problem_type
  INNER JOIN problem ON problem_type.Problem_Type_ID = problem.Problem_Type_ID
  WHERE problem_type.Software_Or_Hardware = 7 and
  problem_type.Parent_Problem_ID IS NOT NULL and
  problem.Open_Date BETWEEN $startDate and $endDate
  group by problem.Problem_Type_ID"; //breakdown of hardware problems
  $stmt2 = $con ->prepare($sql2);
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
      <h1 class="animated fadeInUp">Total Problems for January: <?php echo $result4['count(Problem_ID)']; ?></h1>
      <h3 class="graph__subtitle">Average time to close: <?php echo secondsToTime(ceil($average)); ?></h3>
      <h3 class="graph__subtitle animated fadeInUp">Closed Problems: <?php echo $result9['closed']; ?>, Open Problems: <?php echo $result9['open']; ?>, Pending Problems: <?php echo $result9['pending']; ?></h3>
      <div class="graph__container animated fadeIn">
        <div class="graph graph1">
          <h1 class="graph__title animated fadeInUp">Total Problems</h1>
          <h3 class="graph__subtitle animated fadeInUp">Breakdown of Total Problems</h3>
          <canvas id="myChart" width="400" height="200"></canvas>
          <h1 class="graph__title animated fadeInUp">Problem Overview</h1>
          <h3 class="graph__subtitle animated fadeInUp">Breakdown of Problems with Average Time</h3>
            <table class="problem__table">
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
          <h1 class="graph__title">Overview</h1>
          <h3 class="graph__subtitle">A summary of specialist's performance</h3>
        </div>
        <div class="overview">

		<p>
      <?php echo $result7['Average_Time'] . '<br />' .  $result7['Number_Solved'] . '<br />' . $result7['Problems_Assigned'] . '<br />' . $result7['Problems_Assigned'] . '<br />'?>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/slideout/1.0.1/slideout.min.js"></script>
<script>
var arrSoftwareLabels = <?php echo json_encode($arrSoftwareLabels); ?>;
console.log(arrSoftwareLabels);
var arrSoftwareData = <?php echo json_encode($arrSoftwareData, JSON_NUMERIC_CHECK); ?>;
console.log(arrSoftwareData);
var arrHardwareLabels = <?php echo json_encode($arrHardwareLabels); ?>;
console.log(arrHardwareLabels);
var arrHardwareData = <?php echo json_encode($arrHardwareData, JSON_NUMERIC_CHECK); ?>;
console.log(arrHardwareData);
var arrSoftwareOverview = <?php echo json_encode($arrSWOverview, JSON_NUMERIC_CHECK); ?>;
console.log(arrSoftwareOverview);
var arrHardwareOverview = <?php echo json_encode($arrHWOverview, JSON_NUMERIC_CHECK); ?>;
console.log(arrHardwareOverview);
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
