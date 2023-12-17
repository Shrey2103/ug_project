<?php
session_start();
if(isset($_SESSION['LoginStudent']))
        {
            $username = $_SESSION['LoginStudent'];
        }
        else
        {
            header('Location: login.php');
        }
        $conn = mysqli_connect("localhost","root","","cms");
        $qry="SELECT * from student where id='$username'";
        $res=mysqli_query($conn,$qry);
        $row = mysqli_fetch_assoc($res);
        $name=$row['name'];
        $course=$row['course'];
       
?>
<!DOCTYPE html>
<html>
<head>
    <title>College Feedback Form</title>
    <style type="text/css">
        body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
}

h1 {
    text-align: center;
    color: #333;
}

form {
    width: 30%;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.3);
    height: 480px;
}

label {
    display: inline-block;
    margin-bottom: 5px;
    font-weight: bold;
}

input[type="text"], input[type="email"], input[type="number"]{
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    margin-bottom: 10px;
    resize: none;
}

input[type="submit"], input[type="reset"]  {
    background-color: #4CAF50;
    color: #fff;
    border: none;
    padding: 12px 20px;
    border-radius: 4px;
    cursor: pointer;
    float: left;
}

input[type="submit"]:hover {
    background-color: #45a049;
}
input[type="reset"]  {
    position: relative;
    left: 110px;
    }


    </style>
</head>
<body>
    <h1>Article</h1>
    <form method="POST">
    <label>Roll Number:</label>
        <input type="text"  name="id" value="<?php echo $username; ?>" readonly><br><br>
        <label>Name:</label>
        <input type="text"  name="name" value="<?php echo $name; ?>"readonly><br><br>
         <label>Course:</label>
        <input type="text"  name="course" value="<?php echo $course; ?>" readonly><br><br>
        <label>description:</label>
        <input type="text"  name="course"  required><br><br>
        <label>Uplode Article:</label><br>
        <input type="file"  name="fileupload" required><br><br>

        <input type="submit" name="submit" value="submit">
        
    </form>
</body>
</html>




<?php
    if(isset($_POST['submit'])) {
    $con = mysqli_connect("localhost","root","","cms");
    // check connection
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // get the form data
    $filename= $_FILES["fileupload"]["name"];
    $tmpname=$_FILES["fileupload"]["tmp_name"];
    $folder="article/".$filename;
    move_uploaded_file($tmpname, $folder);
    $roll = $_POST['roll'];
    $name = $_POST['name'];
    $class = $_POST['class'];
    $date = date('Y-m-d');

    // insert the feedback into the database
    $sql = "INSERT INTO article (rno, name, depart, date, image) VALUES ('$roll','$name', '$class','$date','$folder')";

    if (mysqli_query($con, $sql)) {
        echo "<script>alert('Article submitted successfully');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    // close the database connection
    mysqli_close($con);
    }
?>


















