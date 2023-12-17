<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background:url(backgrounds/studback.jpg);
        }
        
        body {
            margin: 0;
            padding: 0;
        }

        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #f0f0f0;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            z-index: 999;
        }

        .navbar-inner {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
        }

        .navbar-logo {
            font-size: 18px;
            font-weight: bold;
            color: #333;
            text-decoration: none;
        }

        .navbar-nav {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
        }

        .navbar-nav li {
            margin-left: 10px;
        }

        .navbar-nav li a {
            color: #555;
            text-decoration: none;
        }

        /* Additional neutral colors */
        .text-light {
            color: #888;
        }

        .text-muted {
            color: #999;
        }
        
        .dashboard {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #f0f0f0;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            z-index: 999;
        }
        
        .logo {
            font-size: 24px;
            font-weight: bold;
        }
        
        .navigation {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }
        
        .navigation li {
            display: inline-block;
            margin-right: 10px;
        }
        
        .navigation li a {
            text-decoration: none;
            padding: 5px;
            border-radius: 5px;
        }
        
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            z-index: 1;
            padding: 12px 0;
            border-radius: 5px;
        }

        .dropdown-content a {
            color: #333;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #ddd;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .b {
            text-decoration: none;
            padding: 5px;
            border-radius: 5px;
        }
        
        /* Light Mode */
        body.light-mode {
            background-color: #f2f2f2;
            color: #333;
        }
        
        body.light-mode .navigation li a {
            color: #333;
        }
        
        body.light-mode .navigation li a:hover {
            background-color: #333;
            color: #f2f2f2;
        }
        .profile-view {
            display: none; /* Initially hide the profile view section */
            margin-top: 20px;
        }

        .profile-view table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .profile-view table td,
        .profile-view table th {
            padding: 10px;
            border: 1px solid #ccc;
        }

        .profile-view table th {
            background-color: #f0f0f0;
            color: #333;
        }
        table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      border: 1px solid #ddd;
      padding: 8px;
    }

    th {
      background-color: #f2f2f2;
    }

    /* Adjust the width of the description column */
    td:nth-child(4) {
      white-space: pre-wrap;
    }
    #coursesSection {
    margin-top: 80px; 
    }
    
    </style>

</head>
<body class="light-mode">
    <div class="dashboard">
        <div class="logo">Student Dashboard -->
        <?php
        if(isset($_SESSION['LoginStudent']))
        {
            $username = $_SESSION['LoginStudent'];
            echo " $username";
        }
        else
        {
            header('Location: login.php');
        }
        ?>
        </div>
        <ul class="navigation">
            <li>
                <a href="student_dash.php">HOME</a>
            </li>
            <li class="dropdown">
            <a href="#">Profile</a>
                <div class="dropdown-content">
                    <a href="stud_prof.php">View Profile</a>
                    <a href="update_stud_prof.php">Update Profile</a>
                </div>
            </li>
            <li><a href="view_stud_course.php">Courses</a></li>
            <li class="dropdown">
                <a href="#">Feedback</a>
                <div class="dropdown-content">
                    <a href="student_feedback.php">Add Feedback</a>
                    <a href="student_view_feedback.php">View Feedback</a>
                </div>
            </li>
            <li class="dropdown">
                <a href="#">Marks</a>
                <div class="dropdown-content">
                    <a href="view_Sdmarks.php">View Marks</a>
                    <a href="stud_query.php">Send Queries</a>
                </div>
            </li>
            <li><a href="student_view_notice.php">Notice</a></li>
            <li class="dropdown">
                <a href="#">Article</a>
                <div class="dropdown-content">
                    <a href="upload.php">Add Article</a>
                    <a href="view_studArt.php">View Article</a>
                </div>
            </li>
        </ul>
        <button class="b"><a href='logout.php'>Logout</a></button>
    </div>


</body>
</html>
