<?php
 session_start();
   $con=mysqli_connect("localhost","root","","cms");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login Page</title>
  <style>
    body {
  margin: 0;
  padding: 0;
  font-family: sans-serif;
  background: #34495e;
}

.login-page {
  width: 360px;
  padding: 8% 0 0;
  margin: auto;
}

.form {
  position: relative;
  z-index: 1;
  background: #FFFFFF;
  max-width: 360px;
  margin: 0 auto 100px;
  padding: 45px;
  text-align: center;
  box-shadow: 0 0 20px 0px rgba(0, 0, 0, 0.2), 0 5px 5px 0px rgba(0, 0, 0, 0.24);
  border-radius: 5px;
}

.form input[type="text"],
.form input[type="password"] {
  font-family: sans-serif;
  outline: 0;
  background: #f2f2f2;
  width: 100%;
  border: 0;
  margin: 0 0 15px;
  padding: 15px;
  box-sizing: border-box;
  font-size: 14px;
  border-radius: 5px;
}

.form select {
  font-family: sans-serif;
  outline: 0;
  background: #f2f2f2;
  width: 100%;
  border: 0;
  margin: 0 0 15px;
  padding: 15px;
  box-sizing: border-box;
  font-size: 14px;
  border-radius: 5px;
}

.form input[type="submit"] {
  font-family: sans-serif;
  text-transform: uppercase;
  outline: 0;
  background: #4CAF50;
  width: 100%;
  border: 0;
  padding: 15px;
  color: #FFFFFF;
  font-size: 14px;
  -webkit-transition: all 0.3 ease;
  transition: all 0.3 ease;
  cursor: pointer;
  border-radius: 5px;
}

.form input[type="submit"]:hover,.form input[type="submit"]:active,.form input[type="submit"]:focus {
  background: #43A047;
}

.form .message {
  margin: 15px 0 0;
  color: #b3b3b3;
  font-size: 12px;
}

.form .message a {
  color: #4CAF50;
  text-decoration: none;
}

.form .register-form {
  display: none;
}

.container {
  position: relative;
  z-index: 1;
  max-width: 300px;
  margin: 0 auto;
}

.container:before, .container:after {
  content: "";
  display:block;
clear: both;
}

.container .info {
margin: 50px auto;
text-align: center;
}

.container .info h1 {
margin: 0 0 15px;
padding: 0;
font-size: 36px;
font-weight: 300;
color: #1a1a1a;
}

.container .info span {
color: #4d4d4d;
font-size: 12px;
}

.container .info span a {
color: #000000;
text-decoration: none;
}

.container .info span .fa {
color: #EF3B3A;
}

::-webkit-input-placeholder {
color: #b3b3b3;
}

:-moz-placeholder {
color: #b3b3b3;
}

::-moz-placeholder {
color: #b3b3b3;
}

:-ms-input-placeholder {
color: #b3b3b3;
}

  </style>
</head>
<body>
  <div class="login-page">
    
    <div class="form">
        <h2>LOGIN</h2>
        
      <form method="POST" action="login.php"class="login-form" autocomplete="off">
        
        <input type="text" name="user" placeholder="username"/>
        <input type="password" name="pass" placeholder="password"/>
        <input type="submit" name="submit" value="LOGIN">
      </form><br>
      <a href="index.html">HOME</a>
    </div>
  </div>
  
</body>
</html>
<?php 
//session_start();
  
    if(isset($_POST["submit"]))
    {
        $username=$_POST["user"];
        $password=$_POST["pass"];

        $query="select * from login where id='$username' and pass='$password'";
        $result=mysqli_query($con,$query);
        if (mysqli_num_rows($result)>0) {
            while ($row=mysqli_fetch_array($result)) {
                if ($row["type"]=="admin")
                {
                    $_SESSION['LoginAdmin']=$row["id"];
                    header('Location: admin_dash.php');
                }
                else if ($row["type"]=="staff")
                {
                    $_SESSION['LoginStaff']=$row["id"];
                    header('Location:staff_dsh.php');
                }
                else if ($row["type"]=="student")
                {
                    $_SESSION['LoginStudent']=$row['id'];
                    header('Location:student_dash.php');
                }
                
            }
        }
        else
        {
          echo"<script>alert('login error');</script>";
            //header("Location: login.php");
            session_destroy();
        }
    }
    //session_destroy();
?>
