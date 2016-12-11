<!DOCTYPE html>
<html>   
	<head>
		<title>Login Page</title>
	</head>      
    <style type = "text/css">
		body {
			font-family:Arial, Helvetica, sans-serif;
            font-size:20px;
        }
         
        label{
			font-weight:bold;
            width:100px;
            font-size:14px;
        }
         
        .box {
			border:#666666 solid 1px;
         }
	</style>
	<section style="display:block; overflow:hidden; background:#99ABC3;  border: 1px solid ; padding:5px; ">
		<div style="text-align: center;">
			<h1>U of U Medical System</h1>
		</div>
	</section>
	<br><br>
	
    <div align = "center">
		<div style = "width:300px; border: solid 1px #333333; " align = "left">
			<div style = "background-color:#CCDCF3; color:#333333; padding:10px;"><b>Login</b></div>
				<div style = "margin:30px">
					<form action = "" method = "post">
						<label>UserName  :</label><input type = "text" name = "username" class = "box"/><br /><br />
						<label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br />
						<input type = "submit" name = "submit" value = "Submit"/><br />
					</form>
				</div>
		</div>
	</div>
<?php
	require_once 'login.php';
	$conn = new mysqli($hn, $un, $pw, $db);
	if ($conn->connect_error) die($conn->connect_error);
	
	
	if (isset($_POST['username']) && isset($_POST['password'])) {
		$un_temp = mysql_entities_fix_string($conn, $_POST['username']);
		$pw_temp = mysql_entities_fix_string($conn, $_POST['password']);
		$query = "SELECT * FROM patient where username='$un_temp'";
		$result = $conn->query($query);
	if(!$result) die($conn->error);
	elseif($result->num_rows){
		$row = $result->fetch_array(MYSQLI_NUM);
		$correct_pw = $row['4'];
		$username=$row['1'];
		$result->close();
	
		$salt1 = 'qm&h*';
		$salt2 = 'pg!@';
		$token = hash('ripemd128', "$salt1$pw_temp$salt2" );
		
			if($token == $correct_pw){
			session_start();
			$_SESSION['username'] = $username;
			$_SESSION['password'] = $correct_pw;
			header ("Location: patientHome.php");
		}else{
			echo "Your Login Name or Password is invalid";
			exit();
		}		
	}else{
		exit();
	}	
		
	}else{
	exit();
}

$conn->close();


function mysql_entities_fix_string($conn, $string){
	return htmlentities(mysql_fix_string($conn, $string));
}

function mysql_fix_string($conn, $string){
	if(get_magic_quotes_gpc()) $string = stripslashes($string);
	return $conn->real_escape_string($string);
}
	
?> 
	</body>
</html>