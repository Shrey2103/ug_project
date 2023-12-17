<?php
include 'student_dash_header.php';

if (isset($_SESSION['LoginStudent'])) {
    $username = $_SESSION['LoginStudent'];
} else {
    header('Location: login.php');
}

$conn = mysqli_connect("localhost", "root", "", "cms");
$qry = "SELECT * FROM student WHERE id='$username'";
$res = mysqli_query($conn, $qry);
$row = mysqli_fetch_assoc($res);

$name = $row['name'];
$course = $row['course'];
?>

<!DOCTYPE html>
<html>
<head>
  <title>Student Query Form</title>
  <link rel="stylesheet" href="css/stud_query.css">
</head>
<body>
  <div class="container">
    <h2>Student Query Form</h2>
    <form action="" method="post">
      <div class="form-group">
        <label for="student_id">Student ID:</label>
        <input type="text" id="student_id" name="student_id" value="<?php echo $username; ?>" readonly>
      </div>
      <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $name; ?>" readonly>
      </div>
      <div class="form-group">
        <label for="course">Course:</label>
        <input type="text" id="course" name="course" value="<?php echo $course; ?>" readonly>
      </div>
      <div class="form-group">
        <label for="course">Internal:</label>
        <select name="type">
          <option>1</option>
          <option>2</option>
        </select>
      </div>
      <div class="form-group">
        <label for="query">Query:</label>
        <textarea id="query" name="query" rows="5" required></textarea>
      </div>
      <div class="btn-group">
        <button type="submit" name="submit" class="btn">Submit</button>
        <button type="reset" class="btn clear">Clear</button>
      </div>
    </form>
  </div>
</body>
</html>

<?php
// Retrieve form data
if (isset($_POST['submit'])) {
    $studentId = $_POST['student_id'];
    $name = $_POST['name'];
    $course = $_POST['course'];
    $type = $_POST['type'];
    $query = $_POST['query'];
    $date = date('Y-m-d');

    // Connect to the database
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'cms';

    $conn = mysqli_connect($host, $username, $password, $dbname);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Check if student marks are present in the marks table for the selected type
    $marksQuery = "SELECT type FROM marks WHERE id='$studentId' AND type='$type'";
    $marksResult = mysqli_query($conn, $marksQuery);

    if (mysqli_num_rows($marksResult) > 0) {
        // Insert form data into the database
        $queryInsert = "INSERT INTO query (id, type, query, date) VALUES ('$studentId', '$type', '$query', '$date')";
        if (mysqli_query($conn, $queryInsert)) {
            echo "<script>alert('Query submitted successfully');</script>";
            echo "<script>window.location.href='student_dash.php';</script>";
        } else {
            echo "Error: " . $queryInsert . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "<script>alert('Internal marks not yet added');</script>";
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
