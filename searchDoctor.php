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
  <li><a href="patientHome.php">My Details</a></li>
  <li><a href="bookAppointment.php">Book Appointment</a></li>
  <li><a href="cancelAppointment.php">Cancel Appointment</a></li>
  <li><a class="active" href="searchDoctor.php">Doctor Directory</a></li>
  <li><a href="logout.php">Logout</a></li>	
</ul>

	
		<section style="display:block; overflow:hidden; background:#99ABC3;  border: 1px solid ; padding:5px; ">
    <div style="text-align: center;">
        <h1>
			U of U Medical System
		</h1>
     </div>
</section>
  <br><br>
  
  <div style="display:block;margin-left:20%;">
	<table align ="left">
	<?php
	require_once 'login.php';
	$conn = new mysqli($hn, $un, $pw, $db);
	if ($conn->connect_error) die($conn->connect_error);

	session_start();
	
	$query = "SELECT * FROM doctor";
	$result = $conn->query($query);
	if (!$result) die($conn->error);
	$rows = $result->num_rows;
	$count = mysqli_num_rows($result);
	
	for ($j = 0 ; $j < $rows ; ++$j){
					$result->data_seek($j);
					$row = $result->fetch_array(MYSQLI_NUM);	
?>	
		<tr>
			<tr>			
				<td><?php echo 'Name: '. $row['2'] . ' ' . $row['3'] . '<br>' ?></td>
			</tr>
			<tr>
				<td><?php echo 'Specialization: '  . $row['7'] . '<br>' ?></td>
			</tr>
			<tr>
				<td><?php echo 'Email: '  . $row['5'] . '<br>' ?></td>
			</tr>			
			<tr>
				<td><?php echo 'Contact: '  . $row['10'] . '<br><br>' ?></td>
			</tr>
		</tr>	
		<?php
	}
?>		
			
	 </table>	
	 </div>
	</body>
</html>	