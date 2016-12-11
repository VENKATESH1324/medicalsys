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
  <li><a class="active" href="doctorRegister.php">Add Doctor</a></li>
  <li><a href="patientRegister.php">Add Patient</a></li>
  <li><a href="logout.php">Logout</a></li>	
</ul>
	
<form name="frmRegistration" method="post" action="">
	<fieldset style="width:30%; align: center; margin:auto"><legend style="font-size:20px">Doctor Registration Form</legend>
	<table border="0" width="500" align="center" class="table">
		<tr><td>Username</td>
		<td><input type="text" class="InputBox" name="userName" value="<?php if(isset($_POST['userName'])) echo $_POST['userName']; ?>"></td>
		</tr>
		<tr><td>First Name</td>
		<td><input type="text" class="InputBox" name="firstName" value="<?php if(isset($_POST['firstName'])) echo $_POST['firstName']; ?>"></td>
		</tr>
		<tr><td>Last Name</td>
		<td><input type="text" class="InputBox" name="lastName" value="<?php if(isset($_POST['lastName'])) echo $_POST['lastName']; ?>"></td>
		</tr>
		<tr><td>Specialization</td>
		<td><select name="specialization"  required> 
		<option value=""> Select Specialization </option>
		<?php
			require_once("login.php");
			require_once 'checkSession.php';
			$conn = new mysqli($hn, $un, $pw, $db);
			if ($conn->connect_error) die($conn->connect_error);
			
			$query="select * from doctor_specialty";
				$result = $conn->query($query);
				if (!$result) die($conn->error);

			while ($row = $result->fetch_assoc()) {
                  		unset($specialty);
                  		$name = $row['specialty']; 
 	                        echo '<option value='.$name.'>'.$name.'</option>';
			}
		?>
		</select>		
		</td></tr>
		<tr><td>Details</td>
		<td><input type="text" class="InputBox" name="details" value="<?php if(isset($_POST['Details'])) echo $_POST['Details']; ?>"></td>
		</tr>
		<tr><td>Password</td>
		<td><input type="password" class="InputBox" name="password" value=""></td>
		</tr>
		<tr><td>Email</td>
		<td><input type="text" class="InputBox" name="userEmail" value="<?php if(isset($_POST['userEmail'])) echo $_POST['userEmail']; ?>"></td>
		</tr>
		<tr><td>Contact Number</td>
		<td><input type="text" class="InputBox" name="contactNumber" value="<?php if(isset($_POST['contactNumber'])) echo $_POST['contactNumber']; ?>"></td>
		</tr>
		
		<tr><td>Address</td>
		<td><input type="text" class="InputBox" name="address" value="<?php if(isset($_POST['address'])) echo $_POST['address']; ?>"></td>
		</tr>
		<tr><td>Date of Birth</td>
		<td><input type="date" class="InputBox" name="bday" value="<?php if(isset($_POST['bday'])) echo $_POST['bday']; ?>">
		</tr>
		<tr><td>Gender</td>
		<td><input type="radio" name="gender" value="Male" <?php if(isset($_POST['gender']) && $_POST['gender']=="Male") { ?>checked<?php  } ?>> Male
		<input type="radio" name="gender" value="Female" <?php if(isset($_POST['gender']) && $_POST['gender']=="Female") { ?>checked<?php  } ?>> Female
		</td>
		</tr>
		<tr><td>
		<input type="hidden"  name="addDoctor"></td></tr>
	</table>
	</fieldset>	<br/>
	<div style="text-align: center;"><input type="submit" name="submit" value="Register" class="btnRegister"></div>
</form>
<div style="text-align: center;">
<?php
$salt1    = "qm&h*";
$salt2    = "pg!@";
	if(isset ($_POST['addDoctor'])){
		$username = $_POST['userName'];	
		$fname =  $_POST['firstName'];
		$lname =  $_POST['lastName'];
		$pwd =  $_POST['password'];
		$email =  $_POST['userEmail'];
		$gender =  $_POST['gender'];
		$birthday =  $_POST['bday'];
		$contact =  $_POST['contactNumber'];
		$address =  $_POST['address'];
		$bio =  $_POST['details'];
		$specialization =  $_POST['specialization'];
		$token    = hash('ripemd128', "$salt1$pwd$salt2");
		
		$query = "INSERT INTO doctor (username, first_name, last_name, pwd, email, gender,specialization, bio, birthday, contact, address ) VALUES ('$username','$fname','$lname','$token','$email','$gender','$specialization','$bio','$birthday','$contact','$address')";
		
		$result = $conn->query($query);
		if (!$result) die ("Database access failed: " . $conn->error);
		if($result) echo "Doctor added to the system successfully!";
	}	
	

?>
</div>	
	</body>
</html>	