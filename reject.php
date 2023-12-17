<?php
$con=mysqli_connect("localhost","root","","cms");
			if(!$con){
				die(mysqli_err());
			}
if(isset($_POST['btn-reject'])){
	$sno=$_POST['sno'];
	$qry="DELETE from student_det where sno='".$sno."'";
	$res=$con->query($qry);
	if($res){
		echo"<script>alert('record rejected');</script>";
		echo"<script>window.location.href='viewstd.php';</script>";
		
	}

}

?>