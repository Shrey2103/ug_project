<!DOCTYPE html>
<html>
<head>
    <title>Notice System</title>
    <style type="text/css">
        .container {
            width: 50%;
            margin: auto;
            padding: 20px;
            text-align: center;
            background-color: #f2f2f2;
            border-radius: 5px;
        }
    h1 {
        margin-bottom: 20px;
    }

    textarea {
        padding: 10px;
        border-radius: 5px;
        border: none;
        margin-bottom: 10px;
    }

    input[type=submit] {
        padding: 10px;
        border-radius: 5px;
        border: none;
        background-color: #4CAF50;
        color: white;
        cursor: pointer;
    }

    input[type=submit]:hover {
        background-color: #3e8e41;
    }

    input[type=reset] {
        padding: 10px;
        border-radius: 5px;
        border: none;
        background-color: #4CAF50;
        color: white;
        cursor: pointer;
    }

    input[type=reset]:hover {
        background-color: #c62828;
    }
    a{
        padding: 10px;
        border-radius: 5px;
        border: none;
        background-color: #4CAF50;
        color: white;
        cursor: pointer;
        text-decoration: none;
    }
    a:hover{
        background-color: #c62828;

    }
</style>
</head>
<body>
    <div class="container">
        <h1>Notice</h1>
        <form method="POST">
            <label>Enter Notice:</label><br>
            <textarea name="notice" rows="10" cols="50"></textarea><br>
            <input type="submit" name="submit" value="Send Notice">
            <input type="reset" name="clear" value="Clear">
            <a href="admin_notice.html">Back</a>
        </form>
    </div>
</body>
</html>
<?php
if (!empty($_POST)) {
    $con = mysqli_connect("localhost", "root", "", "cms");
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $notice = $_POST['notice'];
    $date = date('Y-m-d');
    if (!empty($notice)) {
        $sql = "INSERT INTO notice (notice, date) VALUES ('$notice', '$date')";
        if (mysqli_query($con, $sql)) {
            echo "<script>alert('Notice sent successfully');</script>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }
    }
    mysqli_close($con);
}
?>