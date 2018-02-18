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

/*$sql6 = "SELECT TIMESTAMPDIFF(second, Open_Date, Close_Date) AS DateDiff FROM Problem WHERE Close_Date IS NOT NULL"; // works out time in seconds for problem completion
$stmt6 = $con->prepare($sql6);
$stmt->execute();
$count = $stmt6->rowCount();
$sum = 0;
while($row = $stmt6->fetch(PDO::FETCH_ASSOC)) {
  $sum += $row['DateDiff'];
}
$average = $sum/$count;
echo secondsToTime($average);

function secondsToTime($seconds) {
    $dtF = new \DateTime('@0');
    $dtT = new \DateTime("@$seconds");
    return $dtF->diff($dtT)->format('%a days, %h hours, %i minutes and %s seconds');
}
*/
/*
$sql9 = "SELECT state,count(state) as count FROM Problem WHERE state IN ('open','pending','closed') GROUP BY state" // total, closed, open and pending problems
$stmt9 = $con->prepare($sql9);
$stmt9->execute();
$result9 = $stmt9->fetchAll(PDO::FETCH_ASSOC);
*/
/*
$sql4 = "SELECT count(problem_ID) FROM problem WHERE Open_Date BETWEEN '2017/10/01' and '2017/10/31'" // Total problems for selected month 
$stmt4 = $con->prepare($sql4);
$stmt4->execute();
$result4 = $stmt4->fetchAll(PDO::FETCH_ASSOC);
*/
/*
$sql5 = "SELECT count(problem_type.software_or_Hardware) as 'Number_Of_Software'
FROM problem_type
INNER JOIN problem ON problem_type.Problem_Type_ID = problem.Problem_Type_ID
WHERE problem_type.Software_Or_Hardware = 6 and
problem.Open_Date BETWEEN '2017/10/01' and '2017/10/31';" //  number of software problems for specific month
$stmt5 = $con->prepare($sql5);
$stmt5->execute();
$result5 = $stmt5->fetchAll(PDO::FETCH_ASSOC);
*/

/*
$sql3 = "SELECT count(problem_type.software_or_Hardware) as 'Number_Of_Hardware'
FROM problem_type
INNER JOIN problem ON problem_type.Problem_Type_ID = problem.Problem_Type_ID
WHERE problem_type.Software_Or_Hardware = 7 and
problem.Open_Date BETWEEN '2017/10/01' and '2017/10/31'" // number of hardware problems for specific month
$stmt3 = $con->prepare($sql3);
$stmt3->execute();
$result3 = $stmt3->fetchAll(PDO::FETCH_ASSOC);
*/
/*
$sql7 = "SELECT Average_Time, Number_Solved, Problems_Assigned, Busy FROM specialist
WHERE Account_ID = 2" //Breakdown of individual specialist
$stmt7 = $con->prepare($sql7);
$stmt7->execute();
$result7 = $stmt7->fetchAll(PDO::FETCH_ASSOC);
*/
/*
$sql8 = "SELECT sum(TIMESTAMPDIFF(hour, problem.Open_Date, problem.Close_Date))/ count(problem_type.software_or_Hardware) AS averageTime
FROM Problem INNER JOIN problem_type ON problem_type.Problem_Type_ID = problem.Problem_Type_ID WHERE problem.Close_Date IS NOT NULL
and problem_type.Software_Or_Hardware = 7 and problem.Open_Date BETWEEN '2017/10/01' and '2017/10/31'" // average time to complete 
$stmt8 = $con->prepare($sql8);
$stmt8->execute();
$result8 = $stmt8->fetchAll(PDO::FETCH_ASSOC);
*/
$startDate = date('2017/m/01');
$endDate = date('2017/m/t');

