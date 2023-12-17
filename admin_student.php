<?php
$con=mysqli_connect("localhost","root","","cms");
if(!$con){
	die(mysqli_err());
}
$qry="select * from staff";
$res=$con->query($qry);
$r=$res->num_rows;
$qry1="SELECT * FROM student";
$res1=$con->query($qry1);
$r1=$res1->num_rows;

$qry2="SELECT * FROM student where status='approved'";
$res2=$con->query($qry2);
$row2=$res2->num_rows;
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
		
		<h1 align="center" style="margin-left:-20px">Student Managment</h1>
		
    <div class="dashboard" style="justify-content: space-around;">
		<div class="box">
			<h2><i class="fa-solid fa-graduation-cap"></i></h2>
			<p>Admit Student</p>
			<button class="btn-view"><a href='addstd.php'>add student</a></button>
		</div>
		<div class="box">
			<h2><i class="fa-solid fa-eye"></i></h2>
			<p>View Student</p>
			<button class="btn-view"><a href="viewstd.php">View</a></button>
		</div>
    <div class="box">
			<h2><i class="fa-solid fa-eye"></i></h2>
			<p>Students Marks Report</p>
			<button class="btn-view"><a href="view_Acourse.php">View</a></button>
		</div>
		
	</div>
  <div class="footer">
    <button class="logout-btn"><a href='logout.php'>Logout</a></button>
  </div>
	
	</form>
</body>
</html>