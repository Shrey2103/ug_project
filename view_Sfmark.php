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

$sql = "SELECT depart from staff where id='$username'";
$reslt = $con->query($sql);
$row = $reslt->fetch_assoc();
$department = $row['depart']; // Change the department based on the logged-in staff

$_SESSION['department'] = $department;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Course Navigation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .navbar {
            background-color: #f2f2f2;
            overflow: hidden;
        }

        .navbar ul {
            margin: 0;
            padding: 0;
            list-style-type: none;
            display: flex;
        }

        .navbar li {
            margin-right: 10px;
        }

        .navbar li a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: #333;
        }

        .navbar li a:hover {
            background-color: #ddd;
        }

        .content {
            margin: 20px auto;
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #444;
            color: #fff;
            font-weight: bold;
        }

        .<style>
    body {
        font-family: Arial, sans-serif;
    }

    .popup {
        display: none;
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
    }

    .popup-content {
        background-color: white;
        width: 400px;
        max-width: 80%;
        margin: 100px auto;
        padding: 20px;
        border-radius: 5px;
    }

    .popup-content h2 {
        margin-bottom: 20px;
    }

    .popup-content label {
        display: inline-block;
        width: 120px;
        text-align: right;
        margin-right: 10px;
    }

    .popup-content input[type="text"] {
        width: 200px;
        padding: 5px;
        margin-bottom: 10px;
    }

    .update-button,
    .cancel-button {
        display: inline-block;
        padding: 8px 16px;
        border: none;
        cursor: pointer;
        font-size: 14px;
        border-radius: 4px;
        text-align: center;
        text-decoration: none;
        transition-duration: 0.4s;
    }

    .update-button {
        background-color: green;
        color: #fff;
        margin-right: 10px;
    }

    .cancel-button {
        background-color: red;
        color: #fff;
    }

    .update-button:hover,
    .cancel-button:hover {
        opacity: 0.8;
    }
</style>

    </style>

</head>
<body>
<div class="navbar">
    <ul>
        <li><a href="?course_type=1">1 Internal</a></li>
        <li><a href="?course_type=2">2 Internal</a></li>
    </ul>
</div>

<?php
if (isset($_GET['course_type'])) {
    $selectedCourseType = $_GET['course_type'];

    // Fetch and display students' marks of the selected course
    $query = "SELECT student.id, student.name, marks.type, marks.s1, marks.s2, marks.s3, marks.s4, marks.s5, marks.s6, marks.total, marks.avg, marks.grade
    FROM marks
    JOIN student ON student.id = marks.id
    WHERE marks.course = '" . mysqli_real_escape_string($con, $department) . "' AND marks.type = " . $selectedCourseType . " AND student.status='available'";

    $result = mysqli_query($con, $query);

    echo '<div class="content">';
    echo '<h2>Students Marks of the Selected Course: ' . $selectedCourseType . ' Internal</h2>';
    echo '<table>';
    echo '<tr><th>Student Id</th><th>Student Name</th><th>Subject 1</th><th>Subject 2</th><th>Subject 3</th><th>Subject 4</th><th>Subject 5</th><th>Subject 6</th><th>Total</th><th>Average</th><th>Grade</th><th>Update</th></tr>';

    while ($row = mysqli_fetch_assoc($result)) {
        $studid = $row['id'];
        $studentName = $row['name'];
        $type=$row['type'];
        $subject1 = $row['s1'];
        $subject2 = $row['s2'];
        $subject3 = $row['s3'];
        $subject4 = $row['s4'];
        $subject5 = $row['s5'];
        $subject6 = $row['s6'];
        $total = $row['total'];
        $average = $row['avg'];
        $grade = $row['grade'];

        echo '<tr>';
        echo '<td>' . $studid . '</td>';
        echo '<td>' . $studentName . '</td>';
        echo '<td>' . $subject1 . '</td>';
        echo '<td>' . $subject2 . '</td>';
        echo '<td>' . $subject3 . '</td>';
        echo '<td>' . $subject4 . '</td>';
        echo '<td>' . $subject5 . '</td>';
        echo '<td>' . $subject6 . '</td>';
        echo '<td>' . $total . '</td>';
        echo '<td>' . $average . '</td>';
        echo '<td>' . $grade . '</td>';
        echo '<td><a class="update-button" href="update_mark_form.php?id=' . $studid . '&type=' . $type . '">Update</a></td>';
        echo '</tr>';
    }

    echo '</table>';
    
    echo '</div>';

   
}
?>

<br>
<center><button class='button' onclick='window.location.href="add_marks.php"'>BACK</button></center>
</body>
</html>
