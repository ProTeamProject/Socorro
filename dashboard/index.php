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
  <title>Socorro - Dashboard</title>
  <link rel="stylesheet" type="text/css" href="../css/style.css" />
  <link rel="stylesheet" type="text/css" href="../css/form.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
  <link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500" rel="stylesheet">
</head>

<body>
  <?php
  $uid = $_SESSION['u_id'];

  if (isset($_SESSION['u_type'])) {
    //change to operator
    if ($_SESSION['u_type'] == 'operator') {
      $sql = "SELECT Problem.Problem_ID, Employee.Caller_Name, Problem.Open_date, MAX(Problem_Status.Status_Date) As Status_Date, Problem_Type.Problem_Type_Name, Problem.state
    FROM Problem
    LEFT JOIN Employee on Employee.Caller_ID = Problem.Caller_ID
    LEFT JOIN Problem_Status on Problem_Status.Problem_ID = Problem.Problem_ID
    LEFT JOIN Problem_Type on Problem_Type.Problem_Type_ID = Problem.Problem_Type_ID GROUP BY Problem.Problem_ID, Employee.Caller_Name, Problem.Open_date, Problem_Type.Problem_Type_Name, Problem.state ORDER BY Problem.Open_date desc ";
      $sql2 = "SELECT Problem.Problem_ID, Employee.Caller_Name, Problem.Open_date, MAX(Problem_Status.Status_Date) As Status_Date, Problem_Type.Problem_Type_Name, Problem.state
    FROM Problem
    LEFT JOIN Employee on Employee.Caller_ID = Problem.Caller_ID
    LEFT JOIN Problem_Status on Problem_Status.Problem_ID = Problem.Problem_ID
    LEFT JOIN Problem_Type on Problem_Type.Problem_Type_ID = Problem.Problem_Type_ID
    WHERE Problem.state != 'closed' GROUP BY Problem.Problem_ID, Employee.Caller_Name, Problem.Open_date, Problem_Type.Problem_Type_Name, Problem.state ORDER BY Problem.Open_date asc";

      $stmt = $con->prepare($sql);
      $stmt->bindParam(':output', $output, PDO::PARAM_INT);
      $stmt->execute();
      $stmt2 = $con->prepare($sql2);
      $stmt2->execute();

    } else if ($_SESSION['u_type'] == 'specialist') {

      $sql = "SELECT Problem.Problem_ID, Employee.Caller_Name, Problem.Open_date, MAX(Problem_Status.Status_Date) As Status_Date, Problem_Type.problem_type_name, Problem.state FROM Problem INNER JOIN Employee on Employee.Caller_ID = Problem.Caller_ID INNER JOIN Problem_Status on Problem_Status.Problem_ID = Problem.Problem_ID INNER JOIN Problem_Type on Problem_Type.Problem_Type_ID = Problem.Problem_Type_ID and Problem.Specialist_Account_ID = :uid GROUP BY Problem.Problem_ID, Employee.Caller_Name, Problem.Open_date, Problem_Type.Problem_Type_Name, Problem.state ORDER BY Problem.Open_date desc";
      $sql2 = "SELECT Problem.Problem_ID, Employee.Caller_Name, Problem.Open_date, MAX(Problem_Status.Status_Date) As Status_Date, Problem_Type.problem_type_name, Problem.state FROM Problem INNER JOIN Employee on Employee.Caller_ID = Problem.Caller_ID INNER JOIN Problem_Status on Problem_Status.Problem_ID = Problem.Problem_ID INNER JOIN Problem_Type on Problem_Type.Problem_Type_ID = Problem.Problem_Type_ID and Problem.Specialist_Account_ID = :uid WHERE Problem.State != 'closed' GROUP BY Problem.Problem_ID, Employee.Caller_Name, Problem.Open_date, Problem_Type.Problem_Type_Name, Problem.state ORDER BY Problem.Open_date asc";

    $stmt = $con->prepare($sql);
    $stmt->bindParam(':uid', $uid);
    $stmt->execute();
    $stmt2 = $con->prepare($sql2);
    $stmt2->bindParam(':uid', $uid);
    $stmt2->execute();
    }
  }

