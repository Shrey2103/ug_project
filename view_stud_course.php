<!DOCTYPE html>
<html>
<head>
  <title>Course List</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-image: url("your-image.jpg");
      background-size: cover;
      background-position: center;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      position: relative;
      z-index: 1;
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

    .container {
      max-width: 800px;
      margin: 0 auto;
      padding: 20px;
      PADDING-TOP:90PX;
      background-color: rgba(255, 255, 255, 0.8);
      position: relative;
      z-index: 2;
    }

    h1 {
      text-align: center;
    }

    .back-link {
      display: block;
      text-align: center;
      margin-top: 20px;
    }
  </style>
</head>
<body>
  <?php include 'student_dash_header.php'; ?>
  <div class="container">
    <h1>Course List</h1>

    <table>
      <tr>
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
 
  </div>
</body>
</html>
