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
  <li><a class="active" href="doctorHome.php">My Details</a></li>
  <li><a href="myAppointments.php">View Appointments</a></li>
  <li><a href="doctorSchedule.php">Update Schedule</a></li>
  <li><a href="searchPatient.php">Search Patients</a></li>
  <li><a href="logout.php">Logout</a></li>	
</ul>


<section style="display:block;margin-left:15%; overflow:hidden; background:#99ABC3;  padding:5px; ">
    <div style="text-align: center;">
        <h1>
			Welcome to U of U Medical Services
		</h1>
     </div>
</section>	

<body>
<div style="padding:1px 16px;height:1000px;margin-right:5%">	
	<table align ="right">
			
			<?php
				
				require_once 'login.php';
				require_once 'checkSession.php';
				$conn = new mysqli($hn, $un, $pw, $db);
				if ($conn->connect_error) die($conn->connect_error);
								
				$query="select * from doctor where username = '$_SESSION[username]' and pwd = '$_SESSION[password]'";
				$result = $conn->query($query);
				if (!$result) die($conn->error);
				$rows = $result->num_rows;

				for ($j = 0 ; $j < $rows ; ++$j){
					$result->data_seek($j);
					$row = $result->fetch_array(MYSQLI_NUM);
				$_SESSION['firstname'] = $row['2'];
				$_SESSION['lastname'] = $row['3'];
				$_SESSION['userid'] = $row['0'];
							
			?>
			
			
			<tr>			
				<td><?php echo 'Name: '. $row['2'] . ' '. $row['3'] . '<br>' ?></td>
			</tr>
			
			<tr>
				<td><?php echo 'Email: '  . $row['5'] . '<br>' ?></td>
			</tr>
			<tr>
				<td><?php echo 'Gender: '  . $row['6'] . '<br>' ?> </td>
			</tr>
			<tr>
				<td><?php echo 'Specialization: '  . $row['7'] . '<br>' ?> </td>
			</tr>
			<tr>
				<td><?php echo 'Details: '  . $row['8'] . '<br>' ?> </td>
			</tr>
			
			<tr>
				<td><?php echo 'Birthday: '  . $row['9'] . '<br>' ?> </td>
			</tr>
			<tr>
				<td><?php echo 'Contact: '  . $row['10'] . '<br>' ?> </td>
			</tr>
			<tr>
				<td><?php echo 'Address: '  . $row['11'] . '<br>' ?> </td>
			</tr>			
			<?php 
				} 
			?>	
				<tr>		  
	  <td>
		<div id="my_box" style="margin-left:50%">
			<br><br><input type="button" style="font-size:10px; padding:5px 10px; background:#558AD3" value="Update Information" onclick="location='updateDoctor.php'" /></div></td>
	  </tr> 
	  
		</table>
		
		
		<div style="margin-left:20%">
			<h2 style="color: green"> Todays Appointments </h2>
			<table align ="left" >
			<?php
			$query="select st.start_time, st.end_time,a.schedule_date,p.first_name, p.last_name,p.id,a.id from appointments a, set_time st, patient p where a.doctor_id = $_SESSION[userid] and (a.schedule_date = curdate() and  st.end_time>now()) and a.time_id = st.id and a.patient_id = p.id";
			
				$result = $conn->query($query);
				if (!$result) die($conn->error);
				$rows = $result->num_rows;
				
				for ($j = 0 ; $j < $rows ; ++$j){
				$result->data_seek($j);
				$row = $result->fetch_array(MYSQLI_NUM);
								
			?>
			<tr>
				<td>
					<?php echo "From " . $row['0'] . " To " . $row['1'] . " with <a href='patientTreatment.php?aid=".$row['6']."'>" .$row['3']. " ".$row['4']. "</a>" ?>
				</td>
				
				<td> 
					<input type='submit' value='View History' onclick="location='patientHistory.php?id=<?php echo $row['5']?>'"   name='history'>
				</td>	
				
			</tr>
			
			<?php
				}
			?>	
		</table>
		</div>
	</body>
</html>