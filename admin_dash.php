<?php
session_start();
$con=mysqli_connect("localhost","root","","cms");
if(!$con){
	die(mysqli_err());
}

$qry="select * from staff where status='available'";
$res=$con->query($qry);
$r=$res->num_rows;


$qry2="SELECT * FROM student where status='available'";
$res2=$con->query($qry2);
$row2=$res2->num_rows;

$qry3="SELECT * from course where status='available'";
$res3=$con->query($qry3);
$row3=$res3->num_rows;

$qry="select * from feedback";
$re=$con->query($qry);
$ra=$re->num_rows;

$qry="select * from article";
$re=$con->query($qry);
$ra1=$re->num_rows;
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
				<h2>
          <?php
          if (isset($_SESSION['LoginAdmin'])) {
              $username = $_SESSION['LoginAdmin'];
              echo "Welcome, $username";
          } else {
              header('Location: login.php');
          }
          ?>
        </h2>
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
				<button class="logout-btn"><a href='logout.php'>Logout</a></button>
			</div>
		</div>

		<div class="content">
			<h1 align="center">Admin Dashboard</h1>
			<div class="dashboard">
				<div class="box">
					<i class="fas fa-graduation-cap box-icon"></i>
					<h2><?php echo $row2; ?></h2>
					<p>Total Students</p>
					<a href="view_student.php" class="btn-view"><i class="fas fa-eye"></i> View</a>
				</div>
				<div class="box">
					<i class="fas fa-chalkboard-user box-icon"></i>
					<h2><?php echo $r; ?></h2>
					<p>Total Staff</p>
					<a href="viewSTaF.php" class="btn-view"><i class="fas fa-eye"></i> View</a>
				</div>
				<div class="box">
					<i class="fas fa-book box-icon"></i>
					<h2><?php echo $row3; ?></h2>
					<p>Total Courses</p>
					<a href="view_course.php" class="btn-view"><i class="fas fa-eye"></i> View</a>
				</div>
				<div class="box">
					<i class="fas fa-comments box-icon"></i>
					<h2><?php echo $ra; ?></h2>
					<p>Feedback</p>
					<a href="view_feedback.php" class="btn-view"><i class="fas fa-eye"></i> View</a>
				</div>
        <div class="box">
					<i class="fas fa-comments box-icon"></i>
					<h2><?php echo $ra1; ?></h2>
					<p>Article</p>
					<a href="view_article.php" class="btn-view"><i class="fas fa-eye"></i> View</a>
				</div>
			</div>
		</div>
	</form>

</body>
</html>
