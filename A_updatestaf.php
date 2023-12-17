<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Staff</title>
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
        $sql="select * from staff where id='$id'";
        $rt=$con->query($sql);
        $r=mysqli_fetch_assoc($rt);
        $sn=$r['name'];
        $db=$r['dob'];
        $eid=$r['email'];
        $qual=$r['qual'];
        $depart=$r['depart'];
        $ad=$r['address'];
        $phone=$r['phone'];
        $pass=$r['pass'];


        if (isset($_POST['dregister']))
        {
            $name=$_POST['na'];
            $mb=$_POST['mb'];
            $ql=$_POST['qual'];
            $dep=$_POST['depart'];
            $adr=$_POST['ad'];
            $dob=$_POST['db'];
            $ps=$_POST['ps'];
            $cps=$_POST['cps'];
            $email=$_POST['ed'];
            
            if($sn==$name && $db==$dob && $eid==$email && $qual==$ql && $depart==$dep && $pass==$ps && $ad==$adr && $phone==$mb)
            {
                echo"<script>alert('No changes were made');</script>";
                echo'<script>window.location.href="viewstf.php";</script>';
            }
            else
            {

            if($ps==$cps)
            {
                $uqry="UPDATE staff SET name='$name', dob='$dob', email='$email', phone='$mb', address='$adr', qual='$ql', depart='$dep', pass='$ps' where id='$id'";
                $rlt=$con->query($uqry);
                if($rlt)
                {
                    echo"<script>alert('Updated successfully');</script>";
                    echo'<script>window.location.href="viewstf.php";</script>';
                }
                else
                {
                    die(mysqli_error(($con)));
                }
            }
            else
            {
                echo "<b><center><h3>Password mismatch</h3></center></b>";
            } 
            }
        }
        ?>

        <header>Staff edit form</header>
        <form action="" method="POST" class="form">
            <a href="viewstf.php">Back</a>
            <div class="inputbox">
                <label>Staff Name</label>
                <input type="text" placeholder="Enter staff name" name="na" value="<?php echo $sn;?>" autocomplete="off" required />
            </div>
            <div class="inputbox">
                <label>Mobile Number</label>
                <input type="number" placeholder="Enter mobile number" required min="1000000000" max="9999999999" value="<?php echo $phone;?>" name="mb"/>
            </div>
            <div class="column">
                <div class="inputbox">
                    <label>Email</label>
                    <input type="email" placeholder="Enter Email" value="<?php echo $eid;?>" required name="ed"/>     
                </div>
                <div class="inputbox">
                    <label>Qualification</label>
                    <input type="text" placeholder="Enter Qualification" value="<?php echo $qual;?>" required name="qual"/>
                </div>
            </div>
            <div class="inputbox">
                <label>Address</label><br>
                <input type="text" placeholder="Enter full address" value="<?php echo $ad;?>" required name="ad" autocomplete="off"/>
            </div>

            <div class="column">          
                <div class="inputbox">
                    <label>Date Of Birth</label>
                    <input type="date" class="dob" placeholder="Enter Birth Date" value="<?php echo $db;?>" required name="db"/>
                </div>
                <div class="inputbox">
                    <label>Depart</label>
                    <input type="text" placeholder="Enter depart" value="<?php echo $depart;?>" autocomplete="off" required name="depart"/>
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
    <script>
    var currentDate = new Date();
    var minDate = new Date();
    minDate.setFullYear(currentDate.getFullYear() - 100);
    var maxDate = new Date();
    maxDate.setFullYear(currentDate.getFullYear() - 20);
    var minDateString = minDate.toISOString().split('T')[0];
    var maxDateString = maxDate.toISOString().split('T')[0];
    window.onload = function() {
        var dateInputs = document.getElementsByClassName("dob");
        for (var i = 0; i < dateInputs.length; i++) {
            dateInputs[i].setAttribute("min", minDateString);
            dateInputs[i].setAttribute("max", maxDateString);
        }
    };
    </script>
</body>
</html>
