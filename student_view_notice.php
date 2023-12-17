<!DOCTYPE html>
<html>
<head>
  <title>Notice....</title>
  <?php include 'student_dash_header.php'; ?>
  <style>
    .container {
      max-width: 800px;
      margin: 0 auto;
    }

    form {
      display: flex;
      flex-direction: column;
      margin-bottom: 20px;
    }

    label {
      font-weight: bold;
      margin-bottom: 5px;
    }

    input[type=text], textarea {
      padding: 5px;
      margin-bottom: 10px;
      border: none;
      border-radius: 3px;
      box-shadow: 0 0 3px rgba(0,0,0,0.2);
    }

    input[type=submit] {
      padding: 5px 10px;
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 3px;
      cursor: pointer;
    }

    input[type=submit]:hover {
      background-color: #3e8e41;
    }

    .notice {
      margin-bottom: 20px;
      padding: 10px;
      border: 1px solid #ddd;
      background-color: #f9f9f9;
    }

    .notice .date {
      font-style: italic;
      font-size: 0.8em;
      color: #999;
    }
    /*this will insert the text above the notice and date ::before and ::after ->below the notice*/
    .notice::before {
      content: "Important Notice By HOD ";
      font-weight: bold;
      color: red;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Notice...</h1>
    <?php

    $conn = mysqli_connect("localhost","root","","cms");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM notice ORDER BY sno DESC LIMIT 1";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      $date = date('F j, Y', strtotime($row['date']));
      echo "<div class='notice'>";
      echo "<p>" . $row["notice"] . "</p>";
      echo "<div class='date'>" . $date . "</div>";
      echo "</div>";
    }
    ?>
  </div>
  <button class="btn"><a href="student_dash.php">Back</a></button>
</body>
</html>