?>
<?php include '../header.php' ?>

  <main id="panel" class="dashboard__main">
    <section id="dashboard" class="dashboard h-padding-xlarge animated fadeIn">
      <h1 class="animated fadeInUp">Problem Dashboard</h1>

      <div class="dashboard__checkbox__container">
          <div class="checkbox dashboard__checkbox">
          <label class="filter">
            <input type="checkbox" value="open" checked/><i class="helper"></i>Open
          </label>
        </div>
        <div class="checkbox dashboard__checkbox">
        <label class="filter">
          <input type="checkbox" value="pending" checked/><i class="helper"></i>Pending
        </label>
      </div>
      <div class="checkbox dashboard__checkbox">
      <label class="filter">
        <input type="checkbox" value="closed"/><i class="helper"></i>Closed
      </label>
    </div>
      </div>
      <div class="tab-wrap">

    <input type="radio" name="tabs" id="tab1" checked>
    <div class="tab-label-content" id="tab1-content">
      <label class="tab__label" for="tab1">
        <?php if ($_SESSION['u_type'] == 'operator') {
                echo 'Most Recent Problems';
              } else if ($_SESSION['u_type'] == 'specialist') {
                echo 'Recently Assigned Problems';
              }
        ?>
      </label>
      <div class="tab-content">


        <div class="problems animated fadeIn">
          <div class="problem__titles h-padding-small ">
            <p>
              Problem ID
            </p>
            <p>
              Caller Name
            </p>
            <p>
              Date Submitted
            </p>
            <p>
              Last Updated
            </p>
            <p>
              Problem Type
            </p>
            <p>
              State
            </p>
          </div>
          <div class="problems__inner__dash">

            <?php

            // Associative array
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<a class="' . $row['state'] . '"href="/problem/index.php?id=' . $row['Problem_ID'] . '"><div class="problem__entry h-padding-small ' . $row['state']. ' id="problem_27"><p class="pid">#' . $row['Problem_ID'] . '</p><p class="caller__name">' . $row['Caller_Name'] . '</p><p class="date__created">' . date('jS F Y H:i', strtotime($row['Open_date'])) . '</p><p class="updated">' . date('jS F Y H:i', strtotime($row['Status_Date'])) . '</p><p class="problem__type">' . $row['Problem_Type_Name'] . '</p><div class="status__' . $row['state'] . '"><p class="status__text">' . $row['state'] . '</p></div></div></a>';
            }

             ?>

          </div>
        </div>
        <div class="button__container v-padding-mid">
          <div id='loader' class="sk-fading-circle">
            <div class="sk-circle1 sk-circle"></div>
            <div class="sk-circle2 sk-circle"></div>
            <div class="sk-circle3 sk-circle"></div>
            <div class="sk-circle4 sk-circle"></div>
            <div class="sk-circle5 sk-circle"></div>
            <div class="sk-circle6 sk-circle"></div>
            <div class="sk-circle7 sk-circle"></div>
            <div class="sk-circle8 sk-circle"></div>
            <div class="sk-circle9 sk-circle"></div>
            <div class="sk-circle10 sk-circle"></div>
            <div class="sk-circle11 sk-circle"></div>
            <div class="sk-circle12 sk-circle"></div>
          </div>
          <!--<button class="button__load" id="button-load" onclick="loadMore()">Load More</button>-->
        </div>
        <footer class="footer v-padding-xlarge">
          <p>
            ProTeam Project - Team 10
          </p>
        </footer>
      </div>

    </div>

    <input type="radio" name="tabs" id="tab2">
    <div class="tab-label-content" id="tab2-content">
      <label  class="tab__label" for="tab2">
        <?php if ($_SESSION['u_type'] == 'operator') {
                echo 'Longest Unsolved Problems';
              } else if ($_SESSION['u_type'] == 'specialist') {
                echo 'Longest Unsolved Problems';
              }
        ?>
      </label>
      <div class="tab-content">
        <div class="problems animated fadeIn">
          <div class="problem__titles h-padding-small ">
            <p>
              Problem ID
            </p>
            <p>
              Caller Name
            </p>
            <p>
              Date Submitted
            </p>
            <p>
              Last Updated
            </p>
            <p>
              Problem Type
            </p>
            <p>
              State
            </p>
          </div>
          <div class="problems__inner__dash">

            <?php

            while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                echo '<a class="' . $row['state'] . '"href="/problem/index.php?id=' . $row['Problem_ID'] . '"><div class="problem__entry h-padding-small ' . $row['state']. ' id="problem_27"><p class="pid">#' . $row['Problem_ID'] . '</p><p class="caller__name">' . $row['Caller_Name'] . '</p><p class="date__created">' . date('jS F Y H:i', strtotime($row['Open_date'])) . '</p><p class="updated">' . date('jS F Y H:i', strtotime($row['Status_Date'])) . '</p><p class="problem__type">' . $row['Problem_Type_Name'] . '</p><div class="status__' . $row['state'] . '"><p class="status__text">' . $row['state'] . '</p></div></div></a>';
            }

             ?>

          </div>
        </div>
        <div class="button__container v-padding-mid">
          <div id='loader' class="sk-fading-circle">
            <div class="sk-circle1 sk-circle"></div>
            <div class="sk-circle2 sk-circle"></div>
            <div class="sk-circle3 sk-circle"></div>
            <div class="sk-circle4 sk-circle"></div>
            <div class="sk-circle5 sk-circle"></div>
            <div class="sk-circle6 sk-circle"></div>
            <div class="sk-circle7 sk-circle"></div>
            <div class="sk-circle8 sk-circle"></div>
            <div class="sk-circle9 sk-circle"></div>
            <div class="sk-circle10 sk-circle"></div>
            <div class="sk-circle11 sk-circle"></div>
            <div class="sk-circle12 sk-circle"></div>
          </div>
          <!--<button class="button__load" id="button-load" onclick="loadMore()">Load More</button>-->
        </div>
        <footer class="footer v-padding-xlarge">
          <p>
            ProTeam Project - Team 10
          </p>
        </footer>
      </div>
    </div>




    <div class="slide"></div>

</div>


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
