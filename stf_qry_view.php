<?php
session_start();
if (isset($_SESSION['LoginStaff'])) {
    $username = $_SESSION['LoginStaff'];
} else {
    header('Location: login.php');
}
$con = mysqli_connect("localhost", "root", "", "cms");
if (!$con) {
    die(mysqli_error());
}
$sql="SELECT depart, image from staff where id='$username'";
$reslt=$con->query($sql);
$row=$reslt->fetch_assoc();
$department = $row['depart']; // Change the department based on the logged-in staff
$img=$row['image'];
$_SESSION['department'] = $department;


?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Query View</title>
    <style>
table {
        border-collapse: collapse;
        width: 100%;
        margin: 0 auto;
        font-family: Arial, sans-serif;
        font-size: 14px;
      }
      
      th, td {
        text-align: left;
        padding: 10px;
        border-bottom: 1px solid #ddd;
		    text-align: center;
      } 
	    .form {
		    overflow: auto;
		      display:flex;
		    flex-direction :column;
		    align-items: center;
		    max-height:400px;
	    }
    
      
	   .head{
		  position:sticky;
		  z-index: 1;
		  top:0;
     } 
      th {
        background-color: #333;
        color: white;
        
      }
      
      tr:nth-child(even) {
        background-color: #f2f2f2;
      }
      
      tr:hover {
        background-color: #ddd;
      }
	  .txt{
		padding-top: 10px;
    	border-top-width: 2px;
		font-size: large;
	  }
	  .b1 {
      display: inline-block;
 		 padding: 10px 20px;
 		 background-color: blue;
 		 color: white;
 		 text-decoration: none;
  		border-radius: 5px;
  		transition: background-color 0.2s ease-in-out;
		}

		.b1 a{
			color: white;
			text-decoration: none;
		}

    </style>

</head>
<body>
<?php
                $qry="SELECT student.id, student.name, student.status,query.response, query.qid, query.date, query.type, query.query FROM query JOIN student ON student.id=query.id where student.status='available' AND student.course='$department'";
                $res=$con->query($qry);
                if ($res->num_rows > 0) {
                    ?>
    <h1>Student Query View</h1><h3><a href="add_marks.php">Back</a></h3>
        <tbody>
            
        <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Internal</th>
                <th>Date</th>
                <th>Query</th>
                <th>Action</th>
                <th>Response</th>
            </tr>
        </thead> 
        <?php      
        while ($row = mysqli_fetch_assoc($res)) {
            echo "<tr>";
            echo "<td>".$row['id']."</td>";
            echo "<td>".$row['name']."</td>";
            echo "<td>".$row['type']."</td>";
            echo "<td>".$row['date']."</td>";
            echo "<td>".$row['query']."</td>";
            echo '<td><a href="response.php?pu='.$row['qid'].'" class="b1">View And Reply</a></td>';
            echo "<td>".$row['response']."<td>";
            echo "</tr>";
          }  
        }
        else{
            echo"<script>alert('No queries found');</script>";
            echo"<script>window.location.href='add_marks.php';</script>";
        }
            $con->close();
            ?>
        </tbody>
    </table>
</body>
</html>
