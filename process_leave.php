<?php
// Retrieve the form data
$id= $_POST['id'];
$name=$_POST['name'];
$date=$_POST['date'];
$reason = $_POST['reason'];
$leaveType = $_POST['leave_type'];
$numDays = $_POST['num_days'];


// Connect to the database
$host = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'cms';

$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT total_leave FROM staff where id='$id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $totalLeave = $row['total_leave'];

  // Check if the staff has enough leave days remaining
  if ($numDays <= $totalLeave) {
    // Insert the leave application into the database
    $sql = "INSERT INTO staff_leave (id,type,date,num, reason,status) VALUES ('$id', '$leaveType','$date',$numDays,'$reason','pending')";

    if ($conn->query($sql) === TRUE) {
      // Update the remaining leave days for the staff
      //$newTotalLeave = $totalLeave - $numDays;
      //$sql = "UPDATE staff SET total_leave = $newTotalLeave WHERE id = $staffId";
      //$conn->query($sql);
      echo "<script>alert('Leave application submitted successfuly!');window.location.href='staff_dsh.php';</script>";
      echo"<script>window.location.href='stf_leave.php';</script>";

    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
      exit;
    }
  } else {
    echo "<script>alert('Insufficient leave days remaining!');</script>";
    echo"<script>window.location.href='stf_leave.php';</script>";
  }
} else {
  echo "Staff not found!";
}

$conn->close();
?>
