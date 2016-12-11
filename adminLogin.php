<?php
	require_once 'login.php';
	$conn = new mysqli($hn, $un, $pw, $db);
	if ($conn->connect_error) die($conn->connect_error);
	
	
if(isset($_POST['submit'])) { 
		session_start(); //starting the session for user profile page 
		if(!empty($_POST['username'])) {
			$query = "SELECT * FROM admin where username = '$_POST[username]' AND pwd = '$_POST[password]'";
			$result = $conn->query($query);
			if (!$result) die($conn->error);
			$rows = $result->num_rows;
			$count = mysqli_num_rows($result);
			
			if($count==1){
				$_SESSION['username'] = $_POST[username];         
				header("location: adminHome.php");
			}else {
				echo "Your Login Name or Password is invalid";
			}
				
			}
		}
 ?>  
   <html>
   
   <head>
      <title>Login Page</title>
      
      <style type = "text/css">
         body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:20px;
         }
         
         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }
         
         .box {
            border:#666666 solid 1px;
         }
      </style>
      
   </head>
   
   <section style="display:block; overflow:hidden; background:#99ABC3;  border: 1px solid ; padding:5px; ">
    <div style="text-align: center;">
        <h1>
			U of U Medical System
		</h1>
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

   </body>
</html>
