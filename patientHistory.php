<!DOCTYPE html>
<html>
<head>
</head>
<style>
</style>
<body>
<table width='800' border='0' cellpadding='2' cellspacing='0'>
<tr>
<th width='150' align='left'> Appointment </th>
<th width='150' align='left'> Doctor </th>
<th width='150' align='left'> Problems </th>
<th width='150' align='left'> Treatment </th>
<th width='150' align='left'> Notes </th>
</tr>
<?php
	$id=$_GET['id']; 
	
	require_once 'login.php';
	require_once 'checkSession.php';
	$conn = new mysqli($hn, $un, $pw, $db);
	if ($conn->connect_error) die($conn->connect_error);
		
	$query = "Select ph.problems,ph.treatment, ph.notes, d.first_name,d.last_name, a.schedule_date from patient_history ph left outer join appointments a on ph.appointment_id = a.id left outer join doctor d on a.doctor_id = d.id where ph.patient_id=$id order by a.schedule_date desc";
	
	$result = $conn->query($query);
	if (!$result) die($conn->error);
	$rows = $result->num_rows;
	
	for ($j = 0 ; $j < $rows ; ++$j){
				$result->data_seek($j);
				$row = $result->fetch_array(MYSQLI_NUM);
								
?>
	<tr>
		<td>
			<?php echo $row['5'] ?>
		</td>
		<td>
			<?php echo $row['3'] ." ". $row['4'] ?>
		</td>
		
		<td>
			<?php echo $row['0'] ?>
		</td>
		<td>
			<?php echo $row['1'] ?>
		</td>
		<td>
			<?php echo $row['2'] ?>
		</td>
	</tr>
<?php
	}
?>
</table>
</body>
</html>	