<!-- <?php
if(isset($_POST['submit'])){
    $con = mysqli_connect("localhost", "root", "", "cms");
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $name=strtoupper($_POST['nm']);
    $fname=strtoupper($_POST['fnm']);
    $fs=$_POST['fe'];
    $des = $_POST['des'];
    $SQL="select * from course where cname='$name'";
    $res=$con->query($SQL);
    if($res->num_rows!=0){
    	echo "<script>alert('course already exist');window.location.href = 'addCourse.php';</script>";
    	exit;
    }
    else{
        $sql = "INSERT INTO course (cname,full,fees,des) VALUES ('$name' ,'$fname', '$fs','$des')";
        if (mysqli_query($con, $sql)) {
            echo "<script>alert('course saved successfully');</script>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }
    }
    mysqli_close($con);
}
?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="demo.css">
	<title>Course</title>
	<style>
		body {
/*			background-image: url("reg_back.jpg");*/
		}

		form {
			background: white;
			width: 30%;
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

		.bc {
			height: 200px;
			width: 400px;
		}

		button {
			margin-top: 20px;
			background-color: #4CAF50;
			color: white;
			padding: 10px;
			border: none;
			border-radius: 5px;
			cursor: pointer;
		}

		button:hover {
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
		<h2>Course</h2>

		<label>Name of course:</label>
		<input type="text" name="nm" placeholder="Enter course" pattern="[A-Za-z ]+" title="Only alphabets and spaces are allowed" required>


		<label>Full nam:</label>
		<input type="text" name="fnm" placeholder="Enter full name of course" pattern="[A-Za-z ]+" title="Only alphabets and spaces are allowed" required>

		<label>Total fees:</label>
		<input type="number" name="fe" placeholder="Enter Total fees" pattern="[0-9]{5}" title="Please enter a 5-digit fees which is sutable for course" required>

        <label>Descriptive about course:</label>
        <textarea class="myTextbox" name="des" placeholder="Enter some detail about course Description"></textarea>

		<input type="submit" name="submit" value="Submit">
		<button onclick="window.location.href='admin_course.html'" style="float:right;">Back</button>
	</form>
	
</body>
</html>




 -->













 

 <!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="demo.css">
	<title>Course</title>
	<style>
		body {
/*			background-image: url("reg_back.jpg");*/
		}

		.form-container {
			background: white;
			width: 30%;
			margin: auto;
			padding: 20px;
			border: 1px solid #ccc;
			border-radius: 10px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
		}

		.form-container h2 {
			text-align: center;
		}

		.form-group {
			margin-bottom: 10px;
		}

		.form-group label {
			display: block;
		}

		.form-group input,
		.form-group select,
		.form-group textarea {
			width: 95%;
			padding: 8px;
			border: 1px solid #ddd;
			border-radius: 5px;
		}

		.form-group input[type="submit"] {
			margin-top: 20px;
			background-color: #4CAF50;
			color: white;
			padding: 10px;
			border: none;
			border-radius: 5px;
			width: 100px;
			cursor: pointer;
		}

		.form-group input[type="submit"]:hover {
			background-color: #3e8e41;
		}

		.form-group textarea {
			height: 200px;
			width: 95%;
			font-size: 16px;
			resize: none;
		}

		a{
			margin-top: 20px;
			background-color: #4CAF50;
			color: white;
			padding: 10px;
			border: none;
			border-radius: 5px;
			width: 100px;
			cursor: pointer;
			float: right;
			text-align: center;
			text-decoration: none;
		}
	</style>
</head>
<body>
	<div class="form-container">
		<h2>Course</h2>
		<form action="" method="POST">
			<div class="form-group">
				<label for="nm">Name of course:</label>
				<input type="text" name="nm" id="nm" placeholder="Enter course" pattern="[A-Za-z ]+" title="Only alphabets and spaces are allowed" required>
			</div>

			<div class="form-group">
				<label for="fnm">Full name:</label>
				<input type="text" name="fnm" id="fnm" placeholder="Enter full name of course" pattern="[A-Za-z ]+" title="Only alphabets and spaces are allowed" required>
			</div>

			<div class="form-group">
				<label for="fe">Total fees:</label>
				<input type="number" name="fe" id="fe" placeholder="Enter Total fees" pattern="[0-9]{5}" title="Please enter a 5-digit fees which is suitable for the course" required>
			</div>

			<div class="form-group">
				<label for="des">Descriptive about course:</label>
				<textarea name="des" id="des" placeholder="Enter some detail about course" required></textarea>
			</div>

			<div class="form-group">
				<input type="submit" name="submit" value="Submit">
				<a href="admin_course.html">Back</a>

			</div>
		</form>
	</div>
</body>
</html> 






