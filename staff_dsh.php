<?php
session_start();
if (isset($_SESSION['LoginStaff'])) {
    $username = $_SESSION['LoginStaff'];
} else {
    header('Location: login.php');
}
$con = mysqli_connect("localhost", "root", "", "cms");
if (!$con) {
    die(mysqli_error());
}

$sql="SELECT depart, image from staff where id='$username'";
$reslt=$con->query($sql);
$row=$reslt->fetch_assoc();
$department = $row['depart']; // Change the department based on the logged-in staff
$img=$row['image'];
$_SESSION['department'] = $department;


$qry = "SELECT * FROM student WHERE status='available' AND course='$department'";
$res = $con->query($qry);
$r = $res->num_rows; 

$qry3 = "SELECT * FROM course WHERE status='available'";
$res3 = $con->query($qry3);
$row3 = $res3->num_rows;

$qry4 = "SELECT * FROM article";
$res4 = $con->query($qry4);
$row4 = $res4->num_rows;
?>

<!DOCTYPE html>
<html>
<head>
    <title>College Management System - Admin Dashboard</title>
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
            <h2><?php
            
              echo  "$username";
          
          ?></h2>
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
            <button class="btn"><a href='logout.php'>Logout</a></button>
        </div>
    </div>

    <div class="content">
        <h1 align="center">Staff Dashboard</h1>

        <div class="dashboard">
            <div class="box">
                <h2><?php echo $r; ?></h2>
                <p>Total Student</p>
                <button class="btn-view"><a href='staff_view_stud.php'>View</a></button>
            </div>
            <div class="box">
                <h2><?php echo $row3; ?></h2>
                <p>COURSE</p>
                <button class="btn-view" ><a href="stf_view_course.php">View</a></button>
            </div>
            <div class="box">
                <h2><?php echo $row4; ?></h2>
                <p>ARTICLE</p>
                <button class="btn-view"><a href="v_Sart.php">View</a></button>
            </div>
        </div>

</body>
</html>


