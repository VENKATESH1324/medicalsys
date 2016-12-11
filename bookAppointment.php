<!DOCTYPE html>
<html>
	<head>
	</head>
<style>
body {
    margin: 0;
}

ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    width: 15%;
    background-color: #f1f1f1;
    position: fixed;
    height: 100%;
    overflow: auto;
	font-weight: bold;
}
li a {
    display: block;
    color: #000;
    padding: 8px 16px;
    text-decoration: none;
}
li a.active {
    background-color: #133E7A;
    color: white;
}
li a:hover:not(.active) {
    background-color: #555;
    color: white;
}
</style>
<body>

<ul>
  <li><a href="patientHome.php">My Details</a></li>
  <li><a class="active" href="bookAppointment.php">Book Appointment</a></li>
  <li><a href="cancelAppointment.php">Cancel Appointment</a></li>
  <li><a href="searchDoctor.php">Doctor Directory</a></li>
  <li><a href="logout.php">Logout</a></li>	
</ul>

<section style="display:block;margin-left:15%; overflow:hidden; background:#99ABC3;  padding:5px; ">
    <div style="text-align: center;">
        <h1>
			Book Appointment
		</h1>
     </div>
</section>	


<section style="display:block;margin-left:15%; overflow:hidden; padding:5px; ">
<form method="POST" action="">
    <div style="text-align: left; margin-left:5%;" id='searchSection'>
		<?php				
				require_once 'login.php';
				require_once 'checkSession.php';
				$conn = new mysqli($hn, $un, $pw, $db);
				if ($conn->connect_error) die($conn->connect_error);
				
				$query="select * from doctor_specialty";
				$result = $conn->query($query);
				if (!$result) die($conn->error);
				
				echo "Select Specialization:        ";
				echo "<select name='specialty' required>";
				echo '<option value=""> Select Specialization </option>';
				while ($row = $result->fetch_assoc()) {
                  unset($specialty);
                  $name = $row['specialty']; 
                  echo '<option value='.$name.'>'.$name.'</option>';
				}		
				echo "</select>";
				echo "<br><br>"
				
			?>
			
			 Appointment Date:   <input type="date" name="date" required > <br><br>
			 
			 Select Time Slot:
			 <table width='400' border='0' cellpadding='2' cellspacing='0' id='booking'>
				<tr>
					<th width='150' align='left'>Start</th>
					<th width='150' align='left'>End</th>
					<th width='20' align='left'>Select</th>			
				</tr>
				<?php
					$query="select * from set_time";
					$result = $conn->query($query);
					if (!$result) die($conn->error);
					$rows = $result->num_rows;
	
					for ($j = 0 ; $j < $rows ; ++$j){
					$result->data_seek($j);
					$row = $result->fetch_array(MYSQLI_NUM);
				?>		
				<tr>
					<td><?php echo $row['1'] ?></td>									
					<td><?php echo $row['2'] ?></td>				
					<td><input name="check_list[]" value="<?php echo $row['0'] ?>" type='checkbox'><br></td>
				</tr>
				<tr><td><input type='hidden' name='search'></td></tr>
				<tr>
					<?php
						}
						
					?>
				</tr>
			</table>
	</div>
	<input type='submit' value='Search' name='submit'>
</form>	

</section>

<section style="display:block;margin-left:15%; overflow:hidden; padding:5px; ">
<div style="text-align: center;">	
<table>
	<tr> 
		<th width='250' align='left'>Doctor</th>
		<th width='250' align='left'>Time Slot</th>
		<th width='20' align='left'>Select</th>
	</tr>

<?php
if(isset($_POST['search']) and isset ($_POST['check_list']) and isset ($_POST['submit'])){
	$time_slots = array();
	foreach($_POST['check_list'] as $selected) {
		$time_slots[] = $selected;
	}					
	$date= $_POST ['date'];
	$specialization= $_POST['specialty'];				
	$_SESSION['date'] = $_POST ['date'];	
	$query = "Select ds.id, ds.d_first_name, ds.d_last_name, st.Start_time, st.end_time from doctor d, doctor_schedule ds,set_time st where ds.sch_date='$date' and st.id in (".implode(',',$time_slots).") and d.specialization = '$specialization' and ds.d_last_name = d.last_name and ds.d_first_name = d.first_name and st.id = ds.set_time_id and ds.id not in (select doctor_schedule_id from appointments)";
	
	$result = $conn->query($query);
	if (!$result) die($conn->error);
	$rows = $result->num_rows;

	for ($j = 0 ; $j < $rows ; ++$j){
	$result->data_seek($j);
	$row = $result->fetch_array(MYSQLI_NUM);
	
?>

<tr align="left">			
	<td><?php echo  $row['1'] . ' '. $row['2']  ?></td>
	<td><?php echo  $row['3'] . ' To '. $row['4'] ?></td>
	<td><input type='submit' value='Book Appointment' name='confirm' onclick="location='confirmAppointment.php?id=<?php echo $row['0'] ?>'"></td>

	<!--<td><input name="selectedSlot" value="<?php echo $row['0'] ?>" type='checkbox'></td>-->
</tr>

<?php
	}
}
?>
</table>


</div>
</section>
</body>
</html>
