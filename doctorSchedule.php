<!DOCTYPE html>
<html>
<head>
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
</head>
<body>

<ul>
  <li><a href="doctorHome.php">My Details</a></li>
  <li><a href="myAppointments.php">View Appointments</a></li>
  <li><a class="active" href="doctorSchedule.php">Update Schedule</a></li>
  <li><a href="searchPatient.php">Search Patients</a></li>
  <li><a href="logout.php">Logout</a></li>	
</ul>

<section style="display:block;margin-left:15%; overflow:hidden; background:#99ABC3;  padding:5px; ">
    <div style="text-align: center;">
        <h1>
			Update Schedule
		</h1>
     </div>
</section>	
<form method="POST" action="">
<section style="display:block;margin-left:15%; overflow:hidden; padding:5px; ">
    <div style="text-align: left;">
	
			 Schedule for:   <input type="date" name="date"> <br><br>
			 Select Available Time Slots :
			 
			<table width='400' border='0' cellpadding='2' cellspacing='0' id='booking'>
			    <tr>
					<th width='150' align='left'>Start</th>
					<th width='150' align='left'>End</th>
					<th width='20' align='left'>Select</th>			
				</tr>	
				
				<?php
				require_once 'login.php';
				require_once 'checkSession.php';
				$conn = new mysqli($hn, $un, $pw, $db);
				if ($conn->connect_error) die($conn->connect_error);
				
				
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
			<tr><td><input type='hidden' name='search' /></td></tr>
			<tr>
				<?php
					}
				?>
			</tr>
			</table>
	</div>
</section>	
<div style="text-align: center;">
		<input type='submit' name='submit' value='Submit'>
<?php
$time_slots = array();
if(isset($_POST['submit'])){
	if(isset ($_POST['search'])){
		$date = $_POST ['date'];
		$firstname = $_SESSION['firstname'];
		$lastname =	$_SESSION['lastname'];
		
		foreach($_POST['check_list'] as $selected) {
			$set_time_id = $selected;
			$query = "Insert into doctor_schedule values (default, '$firstname','$lastname',$set_time_id,'$date')";	
			$result = $conn->query($query);
			if (!$result) die ("Database access failed: " . $conn->error);			
		}
		
		
	 }
}
?>
	</div>	
</form>	

</body>
</html>
