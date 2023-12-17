<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=<div class="container">
	<div class="container"> 
</head>
<?php
$con = mysqli_connect("localhost", "root", "", "cms");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
$qid=$_GET['pu'];
$sql="SELECT student.id, student.name, query.type, query.date, query.query, query.response FROM query JOIN student ON student.id=query.id where qid='$qid'";
$rt=$con->query($sql);
$r=mysqli_fetch_assoc($rt);
$id=$r['id'];
$sn = $r['name'];
$tp=$r['type'];
$dt=$r['date'];
$qry=$r['query'];
$reply1=$r['response'];

?>
<body>
<?php
    if (!empty($reply1)) {
        echo "<script>alert('Already responded to query');</script>";
        echo'<script>window.location.href="stf_qry_view.php";</script>';
    } else {
    ?>
	<form action="" method="POST" class="form">
        <h4>RESPONCE FORM</h4>
      <h3><a href="stf_qry_view.php">Back</a></h3>
      <div class="column">
                    <div class="inputbox">
                        <label>ID<pre></pre></label>
                        <input type="text" name="id"  value=<?php echo $id;?> readonly >
                    </div>
                    <div class="inputbox">
                        <label>Name :<pre></pre></label>
                        <input type="text" name="na"  value=<?php echo $sn;?> readonly >
                    </div>
        </div> 
        <div class="column">
                    <div class="inputbox">
                        <label>Internal :<pre></pre></label>
                        <input type="number" name="tp"  value=<?php echo $tp;?> readonly >
                    </div>
                    <div class="inputbox">
                        <label>Date :<pre></pre></label>
                        <input type="date" name="dt"  value=<?php echo $dt;?> readonly >
                    </div>
        </div>
                  
<div class="inputbox">	
<label>Query </label><br><br>	 
<textarea name="sub" rows="4" cols="50" readonly>
<?php echo $qry;?>
</textarea>
</div>
                 
        
<div class="inputbox">	
<label>Responce For The Query </label><br><br>	 
<textarea name="rep" rows="4" cols="50" required >
<?php echo $reply1;?>
</textarea>
</div>
         <button type="submit" value="submit" name="submit">upload</button>
    </div>  

</form>

<?php
 if (isset($_POST['submit']))
            {
                $id=$_POST['id'];
                $name = $_POST['na'];
                $type = $_POST['tp'];
                $date = $_POST['dt'];
                $qr=$_POST['sub'];
                $resp = $_POST['rep'];
                $uqry="update query set response='".$resp."' where qid='$qid'";
                $rlt=$con->query($uqry);
                if($rlt)
                {
                    echo"<script>alert('Updated succesfully');</script>";
                    echo'<script>window.location.href="stf_qry_view.php";</script>';
                }
                else
                {
                    die(mysqli_error(($con)));
                }
            }
        }
            ?>
</body>
</html>
<style>
    
.container{
    position: relative;
    max-width: 600px;
    width: 100%;
    background-color: rgb(251, 249, 249);
    padding: 15px;
  box-shadow: 0 0 15px rgba(0,0,0,0.1);
  left: 550px;

  top: 50px;
  border-radius: 15px;
}
body{
    background-color:rgb(248, 247, 249);
}
h4{
    transform: translate(170px);
    color: blue;
    font-size: 30px;
}

.inputbox{
    width: 80%;
    margin-top: 20px;
    display: block;
    border-color: black;
}

.inputbox label{
    color: blue;
    font-size: 20px;
}

.inputbox input{
    position: relative;
    height: 50px;
    width: 200px;
    border-color: black;
    font-size: 1rem;
    color: black;
    margin-top: 8px;
    border: 1px solid white;
    border-radius: 10px;
    padding: 0 15px;
}
.inputbox textarea{
    border-radius: 10px;
   height: 70px;
   font-size: 1rem;
   color: black;
   resize:none;
}
.column{
    display: flex;
   column-gap: 15px;
}
.container button{
    height: 55px;
    width: 100%;
    color: blue;
    font-size: 1rem;
    border: none;
    margin-top: 30px;
    cursor: pointer;
    border-radius: 8px;
    color: aliceblue;
    font-weight: 400;
    background-color: rgb(90, 90, 241);
    }

    h3 a{
        color: red;
        text-decoration: none;
        margin-left: 520px;


    }

</style>