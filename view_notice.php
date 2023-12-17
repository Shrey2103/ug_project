 <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View Notice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            overflow: auto;
            height: 450px;
            position: relative;

            top: 80px;
            
        }
        .abc {
            text-align: center;
            position: sticky;
            z-index: 1;
            top: 0;
        }

        .notice {
            margin-bottom: 20px;
            padding: 20px;
            background-color: #ffffcc; 
            border-radius: 5px;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
            word-wrap: break-word;
            position: relative;
       
        }

        .notice p:first-child {
            margin-top: 0;
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }

       .notice .date {
        position: absolute;
        bottom: 10px;
        right: 10px;
        font-size: 12px;
        color: #999;
    }
        .notice form {
            display: inline-block;
        }

        .notice input[type="submit"] {
            border: none;
            background-color: #f44336;
            color: #fff;
            padding: 6px 12px;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
        }

        .notice input[type="submit"]:hover {
            background-color: #e53935;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #666;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="abc">
        <h1>View Notice</h1>
        </div>
        <?php
        $conn = mysqli_connect("localhost", "root", "", "cms");
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        if (isset($_POST['delete'])) {
            $id = $_POST['id'];
            $sql = "DELETE FROM notice WHERE sno='$id'";
            if (mysqli_query($conn, $sql)) {
                echo "<script>alert('Notice deleted successfully');</script>";
            } else {
                echo "Error deleting notice: " . mysqli_error($conn);
            }
        }

        $sql = "SELECT * FROM notice";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='notice'>";
            echo "<p><strong>" . $row["notice"] . "</strong></p>";
            echo "<p class='date'>" . date('Y-m-d', strtotime($row["date"])) . "</p>";
            echo "<form method='POST'>";
            echo "<input type='hidden' name='id' value='" . $row["sno"] . "'>";
            echo "<input type='submit' name='delete' value='Delete'>";
            echo "</form>";
            echo "</div>";

            }
        } else {
            echo "<p>No notices found</p>";
        }
        mysqli_close($conn);
        ?>
        <a href="admin_notice.html">Back</a>
    </div>
</body>
</html>













