<?php
$con=mysqli_connect("localhost","root","","cms");
if(!$con){
    die(mysqli_err());
}
if(isset($_POST['btn-accept'])){
    $sno=$_POST['sno'];
    
if($sno){
    
    
}
}

?>
<?php

if(isset($_POST['submit'])){
    $roll=$_POST['roll'];
    $qry="SELECT * from student_det where roll='".$roll."'";
    $result=$con->query($qry);
    if($result->num_rows==0){
    $sql="UPDATE student_det set roll='$roll',status='approved' where roll='$roll'";
  $res=$con->query($sql);
  if($res){
    echo"<script>alert('application accepted');</script>";
  }
}
else{
    echo"<script>alert('roll number already exist');</script>";
        
}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>student registration</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body{
            background-image: url("");
        }
       
        
		form {
            background:white;
			width: 35%;
			margin: auto;
			padding: 20px;
			border: 1px solid #ccc;
			border-radius: 10px;
			box-shadow: 0 0 10px rgba(0,0,0,0.2);
		}
        form .h2{
            text-align:center;
        }

		label, input, select {
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
		.submit{
			margin-top: 20px;
			background-color: #4CAF50;
			color: white;
			padding: 10px;
			border: none;
			border-radius: 5px;
			cursor: pointer;
			float:right;
			
		}
	</style>

</head>
<body>
	
        <form action="" method="POST" enctype="multipart/form-data">
        <h2>STUDENT REG FORM</h2>
            <label>Roll Number</label>
            <input type="text" name="roll" placeholder="enter rollnum" >

            <input type="submit" name="submit" value="submit">
            <button class="submit"><a href="viewstd.php">Back</a></button>
        </form>

</body>
</html>
<?php

?>