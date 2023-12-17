<!DOCTYPE html>
<html>
<head>
  <title>Course List</title>
  <style>
  
    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      border: 1px solid #ddd;
      padding: 8px;
    }

    th {
      background-color: #f2f2f2;
    }

    /* Adjust the width of the description column */
    td:nth-child(4) {
      white-space: pre-wrap;
    }
    
   
    .action-buttons{
      display: flex;
      align-items: center;
     

    }
    .action-buttons td{
    	border: none;
    }

    .action-buttons button {
      margin-right: 5px;


    }
  </style>
</head>
<body>
  <h1>Course List</h1>

  <table>
    <tr>
      <th>sno</th> 
      <th>Name</th>
      <th>Full name</th>
      <th>Fees</th>
      <th>Description</th>
      <th>Status</th>
     
    </tr>
    
    <?php
    $con = mysqli_connect("localhost", "root", "", "cms");
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    $query = "SELECT * FROM course";
    $result = mysqli_query($con, $query);
    
    while ($row = mysqli_fetch_assoc($result)) {
      echo "<tr>";
      echo "<td>".$row['sno']."</td>";
      echo "<td>".$row['cname']."</td>";
      echo "<td>".$row['full']."</td>";
      echo "<td>".$row['fees']."</td>";
      echo "<td>".$row['des']."</td>";
      echo "<td>".$row['status']."</td>";
      echo "</tr>";
    }
    
    mysqli_close($con);
    ?>

  </table>
  <a href="staff_dsh.php">Back</a>
</body>
</html>

