<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update mark form</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            max-width: 400px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .container label,
        .container input[type="text"],
        .container input[type="submit"] {
            display: block;
            margin-bottom: 10px;
        }

        .container input[type="submit"] {
            background-color: skyblue;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        $con = mysqli_connect("localhost", "root", "", "cms");
        if (!$con) {
            die(mysqli_error($con));
        }
        $id = $_GET['id'];
        $type = $_GET['type'];

        $sql = "SELECT student.name, student.id, marks.type, marks.s1, marks.s2, marks.s3, marks.s4, marks.s5, marks.s6 
                FROM marks JOIN student ON student.id = marks.id 
                WHERE marks.id = '$id' AND marks.type = '$type'";
        $res = $con->query($sql);
        $row = mysqli_fetch_assoc($res);

        $studid = $row['id'];
        $studentName = $row['name'];
        $subject1 = $row['s1'];
        $subject2 = $row['s2'];
        $subject3 = $row['s3'];
        $subject4 = $row['s4'];
        $subject5 = $row['s5'];
        $subject6 = $row['s6'];
        ?>

        <form method="post" action="">
            <input type="hidden" name="id" value="<?php echo $studid; ?>">
            <input type="hidden" name="type" value="<?php echo $type; ?>">
            
            <label for="studentName">Student Name: </label>
            <input type="text" id="studentName" name="studentName" value="<?php echo $studentName; ?>">
            
            <label for="subject1">Subject 1: </label>
            <input type="text" id="subject1" name="subject1" value="<?php echo $subject1; ?>">
            
            <label for="subject2">Subject 2: </label>
            <input type="text" id="subject2" name="subject2" value="<?php echo $subject2; ?>">
            
            <label for="subject3">Subject 3: </label>
            <input type="text" id="subject3" name="subject3" value="<?php echo $subject3; ?>">
            
            <label for="subject4">Subject 4: </label>
            <input type="text" id="subject4" name="subject4" value="<?php echo $subject4; ?>">
            
            <label for="subject5">Subject 5: </label>
            <input type="text" id="subject5" name="subject5" value="<?php echo $subject5; ?>">
            
            <label for="subject6">Subject 6: </label>
            <input type="text" id="subject6" name="subject6" value="<?php echo $subject6; ?>">
            
            <input type="submit" name="submit" value="Update">
            <a href="view_Sfmark.php">BACK</a>
           
        </form>
    </div>

    <?php
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $type = $_POST['type'];
    $s1 = $_POST['subject1'];
    $s2 = $_POST['subject2'];
    $s3 = $_POST['subject3'];
    $s4 = $_POST['subject4'];
    $s5 = $_POST['subject5'];
    $s6 = $_POST['subject6'];

    if ($s1 == $subject1 && $s2 == $subject2 && $s3 == $subject3 && $s4 == $subject4 && $s5 == $subject5 && $s6 == $subject6) {
        echo "<script>alert('No changes made');</script>";
        echo "<script>window.location.href='view_Sfmark.php';</script>";
    } else {
        $total = $s1 + $s2 + $s3 + $s4 + $s5 + $s6;
        $average = $total / 6;
        $grade = '';

        if ($s1 >= 35 && $s2 >= 35 && $s3 >= 35 && $s4 >= 35 && $s5 >= 35 && $s6 >= 35) {
            if ($average >= 75) {
                $grade = 'distinction';
            } else if ($average >= 65) {
                $grade = 'first class';
            } else if ($average >= 55) {
                $grade = 'second class';
            } else if ($average >= 35) {
                $grade = 'pass class';
            } else {
                $grade = 'fail';
            }
        } else {
            $grade = 'fail';
        }

        $updateMarksQry = "UPDATE marks SET s1='$s1', s2='$s2', s3='$s3', s4='$s4', s5='$s5', s6='$s6', total='$total', avg='$average', grade='$grade' WHERE id='$id' AND type='$type'";
        $updateMarksResult = $con->query($updateMarksQry);

        if (!$updateMarksResult) {
            die(mysqli_error($con));
        }

        echo "<script>alert('Marks updated successfully');</script>";
        echo '<script>window.location.href="view_Sfmark.php";</script>';
    }
}
?>