$sqlSoftwareOverview = "SELECT count(problem_type.software_or_Hardware) as 'Number_Of_Software'
FROM problem_type
INNER JOIN problem ON problem_type.Problem_Type_ID = problem.Problem_Type_ID
WHERE problem_type.Software_Or_Hardware = 6 and
problem.Open_Date BETWEEN '2017/01/01' and '2017/01/31'
UNION ALL
SELECT count(problem_type.software_or_Hardware) as 'Number_Of_Software'
FROM problem_type
INNER JOIN problem ON problem_type.Problem_Type_ID = problem.Problem_Type_ID
WHERE problem_type.Software_Or_Hardware = 6 and
problem.Open_Date BETWEEN '2017/02/01' and '2017/02/31'
UNION ALL 
SELECT count(problem_type.software_or_Hardware) as 'Number_Of_Software'
FROM problem_type
INNER JOIN problem ON problem_type.Problem_Type_ID = problem.Problem_Type_ID
WHERE problem_type.Software_Or_Hardware = 6 and
problem.Open_Date BETWEEN '2017/03/01' and '2017/03/31'
UNION ALL 
SELECT count(problem_type.software_or_Hardware) as 'Number_Of_Software'
FROM problem_type
INNER JOIN problem ON problem_type.Problem_Type_ID = problem.Problem_Type_ID
WHERE problem_type.Software_Or_Hardware = 6 and
problem.Open_Date BETWEEN '2017/04/01' and '2017/04/31'
UNION ALL 
SELECT count(problem_type.software_or_Hardware) as 'Number_Of_Software'
FROM problem_type
INNER JOIN problem ON problem_type.Problem_Type_ID = problem.Problem_Type_ID
WHERE problem_type.Software_Or_Hardware = 6 and
problem.Open_Date BETWEEN '2017/05/01' and '2017/05/31'
UNION ALL 
SELECT count(problem_type.software_or_Hardware) as 'Number_Of_Software'
FROM problem_type
INNER JOIN problem ON problem_type.Problem_Type_ID = problem.Problem_Type_ID
WHERE problem_type.Software_Or_Hardware = 6 and
problem.Open_Date BETWEEN '2017/06/01' and '2017/06/31'
UNION ALL 
SELECT count(problem_type.software_or_Hardware) as 'Number_Of_Software'
FROM problem_type
INNER JOIN problem ON problem_type.Problem_Type_ID = problem.Problem_Type_ID
WHERE problem_type.Software_Or_Hardware = 6 and
problem.Open_Date BETWEEN '2017/07/01' and '2017/07/31'
UNION ALL 
SELECT count(problem_type.software_or_Hardware) as 'Number_Of_Software'
FROM problem_type
INNER JOIN problem ON problem_type.Problem_Type_ID = problem.Problem_Type_ID
WHERE problem_type.Software_Or_Hardware = 6 and
problem.Open_Date BETWEEN '2017/08/01' and '2017/08/31'
UNION ALL 
SELECT count(problem_type.software_or_Hardware) as 'Number_Of_Software'
FROM problem_type
INNER JOIN problem ON problem_type.Problem_Type_ID = problem.Problem_Type_ID
WHERE problem_type.Software_Or_Hardware = 6 and
problem.Open_Date BETWEEN '2017/09/01' and '2017/09/31'
UNION ALL 
SELECT count(problem_type.software_or_Hardware) as 'Number_Of_Software'
FROM problem_type
INNER JOIN problem ON problem_type.Problem_Type_ID = problem.Problem_Type_ID
WHERE problem_type.Software_Or_Hardware = 6 and
problem.Open_Date BETWEEN '2017/10/01' and '2017/10/31'
UNION ALL 
SELECT count(problem_type.software_or_Hardware) as 'Number_Of_Software'
FROM problem_type
INNER JOIN problem ON problem_type.Problem_Type_ID = problem.Problem_Type_ID
WHERE problem_type.Software_Or_Hardware = 6 and
problem.Open_Date BETWEEN '2017/11/01' and '2017/11/31'
UNION ALL 
SELECT count(problem_type.software_or_Hardware) as 'Number_Of_Software'
FROM problem_type
INNER JOIN problem ON problem_type.Problem_Type_ID = problem.Problem_Type_ID
WHERE problem_type.Software_Or_Hardware = 6 and
problem.Open_Date BETWEEN '2017/12/01' and '2017/12/31'



"; //  number of software problems for specific month

$stmtSoftwareOverview = $con->prepare($sqlSoftwareOverview);
$stmtSoftwareOverview->execute();
$resultSoftwareOverview = $stmtSoftwareOverview->fetchAll(PDO::FETCH_ASSOC);

