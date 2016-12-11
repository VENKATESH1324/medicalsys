<!DOCTYPE html>
<html>
	<head>
	</head>
<body>
<?php
require_once 'login.php';
require_once 'checkSession.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

$doc_schedule_id = $_GET['id'];
$query = "Select  ds.sch_date,ds.set_time_id,ds.d_first_name,ds.d_last_name, d.id from doctor_schedule ds, doctor d where ds.id = $doc_schedule_id and d.id in (select id from doctor doc where ds.d_first_name = doc.first_name and ds.d_last_name = doc.last_name)";
$result = $conn->query($query);
if (!$result) die($conn->error);
$rows = $result->num_rows;
for ($j = 0 ; $j < $rows ; ++$j){
	$result->data_seek($j);
	$row = $result->fetch_array(MYSQLI_NUM);
	$date = $row['0'];
	$doctor_id = $row['4'];
	$time_id=$row['1']	;
}	
$patient_id = $_SESSION['userid'];


$query = "INSERT into appointments values (default,$patient_id,$doctor_id,$time_id,$doc_schedule_id,'$date')";

 $result = $conn->query($query);		 
  if (!$result) die ("Database access failed: " . $conn->error);
  if($result) echo "You have booked your appointment for " . $date . '<br><br>';
  	
?>

<input type='submit' value="Home" onclick="location = 'patientHome.php'" />

</body>
</html>