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
  <li><a href="patientHome.php">My Details</a></li>
  <li><a href="bookAppointment.php">Book Appointment</a></li>
  <li><a class="active" href="cancelAppointment.php">Cancel Appointment</a></li>
  <li><a href="searchDoctor.php">Doctor Directory</a></li>
  <li><a href="logout.php">Logout</a></li>	
</ul>

<section style="display:block;margin-left:15%; overflow:hidden; background:#99ABC3;  padding:5px; ">
    <div style="text-align: center;">
        <h1>
			Cancel Appointment
		</h1>
     </div>
</section>	

<div style="padding:1px 16px;height:1000px;margin-left:20%">	
	<table align ="center">
			<?php
				require_once 'login.php';
				require_once 'checkSession.php';
				$conn = new mysqli($hn, $un, $pw, $db);
				if ($conn->connect_error) die($conn->connect_error);
				
				$query="select st.start_time, st.end_time,a.schedule_date,d.first_name, d.last_name, a.id from appointments a, set_time st, doctor d where a.patient_id = $_SESSION[userid] and  a.time_id = st.id and a.doctor_id = d.id and (a.schedule_date>curdate() or (a.schedule_date = curdate() and st.start_time > now()))";
				
				$result = $conn->query($query);
				if (!$result) die($conn->error);
				$rows = $result->num_rows;
				
				for ($j = 0 ; $j < $rows ; ++$j){
				$result->data_seek($j);
				$row = $result->fetch_array(MYSQLI_NUM);
								
			?>
			<tr>
				<td>
					<?php echo "From " . $row['0'] . " To " . $row['1'] . " On " . $row[2]. " with doctor " . $row['3']. " ".$row['4'] ?>
				</td>
				<form method="POST">
				<td>
					<input type='submit' value='Cancel Appointment'  name='delete'>
					<input type='hidden' value='<?php echo $row['5'] ?>' name='confirm' >
				</td>
				</form>
			</tr>		
			
			<?php
				}
			?>	
		</table>
		
		<?php
	if(isset($_POST['delete']) and isset ($_POST['confirm'])){
		
		$id = $_POST['confirm'];
		$query = "DELETE from appointments where id = $id";	
		$result = $conn->query($query);
		if($result) {
			echo "Appointment has been canceled!";
		}
	}	

?>

</div>

</body>
</html>