$sqlHardwareOverview = "SELECT count(problem_type.software_or_Hardware) as 'Number_Of_Hardware'
FROM problem_type
INNER JOIN problem ON problem_type.Problem_Type_ID = problem.Problem_Type_ID
WHERE problem_type.Software_Or_Hardware = 7 and
problem.Open_Date BETWEEN '2017/01/01' and '2017/01/31'
UNION ALL
SELECT count(problem_type.software_or_Hardware) as 'Number_Of_Hardware'
FROM problem_type
INNER JOIN problem ON problem_type.Problem_Type_ID = problem.Problem_Type_ID
WHERE problem_type.Software_Or_Hardware = 7 and
problem.Open_Date BETWEEN '2017/02/01' and '2017/02/31'
UNION ALL
SELECT count(problem_type.software_or_Hardware) as 'Number_Of_Hardware'
FROM problem_type
INNER JOIN problem ON problem_type.Problem_Type_ID = problem.Problem_Type_ID
WHERE problem_type.Software_Or_Hardware = 7 and
problem.Open_Date BETWEEN '2017/03/01' and '2017/03/31'
UNION ALL
SELECT count(problem_type.software_or_Hardware) as 'Number_Of_Hardware'
FROM problem_type
INNER JOIN problem ON problem_type.Problem_Type_ID = problem.Problem_Type_ID
WHERE problem_type.Software_Or_Hardware = 7 and
problem.Open_Date BETWEEN '2017/04/01' and '2017/04/31'
UNION ALL
SELECT count(problem_type.software_or_Hardware) as 'Number_Of_Hardware'
FROM problem_type
INNER JOIN problem ON problem_type.Problem_Type_ID = problem.Problem_Type_ID
WHERE problem_type.Software_Or_Hardware = 7 and
problem.Open_Date BETWEEN '2017/05/01' and '2017/05/31'
UNION ALL
SELECT count(problem_type.software_or_Hardware) as 'Number_Of_Hardware'
FROM problem_type
INNER JOIN problem ON problem_type.Problem_Type_ID = problem.Problem_Type_ID
WHERE problem_type.Software_Or_Hardware = 7 and
problem.Open_Date BETWEEN '2017/06/01' and '2017/06/31'
UNION ALL
SELECT count(problem_type.software_or_Hardware) as 'Number_Of_Hardware'
FROM problem_type
INNER JOIN problem ON problem_type.Problem_Type_ID = problem.Problem_Type_ID
WHERE problem_type.Software_Or_Hardware = 7 and
problem.Open_Date BETWEEN '2017/07/01' and '2017/07/31'
UNION ALL
SELECT count(problem_type.software_or_Hardware) as 'Number_Of_Hardware'
FROM problem_type
INNER JOIN problem ON problem_type.Problem_Type_ID = problem.Problem_Type_ID
WHERE problem_type.Software_Or_Hardware = 7 and
problem.Open_Date BETWEEN '2017/08/01' and '2017/08/31'
UNION ALL
SELECT count(problem_type.software_or_Hardware) as 'Number_Of_Hardware'
FROM problem_type
INNER JOIN problem ON problem_type.Problem_Type_ID = problem.Problem_Type_ID
WHERE problem_type.Software_Or_Hardware = 7 and
problem.Open_Date BETWEEN '2017/09/01' and '2017/09/31'
UNION ALL
SELECT count(problem_type.software_or_Hardware) as 'Number_Of_Hardware'
FROM problem_type
INNER JOIN problem ON problem_type.Problem_Type_ID = problem.Problem_Type_ID
WHERE problem_type.Software_Or_Hardware = 7 and
problem.Open_Date BETWEEN '2017/10/01' and '2017/10/31'
UNION ALL
SELECT count(problem_type.software_or_Hardware) as 'Number_Of_Hardware'
FROM problem_type
INNER JOIN problem ON problem_type.Problem_Type_ID = problem.Problem_Type_ID
WHERE problem_type.Software_Or_Hardware = 7 and
problem.Open_Date BETWEEN '2017/11/01' and '2017/11/31'
UNION ALL
SELECT count(problem_type.software_or_Hardware) as 'Number_Of_Hardware'
FROM problem_type
INNER JOIN problem ON problem_type.Problem_Type_ID = problem.Problem_Type_ID
WHERE problem_type.Software_Or_Hardware = 7 and
problem.Open_Date BETWEEN '2017/12/01' and '2017/12/31'
"; // number of hardware problems for specific month

$stmtHardwareOverview = $con->prepare($sqlHardwareOverview);
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

var arrSoftwareOverview = <?= json_encode($resultSoftwareOverview); ?>;
console.log(arrSoftwareOverview);

var arrHardwareOverview = <?= json_encode($resultHardwareOverview); ?>;
console.log(arrHardwareOverview);

var arrSoftware2 = [];
var arrHardware2 = [];
var arrSoftwareOverview2 = [];
var arrHardwareOverview2 = [];

for(var a in arrSoftware){
	arrSoftware2.push(arrSoftware[a]);
}

for(var b in arrHardware){
	arrHardware2.push(arrHardware[b]);
}

for(var c in arrSoftwareOverview){
	arrSoftwareOverview2.push(arrSoftwareOverview[c]);
}

for (var d in arrHardwareOverview) {
	arrHardwareOverview2.push(arrHardwareOverview[d]);
}


console.log(arrSoftwareOverview2);
</script>
</html>