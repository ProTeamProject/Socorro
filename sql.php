<?php include_once 'includes/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Socorro</title>
</head>
<body>
<?php


include 'includes/db.php';

/*$sql = "SELECT TIMESTAMPDIFF(second, Open_Date, Close_Date) AS DateDiff FROM Problem WHERE Close_Date IS NOT NULL"; // works out time in seconds for problem completion
$stmt = $con->prepare($sql);
$stmt->execute();
$count = $stmt->rowCount();
$sum = 0;
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
  $sum += $row['DateDiff'];
}
$average = $sum/$count;
echo secondsToTime($average);

function secondsToTime($seconds) {
    $dtF = new \DateTime('@0');
    $dtT = new \DateTime("@$seconds");
    return $dtF->diff($dtT)->format('%a days, %h hours, %i minutes and %s seconds');
}

$sql2 = "SELECT state,count(state) as count FROM Problem WHERE state IN ('open','pending','closed') GROUP BY state" // total, closed, open and pending problems
$stmt2 = $con->prepare($sql2);
$stmt2->execute();

SELECT count(problem_ID) FROM problem WHERE Open_Date BETWEEN '2017/10/01' and '2017/10/31' // Total problems for selected month */

/*SELECT count(problem_type.software_or_Hardware) as 'Number_Of_Software'
FROM problem_type
INNER JOIN problem ON problem_type.Problem_Type_ID = problem.Problem_Type_ID
WHERE problem_type.Software_Or_Hardware = 6 and
problem.Open_Date BETWEEN '2017/10/01' and '2017/10/31'"); //  number of software problems for specific month
*/



/*SELECT count(problem_type.software_or_Hardware) as 'Number_Of_Hardware'
FROM problem_type
INNER JOIN problem ON problem_type.Problem_Type_ID = problem.Problem_Type_ID
WHERE problem_type.Software_Or_Hardware = 7 and
problem.Open_Date BETWEEN '2017/10/01' and '2017/10/31' // number of hardware problems for specific month


SELECT Average_Time, Number_Solved, Problems_Assigned, Busy FROM specialist
WHERE Account_ID = 2 //Breakdown of individual specialist

SELECT sum(TIMESTAMPDIFF(hour, problem.Open_Date, problem.Close_Date))/ count(problem_type.software_or_Hardware) AS averageTime
FROM Problem INNER JOIN problem_type ON problem_type.Problem_Type_ID = problem.Problem_Type_ID WHERE problem.Close_Date IS NOT NULL
and problem_type.Software_Or_Hardware = 7 and problem.Open_Date BETWEEN '2017/10/01' and '2017/10/31' // average time to complete */


$sqlSoftwareOverview = "SELECT count(problem_type.software_or_Hardware) as 'Number_Of_Software'
FROM problem_type
INNER JOIN problem ON problem_type.Problem_Type_ID = problem.Problem_Type_ID
WHERE problem_type.Software_Or_Hardware = 6 and
problem.Open_Date BETWEEN '2017/10/01' and '2017/10/31'"; //  number of software problems for specific month

$stmtSoftwareOverview = $con->prepare($sqlSoftwareOverview);
$stmtSoftwareOverview->execute();
$resultSoftwareOverview = $stmtSoftwareOverview->fetchAll(PDO::FETCH_ASSOC);

$sqlHardwarOverview = "SELECT count(problem_type.software_or_Hardware) as 'Number_Of_Hardware'
FROM problem_type
INNER JOIN problem ON problem_type.Problem_Type_ID = problem.Problem_Type_ID
WHERE problem_type.Software_Or_Hardware = 7 and
problem.Open_Date BETWEEN '2017/10/01' and '2017/10/31'" // number of hardware problems for specific month

$stmtHardwareOverview = $con->prepare($sqlHardwarOverview);
$stmtHardwareOverview->execute();
$resultHardwareOverview = $stmtHardwareOverview->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT Problem_Type.Problem_Type_Name as 'Software', count(Problem.Problem_Type_ID)
as 'Number of Problems' FROM Problem_Type
INNER JOIN Problem ON Problem_Type.Problem_Type_ID = Problem.Problem_Type_ID
WHERE Problem_Type.Software_Or_Hardware = 6 and Problem_Type.Parent_Problem_ID
IS NOT NULL and Problem.Open_Date
BETWEEN '2017/10/01' and '2017/10/31'
GROUP BY Problem.Problem_Type_ID";//breakdown of software problems

$stmt = $con->prepare($sql);
$stmt->execute();

$resultSoftware = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql2 = "SELECT problem_type.Problem_Type_Name as 'Hardware', count(problem.Problem_Type_ID) as 'Number of Problems'
FROM problem_type
INNER JOIN problem ON problem_type.Problem_Type_ID = problem.Problem_Type_ID
WHERE problem_type.Software_Or_Hardware = 7 and
problem_type.Parent_Problem_ID IS NOT NULL and
problem.Open_Date BETWEEN '2017/10/01' and '2017/10/31'
group by problem.Problem_Type_ID"; //breakdown of hardware problems

$stmt2 = $con ->prepare($sql2);
$stmt2->execute();

$resultHardware = $stmt2->fetchAll(PDO::FETCH_ASSOC);
?>
</body>
<script>

var arrSoftware = <?= json_encode($resultSoftware); ?>;
console.log(arrSoftware);
var arrHardware = <?= json_encode($resultHardware); ?>;
console.log(arrHardware);
var arrHardwareOverview = <?= json_encode($resultHardwareOverview); ?>;
console.log(arrHardwareOverview);
var arrSoftwareOverview = <?= json_encode($resultSoftwareOverview); ?>;
console.log(arrSoftwareOverview);

</script>
</html>
