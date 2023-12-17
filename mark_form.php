<?php
session_start();
?>
<?php


$con = mysqli_connect("localhost", "root", "", "cms");
if (!$con) {
    die(mysqli_error());
}

$res = ""; // Initialize the $res variable

// Check if the department session variable is set
if (isset($_SESSION['department'])) {
    // Access the department value
    $department = $_SESSION['department'];
    $qry = "SELECT * FROM student WHERE course='$department' AND status='available'";
    $res = $con->query($qry);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Marks</title>
    <style>
        .button {
  display: inline-block;
  padding: 8px 16px;
  background-color: lightblue;
  color: white;
  border: none;
  border-radius: 4px;
  text-align: center;
  text-decoration: none;
  font-size: 14px;
  cursor: pointer;
}
.button {
  display: inline-block;
  padding: 8px 16px;
  background-color: lighred;
  color: white;
  border: none;
  border-radius: 4px;
  text-align: center;
  text-decoration: none;
  font-size: 14px;
  cursor: pointer;
}

.button:hover {
  background-color: blue;
}

.button:hover {
  cursor: hand;
}

        .hide {
            display: none;
        }
        .popup {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #f9f9f9;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }
        .popup input[type="text"],
        .popup input[type="number"] {
            margin-bottom: 10px;
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .popup button {
            margin-top: 10px;
        }
        table,th,td{
            border:1px solid black;
        }
        table {
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        border: 1px solid black;
        padding: 8px;
        text-align: center;
    }

    th {
        background-color: #f2f2f2;
    }
        
    </style>
    
    <script>
    function showAddMarksForm() {
        document.getElementById('marksForm').classList.remove('hide');
    }

    function hideAddMarksForm() {
        document.getElementById('marksForm').classList.add('hide');
    }

    function showMarkForm(studentId, type, studentName, studentCourse) {
        document.getElementById('studentId').value = studentId;
        document.getElementById('type').value = type;
        document.getElementById('studentName').value = studentName;
        document.getElementById('studentCourse').value = studentCourse;
        document.getElementById('popupContainer').classList.remove('hide');
    }

    function hideMarkForm() {
        document.getElementById('popupContainer').classList.add('hide');
    }

    function calculateTotalAndAverage() {
        var subject1 = parseInt(document.getElementById('subject1').value) || 0;
        var subject2 = parseInt(document.getElementById('subject2').value) || 0;
        var subject3 = parseInt(document.getElementById('subject3').value) || 0;
        var subject4 = parseInt(document.getElementById('subject4').value) || 0;
        var subject5 = parseInt(document.getElementById('subject5').value) || 0;
        var subject6 = parseInt(document.getElementById('subject6').value) || 0;

        var total = subject1 + subject2 + subject3 + subject4 + subject5 + subject6;
        var average = total / 6;
        var grade = '';

        if (
            subject1 >= 35 &&
            subject2 >= 35 &&
            subject3 >= 35 &&
            subject4 >= 35 &&
            subject5 >= 35 &&
            subject6 >= 35
        ) {
            if (average >= 75) {
                grade = 'distinction';
            } else if (average >= 65) {
                grade = 'first class';
            } else if (average >= 55) {
                grade = 'second class';
            } else if (average >= 35) {
                grade = 'pass class';
            } else {
                grade = 'fail';
            }
        } else {
            grade = 'fail';
        }

        document.getElementById('total').value = total;
        document.getElementById('average').value = average.toFixed(2);
        document.getElementById('passing_class').value = grade;
    }
</script>

	
</head>
<body>


<div id="marksForm">
            <h2><?php echo $department; ?> Marks Form<center><button class='button-b' onclick="window.location.href='add_marks.php'">BACK</button></center></h2>
            
            <table>
                <tr>
                    <th>Student ID</th>
                    <th colspan=2>Action</th>
                </tr>
                <?php
// Retrieve student data from the database and populate the table rows dynamically
while ($row = mysqli_fetch_assoc($res)) {
    $name = $row['name'];
    $course = $row['course'];
    $studentId = $row['id'];

    // Check if internal 1 marks are added for the student
    $qry = "SELECT * FROM marks WHERE id='$studentId' AND type=1";
    $res_marks = $con->query($qry);

    echo "<tr>";
    echo "<td>" . $studentId . "</td>";

    if ($res_marks->num_rows > 0) {
        // Internal 1 marks exist, show button for internal 2 marks
        echo "<td><button class='button' onclick=\"showMarkForm('" . $studentId . "', 1, '$name', '$course')\">1 internal</button></td>";
        echo "<td><button class='button' onclick=\"showMarkForm('" . $studentId . "', 2, '$name', '$course')\">2 internal</button></td>";
    } else {
        // Internal 1 marks are missing, show warning for internal 2 marks
        echo "<td><button class='button' onclick=\"showMarkForm('" . $studentId . "', 1, '$name', '$course')\">1 internal</button></td>";
        echo "<td><button class='button' onclick=\"alert('Add internal 1 marks first!')\" disabled>2 internal</button></td>";
    }

    echo "</tr>";
}
?>

            </table>
        </div>
        <div id="popupContainer" class="hide">
            <div class="popup">
                <h2>Add Marks</h2>
                <form id="popupForm" method="POST" action="process_marks.php">
                    <input type="hidden" name="id" id="studentId" value="<?php echo $id; ?>" readonly>
                    <input type="text" name="name" id="studentName" value="<?php echo $name; ?>" readonly>
                    <input type="hidden" name="course" id="studentCourse" value="<?php echo $course; ?>" readonly>

                    <input type="text" name="type" id="type" readonly>

                    <!-- inly +ve value for subject write code -->
                    <input type="number" name="subject1" id="subject1" min=0 max=100 placeholder="Subject 1" oninput="calculateTotalAndAverage()">
                    <input type="number" name="subject2" id="subject2" min=0 max=100  placeholder="Subject 2" oninput="calculateTotalAndAverage()" required>
                    <input type="number" name="subject3" id="subject3"  min=0 max=100 placeholder="Subject 3" oninput="calculateTotalAndAverage()"required>
                    <input type="number" name="subject4" id="subject4"  min=0 max=100 placeholder="Subject 4" oninput="calculateTotalAndAverage()"required>
                    <input type="number" name="subject5" id="subject5" min=0 max=100  placeholder="Subject 5" oninput="calculateTotalAndAverage()"required>
                    <input type="number" name="subject6" id="subject6" min=0 max=100  placeholder="Subject 6" oninput="calculateTotalAndAverage()"required>
                    <input type="number" name="total" id="total" placeholder="Total" readonly>
                    <input type="number" name="average" id="average" placeholder="Average" readonly>
                    <input type="text" name="grade" id="passing_class" placeholder="Passing Class" readonly>
                    <button type="submit" name="submit">Add Marks</button>
                    <button type="button" onclick="hideMarkForm()">Cancel</button>
                </form>
            </div>
        </div>
       
</body>
