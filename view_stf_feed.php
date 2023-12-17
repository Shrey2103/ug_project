<!DOCTYPE html>
<html>
<head>
    <title>Student Feedback</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            color:WHITE;
            margin-top:80px;
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 90%;
            margin: 0 auto;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.3);
            border-radius: 10px;
        }

        th, td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: #fff;
        }

        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
    <h1>Staff Feedback</h1>
    <table>
        <tr>
            <th>Roll No</th>
            <th>Name</th>
            <th>Department</th>
            <th>Date</th>
            <th>Feedback</th>
        </tr>
        <?php
        session_start();
        // PHP code to retrieve and display feedback
        $conn = mysqli_connect("localhost", "root", "", "cms");
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        if(isset($_SESSION['LoginStaff']))
        {
            $id = $_SESSION['LoginStaff'];
        

        $sql = "SELECT s.id, s.name, s.depart, f.date, f.feedback FROM feedback f JOIN staff s ON s.id=f.id WHERE f.type = 'staff' AND s.id = '$id'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['depart'] . "</td>";
                echo "<td>" . $row['date'] . "</td>";
                echo "<td>" . $row['feedback'] . "</td>";
                echo "</tr>";
            }
        } else {
           echo"<script>alert('No feedback found');</script>";
           
        }
    }

        mysqli_close($conn);
        ?>
    </table>
</body>
</html>
