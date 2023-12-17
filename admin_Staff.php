<?php
$con=mysqli_connect("localhost","root","","cms");
if(!$con){
	die(mysqli_err());
}
$qry="select * from staff";
$res=$con->query($qry);
$r=$res->num_rows;
?>


<!DOCTYPE html>
<html>
<head>
	<title>College Management System - Admin Dashboard</title>
	<link rel="stylesheet" href="css/all.min.css">
	<link rel="stylesheet" href="css/fontawesome.min.css">
  <link rel="stylesheet" href="css/dashStyle.css">
	
</head>
<body>
  <div class="header">
		<h1>College Management System</h1>
	</div>
	<form action="#" method="POST">
	<div class="sidebar">
		<div class="admin-info">
			<img src="icon.jpg" alt="Admin Avatar">
			<h2>Admin name</h2>
			<p>Admin</p>
		</div>
		<ul>
		<li><a href="admin_dash.php">Dashboard</a></li>
			<li><a href="admin_Staff.php">Staff</a></li>
			<li><a href="admin_student.php">Students</a></li>
			<li><a href="admin_course.html">Courses</a></li>
			<li><a href="admin_notice.html">Notice</a></li> 
			
		</ul>
		<div class="footer">
			<button class="b"><a href='logout.php'>Logout</a></button>
		</div>
	</div>

	<div class="content">
		
		<h1 align="center">Staff Managment</h1>
		
    <div class="dashboard" style="justify-content: space-around;">
		<div class="box">
			<h2><i class="fa-solid fa-person-chalkboard"></i></h2>
			<p>Add Staff</p>
			<button class="btn-view"><a href='addstf.php'>Add staff</a></button>
		</div>

		<div class="box" style="justify-content: center;">
			<h2>
			<i class="fa-solid fa-eye"></i></h2>
			<p>View Staff</p>
			<button class="btn-view"><a href='viewstf.php'>View</a></button>
		</div>
		<div class="box" style="justify-content: center;">
			<h2>
			<i class="fa-solid fa-eye"></i></h2>
			<p>Staff Leave</p>
			<button class="btn-view"><a href='view_leave.php'>View</a></button>
		</div>
	</div>
	
	<div class="footer">
    <button class="logout-btn"><a href='logout.php'>Logout</a></button>
  </div>

	</form>
</body>
</html>