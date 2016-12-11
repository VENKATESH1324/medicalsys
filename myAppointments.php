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

<html>
<ul>
  <li><a href="doctorHome.php">My Details</a></li>
  <li><a class="active" href="myAppointments.php">View Appointments</a></li>
  <li><a href="doctorSchedule.php">Update Schedule</a></li>
  <li><a href="searchPatient.php">Search Patients</a></li>
  <li><a href="logout.php">Logout</a></li>	
</ul>
	
		<section style="display:block; overflow:hidden; background:#99ABC3;  border: 1px solid ; padding:5px; ">
    <div style="text-align: center;">
        <h1>
			U of U Medical System
		</h1>
     </div>
</section>
<div style="display:block;margin-left:17%;width: 30%">
<h3 style="color: green"> My Schedule </h3>  
	<table align ="left">

<?php
require_once 'login.php';
require_once 'checkSession.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);
						
$query="select ds.sch_date,st.start_time, st.end_time from doctor_Schedule ds,set_time st where ds.d_first_name = '$_SESSION[firstname]' and ds.d_last_name ='$_SESSION[lastname]' and ds.set_time_id = st.id and ds.sch_date>=curdate() order by ds.sch_date , st.start_time asc";
$result = $conn->query($query);
if (!$result) die($conn->error);
$rows = $result->num_rows;

for ($j = 0 ; $j < $rows ; ++$j){
$result->data_seek($j);
$row = $result->fetch_array(MYSQLI_NUM);

?>
<tr>			
		<td><?php echo 'From '. $row['1'] . ' To ' . $row['2'] . ' On '. $row['0'].'<br>' ?></td>
</tr>
<?php
	}
?>		
			
</table>	

</div>

<div style="margin-left:60%; display:block; width: 30%">	
	<table align ="right">
	<h3 style="color: green"> Booked Appointments </h3>  
		<?php 
			$query="select st.start_time, st.end_time,a.schedule_date,p.first_name, p.last_name,p.id,a.id from appointments a, set_time st, patient p where a.doctor_id = $_SESSION[userid] and (a.schedule_date >= curdate()) and a.time_id = st.id and a.patient_id = p.id order by a.schedule_date,st.start_time asc";
			
			$result = $conn->query($query);
			if (!$result) die($conn->error);
			$rows = $result->num_rows;
				
			for ($j = 0 ; $j < $rows ; ++$j){
			$result->data_seek($j);
			$row = $result->fetch_array(MYSQLI_NUM);
								
		?>
		<tr>
			<td>
				<?php echo "From " . $row['0'] . " To " . $row['1'] . " on " . $row['2']. " with " . $row['3']. " " .$row['4'] . "<br>"; ?>
			</td>				
		</tr>
			
			<?php
				}
			?>	
	</table>
</div>		
	</body>
</html>			