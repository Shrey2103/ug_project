<?php
$con=mysqli_connect("localhost","root","","cms");
if(!$con){
    die("connection failed".mysqli_connect_error());
}


$read="SELECT * from student order by id desc limit 1";
$result=mysqli_query($con,$read);

if($result){
 $fetch=mysqli_fetch_assoc($result);
 $lastroll=$fetch['id'];

 if($lastroll==null){
    $newroll="STUD230001";

 }else{

        $newroll=str_replace("STUD23","",$lastroll);
        $newroll=str_pad($newroll+1,4,0,STR_PAD_LEFT);
        $newroll="STUD23".$newroll;

 }

}
else{
    echo"<script>alert('no record found');</script>";
    echo "<script>window.location.href='addstd.php';</script>";
    exit;

}

 if(isset($_POST['submit'])){
   
        $filename= $_FILES["fileupload"]["name"];
        $tmpname=$_FILES["fileupload"]["tmp_name"];
        $folder="images/".$filename;
        move_uploaded_file($tmpname, $folder);
  
  $name=$_POST['name'];
  $roll=$_POST['id'];
  $gn=$_POST['gn'];
  $eid=$_POST['eid'];
  $db=$_POST['db'];
  $adr=$_POST['adr'];
  $crs=$_POST['crs'];
  $ten=$_POST['ten'];
  $twl=$_POST['puc'];
  $num=$_POST['num'];
  $pass=$_POST['pass'];
  $type="student";
  
    $SQL="SELECT * FROM student WHERE id='$roll'";
    $rslt=$con->query($SQL);
    if($rslt->num_rows!=0){
        echo"<script>alert('roll number already exist');</script>";
        echo "<script>window.location.href='addstd.php';</script>";
        exit;
    }else{
  $sql="INSERT INTO student (id,name,image,email,phone,dob,gender,tenth,twlth,course,address,status,pass)VALUES('$roll','$name','$folder','$eid','$num','$db','$gn','$ten','$twl','$crs','$adr','available','$pass')";
  $res=$con->query($sql);


  $sql1="INSERT INTO login(type,id,pass)VALUES('$type','$roll','$pass')";
  $res1=$con->query($sql1);
 
  if($res){
    echo"<script>alert('inserted');</script>";
    echo "<script>window.location.href='admin_student.php';</script>";
    exit;
  }
  else{
    die(mysqli_error());
  }
  }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add student</title>
    <style>
        body {
				  font-family: Arial, sans-serif;
				  background-color: lightblue;
				  background-image: url(1.jpg);
				  background-repeat: no-repeat;
				  background-size: cover;

				}

				form {
				  background-color: #fff;
				  max-width: 400px;
				  margin: 0px auto;
				  padding: 30px;
				  border-radius: 5px;
				  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
				  top: 75px;
				  position: relative;

				}

				h1 {
				  text-align: center;
				  margin-top: 0;
				}

				label {
				  display: block;
				  margin-bottom: 5px;
				}

				input[type="number"],
				input[type="text"],
				input[type="email"],
				input[type="password"],
				input[type="date"] {
				  width: 100%;
				  padding: 10px;
				  border-radius: 3px;
				  border: 1px solid #ccc;
				  box-sizing: border-box;
				  margin-bottom: 10px;
				}

				input[type="file"] {
				  margin-bottom: 20px;
				}

				input[type="submit"] {
				  background-color: #4CAF50;
				  color: #fff;
				  border: none;
				  padding: 10px 20px;
				  border-radius: 3px;
				  cursor: pointer;
				  font-size: 16px;
				}

				input[type="submit"]:hover {
				  background-color: #3e8e41;
				}
				a{
					background-color: #4CAF50;
				  color: #fff;
				  border: none;
				  padding: 10px 20px;
				  border-radius: 3px;
				  cursor: pointer;
				  font-size: 16px;
				  text-decoration: none;
				  float: right;
				}
				a:hover{
					 background-color: #3e8e41;
				}

				.error {
				  color: red;
				  font-style: italic;
				  font-size: 12px;
				  margin-bottom: 5px;
				}

				.container {
				  height: 500px;
				  overflow-y: scroll; 
				}

	</style>
</head>
<body>
    <form action="" method="POST" enctype="multipart/form-data">
        <h2>STUDENT REG FORM</h2>
        <label>Course:</label>
            <select name="crs" style="width: 172px;">
            <?php
					    $c=0;
					    $qry="SELECT * from course";
					    $res=$con->query($qry);
					    $nob=$res->num_rows;
					    while($c<$nob){
						    $row=$res->fetch_assoc();
						    echo "<option>".$row['cname']."</option>";
						    $c=$c+1;
				    	}
				     ?>
            </select>
        <label>Roll Num:</label>
           <input type='text' name='id' value="<?php echo $newroll; ?>"  readonly> 

            <label>Name:</label>
            <input type="text" name="name" placeholder="Enter Name" required>
            
            
            <label>Image:</label>
            <input type="file" name="fileupload">
            
            <label>Email:</label>
            <input type="email" name="eid" placeholder="Enter Email" required>
            
            <label>Phone Number</label>
            <input type="number" name="num" placeholder="Enter Number" required>
            
            <label>DOB:</label>
            <input type="date" name="db"  required>
            
            <label>Gender:</label>
            <select name="gn" style="width: 172px;">
                <option>Male</option>
                <option>Female</option>
            </select>
            

            <label>10th Marks in %:</label>
            <input type="number" min="0" max="100" name="ten" placeholder="Enter 10th Marks" required style="width: 168px;">
            
            <label>PUC Marks in %:</label>
            <input type="number" min="0" max="100" name="puc" placeholder="Enter PUC Marks" required style="width: 168px;">

            <label>Address:</label>
            <input type="text" name="adr" placeholder="Address" required>
            
            <label>Password:</label>
            <input type="password" name="pass" value="<?php echo $newroll; ?>" readonly>
       
            <input type="submit" name="submit" value="submit">

    </form>

    
      <button onclick="window.location.href='admin_student.php'">Back</button>

</body>
</html>

