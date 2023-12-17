<?php
session_start();
if(isset($_SESSION['LoginStaff']))
        {
            $username = $_SESSION['LoginStaff'];
        }
        else
        {
            header('Location: login.php');
        }
$con = mysqli_connect("localhost", "root", "", "cms");
if (!$con) {
    die(mysqli_error());
}

$qry = "SELECT s.id, s.name, s.depart ,l.type, l.date, l.num, l.reason, l.status FROM staff_leave l JOIN staff s ON s.id=l.id where l.id='$username'";
$res = $con->query($qry);
$nob = $res->num_rows;

if ($nob > 0) {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Staff Leave Details</title>
        <style>
        .table-container {
            width: 95%;
            margin: 0 auto;
            max-height: 540px;
            overflow: auto;
            border-radius: 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }

        th,
        td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        .table-heading {
            position: sticky;
            top: 0;
            background-color: black;
            color: #fff;
            z-index: 1;
            border-radius: 10px;
        }

        th {
            background-color: black;
            color: #fff;
        }

        tr:hover {
            background-color: #ddd;
        }

        .back-button {
            margin-top: 20px;
            background-color: blue;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 90px;
            text-decoration: none;
            display: flex;
            position: fixed;
            bottom: 50px;
            left: 50px;
            align-items: center;
            justify-content: center;
        }

        .back-button:hover {
            background-color: #3e8e41;
        }

        .R{
            width: 90px;
            padding: 10px;
            background-color: green;
            border-radius: 5px;
            color: white;

        }
        .G{
            width: 90px;
            padding: 10px;
            background-color: red;
            border-radius: 5px;
            color: white;
        }
    </style>
    </head>
    <body>
        <h1 align="center">Staff Leave Details</h1>
        <table class="content-table">
            <thead>
                <tr>
                    <th>Staff ID</th>
                    <th>Name</th>
                    <th>Leave Type</th>
                    <th>Date</th>
                    <th>No. of Days</th>
                    <th>Reason</th>
                    <th>Status</th>
                    <th>Available Leave</th>
                </tr>
            </thead>
            <?php
            for ($i = 0; $i < $nob; $i++) {
                $r = $res->fetch_assoc();
                ?>
                <tbody>
                    <tr>
                        <th><?php echo $r['id']; ?></th>
                        <th><?php echo $r['name']; ?></th>
                        <th><?php echo $r['type']; ?></th>
                        <th><?php echo $r['date']; ?></th>
                        <th><?php echo $r['num']; ?></th>
                        <th><?php echo $r['reason']; ?></th>
                        <th><?php echo $r['status']; ?></th>
                        <th>
                            <?php
                            // Retrieve available leave from the staff table
                            $staffId = $r['id'];
                            $staffQuery = "SELECT total_leave FROM staff WHERE id='$staffId'";
                            $staffResult = $con->query($staffQuery);
                            if ($staffResult && $staffResult->num_rows > 0) {
                                $staffData = $staffResult->fetch_assoc();
                                $availableLeave = $staffData['total_leave'];
                                echo $availableLeave;
                            } else {
                                echo "N/A";
                            }
                            ?>
                        </th>
                        
                    </tr>
                </tbody>
                <?php
            }
            ?>
        </table>

        <a href="stf_leave.php">Back</a>
    </body>
    </html>
    <?php
} else {
    echo "<script>alert('No leave application found');</script>";
    echo "<script>window.location.href='stf_leave.php';</script>";
}
?>