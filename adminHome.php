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
  <li><a class="active" href="admminHome.php">Home</a></li>
  <li><a href="doctorRegister.php">Add Doctor</a></li>
  <li><a href="patientRegister.php">Add Patient</a></li>
  <li><a href="logout.php">Logout</a></li>	
</ul>

<?php
require_once 'checkSession.php';
?>

<section style="display:block;margin-left:15%; overflow:hidden; background:#99ABC3;  padding:5px; ">
    <div style="text-align: center;">
        <h1>
			Welcome to U of U Medical Services
		</h1>
     </div>
</section>	
</body>
</html>