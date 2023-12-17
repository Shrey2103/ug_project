<?php
session_start();
if (isset($_SESSION['LoginStaff'])) {
    $username = $_SESSION['LoginStaff'];
} else {
    header('Location: login.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>College Management System - Staff Dashboard</title>
	<link rel="stylesheet" href="css/dashStyle.css">
</head>
<body>
<div class="header">
		<h1>College Management System</h1>
	</div>
	<form method="POST">
	<div class="sidebar">
		<div class="admin-info">
			<img src="icon.jpg" alt="Admin Avatar">
			<h2><?php echo $username; ?></h2>
			<p>Staff</p>
		</div>
		<ul>
    <li><a href="staff_dsh.php">Dashboard</a></li>
	<li><a href="staff_prof.php">Profile</a></li>
	<li><a href="stf_leave.php">Leave</a></li>
    <li><a href="add_marks.php">Marks</a></li> 
    <li><a href="stf_feedback.php">Feedback</a></li>
		</ul>
		<div class="footer">
			<button class="b"><a href='logout.php'>Logout</a></button>
		</div>
	</div>

	<div class="content">
		
		<h1 align="center">Feedback Managment</h1>
		
    <div class="dashboard">
		<div class="box">
			<h2></h2>
			<p>Add Feedback</p>
			<button class="btn-view"><a href='apply_stf_feed.php'>View</a></button>
		</div>
		<div class="box">
			<h2></h2>
			<p>View Feedback</p>
			<button class="btn-view"><a href='view_stf_feed.php'>View</a></button>
		</div>
		
	</div>
	
	</form>
</body>
</html>
