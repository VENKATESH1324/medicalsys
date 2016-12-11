<!DOCTYPE HTML>
<html>
<head>
	<title>U Of U Medical System</title>
<style>	
.message {
		color: #FF0000;
		font-weight: bold;
		text-align: center;
		width: 75%;
		padding: 10;}
.table {
		background:#CCDCF3;
		
		border-spacing: initial;
		margin: 20px 0px;
		word-break: break-word;
		table-layout: auto;
		line-height:1.8em;
		color:#333;}
.table td {
		padding: 20px 15px 10px 15px;
	}
.InputBox {
		padding: 7px;
		border: #F0F0F0 1px solid;
		border-radius: 4px;
	}
.btnRegister {
		padding: 10px;
		background-color: #09F;
		border: 0;
		color: #FFF;
		cursor: pointer;}
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
  <li><a href="adminHome.php">Home</a></li>
  <li><a href="doctorRegister.php">Add Doctor</a></li>
  <li><a class="active" href="patientRegister.php">Add Patient</a></li>
  <li><a href="logout.php">Logout</a></li>	
</ul>
	
<form name="frmRegistration" method="post" action="">
<div style="text-align: center;">
<?php
require_once("login.php");
require_once 'checkSession.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

$salt1    = "qm&h*";
$salt2    = "pg!@";
	if(isset ($_POST['addPatient'])){
		$username = $_POST['userName'];	
		$fname =  $_POST['firstName'];
		$lname =  $_POST['lastName'];
		$pwd =  $_POST['password'];
		$email =  $_POST['userEmail'];
		$gender =  $_POST['gender'];
		$birthday =  $_POST['bday'];
		$contact =  $_POST['contactNumber'];
		$address =  $_POST['address'];
		$token    = hash('ripemd128', "$salt1$pwd$salt2");
		
		$query = "INSERT INTO patient (id,username, first_name, last_name, pwd, email, gender, birthday, contact, address ) VALUES (default,'$username','$fname','$lname','$token','$email','$gender','$birthday','$contact','$address')";
		
		 $result = $conn->query($query);
		 
  if (!$result) die ("Database access failed: " . $conn->error);
  if($result) echo 'New patient added to the database successfully.';
	
	}
	
?>
</div>
	<fieldset style="width:30%; align: center; margin:auto"><legend style="font-size:20px">Patient Registration Form</legend>
	<table border="0" width="500" align="center" class="table">
		<tr><td>Username</td>
		<td><input type="text" class="InputBox" name="userName" ></td>
		</tr>
		<tr><td>First Name</td>
		<td><input type="text" class="InputBox" name="firstName"></td>
		</tr>
		<tr><td>Last Name</td>
		<td><input type="text" class="InputBox" name="lastName" ></td>
		</tr>
		<tr><td>Password</td>
		<td><input type="password" class="InputBox" name="password"></td>
		</tr>
		<tr><td>Email</td>
		<td><input type="text" class="InputBox" name="userEmail" ></td>
		</tr>
		<tr><td>Contact Number</td>
		<td><input type="text" class="InputBox" name="contactNumber" ></td>
		</tr>
		<tr><td>Address</td>
		<td><input type="text" class="InputBox" name="address" ></td>
		</tr>
		<tr><td>Date of Birth</td>
		<td><input type="date" class="InputBox" name="bday" >
		</tr>
		<tr><td>Gender</td>
		<td><input type="radio" name="gender" value="Male" > Male
		<input type="radio" name="gender" value="Female" > Female
		</td>
		</tr>
		<tr><td>
		<input type="hidden"  name="addPatient"></td></tr>
	</table>
	</fieldset>	<br/>
	<div style="text-align: center;"><input type="submit" name="submit" value="Register" class="btnRegister"></div>
</form>

	
	</body>
</html>	