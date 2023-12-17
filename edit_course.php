<?php
$con = mysqli_connect("localhost", "root", "", "cms");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
if (isset($_POST['submit'])) {
    $sno = $_POST['sno'];
    $name = strtoupper($_POST['nm']);
    $fname = strtoupper($_POST['fnm']);
    $fs = $_POST['fe'];
    $des = $_POST['des'];
    $status = "available";

    $sql = "UPDATE course SET cname='$name', full='$fname', fees='$fs', des='$des', status='$status' WHERE sno='$sno'";
    if (mysqli_query($con, $sql)) {
        echo "<script>alert('Course updated successfully');</script>";
    } else {
        echo "Error updating course: " . mysqli_error($con);
    }
}

if (isset($_GET['sno'])) {
    $sno = $_GET['sno'];
    $sql = "SELECT * FROM course WHERE sno='$sno'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
} else {
    echo "<script>alert('Course sno not provided'); window.location.href = 'admin_dash.php';</script>";
    exit;
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Course</title>
    <style>
        body {
            background-image: url("reg_back.jpg");
        }

        form {
            background: white;
            width: 35%;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        form h2 {
            text-align: center;
        }

        label,
        input,
        select {
            display: block;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            margin-top: 20px;
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #3e8e41;
        }

        .myTextbox {
            width: 400px;
            height: 200px;
            font-size: 16px;
            resize: none;
        }
    </style>
</head>

<body>
    <form action="" method="POST">
        <h2>Edit Course</h2>

        <input type="hidden" name="sno" value="<?php echo $row['sno']; ?>">

        <label>Name of course:</label>
        <input type="text" name="nm" placeholder="Enter course" value="<?php echo $row['cname'];  ?>" required>

        <label>Full name:</label>
        <input type="text" name="fnm" placeholder="Enter full name of course" value="<?php echo $row['full']; ?>" required>

        <label>Total fees:</label>
        <input type="number" name="fe" placeholder="Enter Total fees" value="<?php echo $row['fees']; ?>" required>

        <label>Descriptive about course:</label>
        <textarea class="myTextbox" name="des" placeholder="Description" required><?php echo $row['des']; ?></textarea>

        <input type="submit" name="submit" value="Save">
    </form>
    <button onclick="window.location.href='admin_dash.php'">Back</button>
</body>

</html>
