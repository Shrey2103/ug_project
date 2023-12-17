<!DOCTYPE html>
<html>
<head>
    <title>Student View</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            text-align: center;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th,
        table td {
            border: 1px solid #ccc;
            padding: 8px;
        }

        table th {
            background-color: #f2f2f2;
        }

        img.profile-image {
            height: 100px;
            width: 100px;
            object-fit: cover;
            border-radius: 50%;
        }

        .no-data {
            text-align: center;
            font-style: italic;
        }
    </style>
</head>
<body>
    <h1>Student View</h1>
    <?php
    session_start();
    $con = mysqli_connect("localhost", "root", "", "cms");
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if (isset($_SESSION['LoginStaff'])) {
        $username = $_SESSION['LoginStaff'];

        $qry = "SELECT image, depart FROM staff WHERE id= '$username'";
        $res = $con->query($qry);
        if ($res->num_rows > 0) {
            $row = $res->fetch_assoc();
            $imagePath = $row['image'];
            $department = $row['depart'];

            $qry_students = "SELECT * FROM student WHERE course = '$department' AND status = 'available'";
            $res_students = $con->query($qry_students);

            if ($res_students->num_rows > 0) {
                echo "<table>";
                echo "<tr>
                    <th>Student ID</th>
                    <th>Name</th>
                    <th>Profile</th>
                    <th>Email</th>
                    <th>Phone no</th>
                    <th>Date of birth</th>
                    <th>Gender</th>
                    <th>Course</th>
                    <th>Address</th>
                    <th>Status</th>
                </tr>";
                while ($row = $res_students->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo '<td><img src="' . $row['image'] . '" class="profile-image"></td>';
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['phone'] . "</td>";
                    echo "<td>" . $row['dob'] . "</td>";
                    echo "<td>" . $row['gender'] . "</td>";
                    echo "<td>" . $row['course'] . "</td>";
                    echo "<td>" . $row['address'] . "</td>";
                    echo "<td>" . $row['status'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p class='no-data'>No students found in the department.</p>";
            }
        }
    }

    mysqli_close($con);
    ?>
    <button onclick="window.location.href='staff_dsh.php'">Back</button>
</body>
</html>
