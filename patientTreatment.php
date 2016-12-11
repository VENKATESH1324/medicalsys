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
.table {
		background:#CCDCF3;
		
		border-spacing: initial;
		margin: 20px 0px;
		word-break: break-word;
		table-layout: auto;
		line-height:1.8em;
		color:#333;
}
.InputBox {
		padding: 7px;
		border: #F0F0F0 1px solid;
		border-radius: 4px;
}
.table td {
		padding: 20px 15px 10px 15px;
	}
</style>
</head>
<body>
<?php 
require_once "login.php";
require_once 'checkSession.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

$appointment_id = $_GET['aid'];

$query = "Select patient_id from appointments where id = $appointment_id";
$result = $conn->query($query);
if (!$result) die($conn->error);
$rows = $result->num_rows;

$result->data_seek($rows);
$row = $result->fetch_array(MYSQLI_NUM);

$patient_id = $row['0'];				

?>
<ul>
  <li><a href="doctorHome.php">Home</a></li>
  <li><a class="active" href="patientTreatment.php">Patient Treatment</a></li>
  <li><a href="logout.php">Logout</a></li>	
</ul>


<form name="treatmentfrm" method="post" action="">

<fieldset style="width:30%; align: center; margin:auto"><legend style="font-size:20px">Patient Treatment</legend>
	<table border="0" width="500" align="center" class="table" >
		
		<tr><td>Problems: </td>
		<td><textarea type="text" name="problems" placeholder="Enter your text here" cols="50" rows="4" required></textarea></td>
		</tr>
		
		<tr><td>Treatment: </td>
		<td><textarea type="text" name="treatment" placeholder="Enter your text here" cols="50" rows="4" required></textarea></td>
		</tr>
		
		<tr><td>Notes: </td>
		<td><textarea type="text" name="notes" placeholder="Enter your text here" cols="50" rows="4" ></textarea></td>
		</tr>
		
		<tr><td>
		<input type="hidden"  name="updateTreatment">
		</td></tr>
	</table>
</fieldset>	<br/>

<div style="text-align: center;"><input type="submit" name="submit" value="Update" ></div>

</form>

<div style="text-align: center;">
<?php

if(isset ($_POST['updateTreatment'])){
	$treatment = $_POST['treatment'];
	$notes = $_POST['notes'];
	$problem = $_POST['problems'];
	$appointment_id = $_GET['aid'];
		
	$query = "INSERT INTO patient_history (id,patient_id, appointment_id,problems,treatment,notes) VALUES (default,$patient_id,$appointment_id,'$problem','$treatment','$notes')";
		
	$result = $conn->query($query);
	if (!$result) die ("Database access failed: " . $conn->error);
	
	if($result){
		echo 'Record has been updated!';
	}
	else
	{
		echo mysql_error();
	}
}	

?>
</div>
</body>
</html>