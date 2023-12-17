 <!DOCTYPE html>
<html>
<head>
  <title>Course List</title>
  <style>
    .table-container {
        width: 95%;
        margin: 0 auto;
        max-height: 600px;
        overflow-y: scroll;
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
        bottom: 20px;
        right: 20px;
        align-items: center;
        justify-content: center;
    }

    .back-button:hover {
        background-color: #3e8e41;
    }

    .a {
        float: left;
        width: 40px;
        height: 20px;
        display: flex;
        position: relative;
        align-items: center;
        border-radius: 5px;
        cursor: pointer;
        justify-content: center;
        color: white;
        text-decoration: none;
        background-color: blue;
        padding: 10px;
        bottom: 20px;
        left: 20px;
        position: fixed;
    }

    .a:hover {
        background-color: #3e8e41;
    }
    .action-buttons{

    }
    .b{
      display: inline-block;
      padding: 10px 20px;
      background-color: blue;
      color: white;
      text-decoration: none;
      text-align: center;
      cursor: pointer;
      border-radius:5px;
      width: 40px;
    }
    .c{
      display: inline-block;
      padding: 10px 20px;
      background-color: red;
      color: white;
      text-decoration: none;
      text-align: center;
      cursor: pointer;
      border-radius:5px;
    }
  </style>
</head>
<body>
  <h1>Course List</h1>

  <div class="table-container">
    <table>
      <thead class="table-heading">
        <tr>
          <th>Name</th>
          <th>Full name</th>
          <th>Fees</th>
          <th>Description</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $con = mysqli_connect("localhost", "root", "", "cms");
        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }
        
        $query = "SELECT * FROM course";
        $result = mysqli_query($con, $query);
        
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr>";
          echo "<td>".$row['cname']."</td>";
          echo "<td>".$row['full']."</td>";
          echo "<td>".$row['fees']."</td>";
          echo "<td>".$row['des']."</td>";
          echo "<td>".$row['status']."</td>";
          echo  '<td class="action-buttons">
            <a href="edit_course.php?sno='.$row['sno'].'"class="b">Edit</a>
            <a href="delete_course.php?sno='.$row['sno'].'"class="c">Delete</a>
          </td>';
          echo "</tr>";
        }
        
        mysqli_close($con);
        ?>
      </tbody>
    </table>
  </div>
  
  <a href="admin_course.html" class="a">Back</a>
</body>
</html> 








