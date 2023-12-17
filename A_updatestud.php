<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Staff</title>
    <script>
    var currentDate = new Date();

    var minDate = new Date();
    minDate.setFullYear(currentDate.getFullYear() - 100);

    var maxDate = new Date();
    maxDate.setFullYear(currentDate.getFullYear() - 20);

    var minDateString = minDate.toISOString().split('T')[0];
    var maxDateString = maxDate.toISOString().split('T')[0];

    window.onload = function() {
      document.getElementById("dob").setAttribute("min", minDateString);
      document.getElementById("dob").setAttribute("max", maxDateString);
    };
  </script>
    <link rel="stylesheet" href="css/staff_stud.css">
</head>
<body>
    <section class="container">
        <div class="scrolling">

        <?php
        $con = mysqli_connect("localhost", "root", "", "cms");
        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $id=$_GET['upt'];
        $sql="select * from student where id='$id' and status='available'";
        $rt=$con->query($sql);
        $r=mysqli_fetch_assoc($rt);
        $sn=$r['name'];
        $fn=$r['fname'];
        $mn=$r['mname'];
        $db=$r['dob'];
        $eid=$r['email'];
        $ten=$r['tenth'];
        $twl=$r['twlth'];
        $course=$r['course'];
        $ad=$r['address'];
        $phone=$r['phone'];
        $pass=$r['pass'];

            if (isset($_POST['dregister']))
            {
                $name=$_POST['na'];
                $mb=$_POST['mb'];
                $tn=$_POST['tent'];
                $tw=$_POST['twel'];
                $fna=$_POST['fn'];
                $mna=$_POST['mn'];
                $crs=$_POST['crs'];
                $adr=$_POST['ad'];
                $dob=$_POST['db'];
                $ps=$_POST['ps'];
                $cps=$_POST['cps'];
                $email=$_POST['ed'];
                
                if($sn==$name && $db==$dob && $eid==$email && $ten==$tn && $twl==$tw && $fn==$fna && $mn==$mna&&$course=$crs && $pass==$ps && $ad==$adr && $phone==$mb)
                {
                    echo"<script>alert('No changes where made');</script>";
                    echo'<script>window.location.href="viewstd.php";</script>';
                }
                else
                {

                if($ps==$cps)
                {
                    $uqry = "UPDATE student SET name='$name', dob='$dob', fname='$fna', mname='$mna', email='$email', phone='$mb', address='$adr', tenth='$tn', twlth='$tw', course='$crs', pass='$ps' WHERE id='$id'";
                    $rlt = $con->query($uqry);
                    
                    if($rlt)
                    {
                        echo"<script>alert('Updated succesfully');</script>";
                        echo'<script>window.location.href="viewstd.php";</script>';
                    }
                    else
                    {
                        die(mysqli_error(($con)));
                    }
                }
                else
                {
                    echo "<b><center><h3>password mismatch</h3></center></b>";
                } 
                }
            }


        ?>

        <header>Staff edit form</header>
        <form action="" method="POST" class="form">
         <a href="viewstd.php">Back</a>
            <div class="inputbox">
                <label>Student Name</label>
                <input type="text" placeholder="Enter staff name" name="na" value="<?php echo $sn;?>" autocomplete="off" required />
            </div>
            <div class="inputbox">
                <label>Mobile Number</label>
                <input type="number" placeholder="Enter mobile number" required min="1000000000" max="9999999999" value="<?php echo $phone;?>" name="mb"/>
            </div>
            <div class="column">
                <div class="inputbox">
                <label>Email</label>
                    <input type="email" id="email" placeholder="Enter Email" value="<?php echo $eid;?>" required name="ed"/>     
                  </div>
                <div class="inputbox">
                    <label>Course</label>
                    <input type="text" placeholder="Enter Qualification" value="<?php echo $course;?>" required name="crs"/>
                </div>
            </div>
            <div class="inputbox">
                <label>Address</label><br>
                <input type="text" placeholder="Enter full address" value="<?php echo $ad;?>" required name="ad" autocomplete="off"/>
            </div>

            <div class="column">          
                <div class="inputbox">
                    <label>Date Of Birth</label>
                    <input type="date" id="dob" value="<?php echo $db; ?>" required name="db"/>
                </div>
                <div class="inputbox">
                    <label>10th %</label>
                    <input type="text" placeholder="Enter 10th %" value="<?php echo $ten;?>" autocomplete="off" required name="tent"/>
                </div>
                <div class="inputbox">
                    <label>12th %</label>
                    <input type="text" placeholder="Enter 12th %" value="<?php echo $twl;?>" autocomplete="off" required name="twel"/>
                </div>
            </div>
            <div class="column">          
                <div class="inputbox">
                    <label>Father Name:</label>
                    <input type="text" placeholder="Enter Father name" value="<?php echo $fn;?>" required name="fn"/>
                </div>
                <div class="inputbox">
                    <label>Mother Name:</label>
                    <input type="text" placeholder="Enter Mother name" value="<?php echo $mn;?>" autocomplete="off" required name="mn"/>
                </div>
            </div>
           
            <div class="column">
                <div class="inputbox">
                    <label>Enter new password</label>
                    <input type="text" placeholder="Enter password" value="<?php echo $pass;?>" name="ps" required/>
                </div>
                <div class="inputbox">
                    <label>Confirm password</label>
                    <input type="text" placeholder="Confirm password" value="<?php echo $pass;?>" name="cps" required/>
                </div>
            </div>
            <button type="submit" name="dregister">Update</button>
        </form>
        </div>
    </section>
</body>
</html>
