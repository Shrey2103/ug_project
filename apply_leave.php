<?php
session_start();
if(isset($_SESSION['LoginStaff']))
        {
            $username = $_SESSION['LoginStaff'];
        }
        else
        {
            header('Location: login.php');
        }
        $conn = mysqli_connect("localhost","root","","cms");
        $qry="SELECT * from staff where id='$username'";
        $res=mysqli_query($conn,$qry);
        $row = mysqli_fetch_assoc($res);
        $name=$row['name'];
        $avail_leave=$row['total_leave'];
?>
<!DOCTYPE html>
<html>
<head>
  <title>Staff Leave Management</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: lightblue;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    .container {
      max-width: 500px;
      background-color: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    h2 {
      text-align: center;
    }

    form {
      width: 100%;
    }

    label {
      display: inline-block;
      width: 100px;
      margin-bottom: 10px;
    }

    input[type="text"],
    input[type="date"],
    input[type="number"],
    select {
      width: 100%;
      padding: 8px;
      margin-bottom: 10px;
      box-sizing: border-box;
    }

    input[type="submit"] {
      width: 100%;
      background-color: #4CAF50;
      color: white;
      border: none;
      padding: 10px;
      cursor: pointer;
    }

    .logout-btn {
      text-decoration: none;
      color: white;
      background-color: red;
      padding: 10px;
      border-radius: 5px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Apply for Leave</h2>
    <center><button class="logout-btn"><a href="stf_leave.php">BACK</a></button></center>
    <form action="process_leave.php" method="post">
      <label for="reason">Available Leave:</label>
      <input type="text" name="id" value="<?php echo $avail_leave; ?>" readonly><br>

      <label for="reason">Staff ID:</label>
      <input type="text" name="id" value="<?php echo $username; ?>" readonly><br>

      <label for="reason">Name:</label>
      <input type="text" name="name" value="<?php echo $name; ?>" readonly><br>

      <label for="leave_type">Leave Type:</label>
      <select name="leave_type" required>
        <option value="annual">Annual Leave</option>
        <option value="sick">Sick Leave</option>
      </select><br>

      <label for="date">Date:</label>
      <input type="date" name="date" required><br>

      <label for="num_days">Number of Days:</label>
      <input type="number" name="num_days" required><br>

      <label for="reason">Reason:</label>
      <input type="text" name="reason" required><br>

      <input type="submit" value="Apply">
    </form>
  </div>
</body>
</html>
