<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "schools";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submissions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_student'])) {
        $name = $_POST['name'];
        $age = $_POST['age'];
        $class = $_POST['class'];
        
        $sql = "INSERT INTO students (name, age, class) VALUES ('$name', $age, '$class')";
        if ($conn->query($sql) === TRUE) {
            echo "New student record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif (isset($_POST['edit_student'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $age = $_POST['age'];
        $class = $_POST['class'];
        
        $sql = "UPDATE students SET name='$name', age=$age, class='$class' WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            echo "Student record updated successfully";
        } else {
            echo "Error updating student record: " . $conn->error;
        }
    } elseif (isset($_POST['delete_student'])) {
        $id = $_POST['id'];
        
        $sql = "DELETE FROM students WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            echo "Student record deleted successfully";
        } else {
            echo "Error deleting student record: " . $conn->error;
        }
    } elseif (isset($_POST['add_staff'])) {
        $name = $_POST['name'];
        $position = $_POST['position'];
        $department = $_POST['department'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        
        $sql = "INSERT INTO staff (name, position, department, email, phone) VALUES ('$name', '$position', '$department', '$email', '$phone')";
        if ($conn->query($sql) === TRUE) {
            echo "New staff record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif (isset($_POST['edit_staff'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $position = $_POST['position'];
        $department = $_POST['department'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        
        $sql = "UPDATE staff SET name='$name', position='$position', department='$department', email='$email', phone='$phone' WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            echo "Staff record updated successfully";
        } else {
            echo "Error updating staff record: " . $conn->error;
        }
    } elseif (isset($_POST['delete_staff'])) {
        $id = $_POST['id'];
        
        $sql = "DELETE FROM staff WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            echo "Staff record deleted successfully";
        } else {
            echo "Error deleting staff record: " . $conn->error;
        }
    } elseif (isset($_POST['add_course'])) {
        $name = $_POST['name'];
        $code = $_POST['code'];
        $description = $_POST['description'];
        $instructor = $_POST['instructor'];
        $credits = $_POST['credits'];
        
        $sql = "INSERT INTO courses (name, code, description, instructor, credits) VALUES ('$name', '$code', '$description', '$instructor', $credits)";
        if ($conn->query($sql) === TRUE) {
            echo "New course record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif (isset($_POST['edit_course'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $code = $_POST['code'];
        $description = $_POST['description'];
        $instructor = $_POST['instructor'];
        $credits = $_POST['credits'];
        
        $sql = "UPDATE courses SET name='$name', code='$code', description='$description', instructor='$instructor', credits=$credits WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            echo "Course record updated successfully";
        } else {
            echo "Error updating course record: " . $conn->error;
        }
    } elseif (isset($_POST['delete_course'])) {
        $id = $_POST['id'];
        
        $sql = "DELETE FROM courses WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            echo "Course record deleted successfully";
        } else {
            echo "Error deleting course record: " . $conn->error;
        }
    } elseif (isset($_POST['add_contact'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];
        
        $sql = "INSERT INTO contact_us (name, email, message) VALUES ('$name', '$email', '$message')";
        if ($conn->query($sql) === TRUE) {
            echo "New contact message submitted successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Retrieve and display data (example for students)
$result_students = $conn->query("SELECT * FROM students");
$result_staff = $conn->query("SELECT * FROM staff");
$result_courses = $conn->query("SELECT * FROM courses");
//$result_contact = $conn->query("SELECT * FROM contactus");

?>

<!DOCTYPE html>
<html>
<head>
    <title>School Management</title>
</head>
<body>
    <h1>Students</h1>
    <form method="post">
        <input type="text" name="name" placeholder="Name" required>
        <input type="number" name="age" placeholder="Age" required>
        <input type="text" name="class" placeholder="Class" required>
        <button type="submit" name="add_student">Add Student</button>
    </form>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Age</th>
            <th>Class</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result_students->fetch_assoc()): ?>
        <tr>
            <form method="post">
                <td><?php echo $row['id']; ?></td>
                <td><input type="text" name="name" value="<?php echo $row['name']; ?>" required></td>
                <td><input type="number" name="age" value="<?php echo $row['age']; ?>" required></td>
                <td><input type="text" name="class" value="<?php echo $row['class']; ?>" required></td>
                <td>
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <button type="submit" name="edit_student">Edit</button>
                    <button type="submit" name="delete_student">Delete</button>
                </td>
            </form>
        </tr>
        <?php endwhile; ?>
    </table>

    <h1>Staff</h1>
    <form method="post">
        <input type="text" name="name" placeholder="Name" required>
        <input type="text" name="position" placeholder="Position" required>
        <input type="text" name="department" placeholder="Department" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="phone" placeholder="Phone" required>
        <button type="submit" name="add_staff">Add Staff</button>
    </form>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Position</th>
            <th>Department</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result_staff->fetch_assoc()): ?>
        <tr>
            <form method="post">
                <td><?php echo $row['id']; ?></td>
                <td><input type="text" name="name" value="<?php echo $row['name']; ?>" required></td>
                <td><input type="text" name="position" value="<?php echo $row['position']; ?>" required></td>
                <td><input type="text" name="department" value="<?php echo $row['department']; ?>" required></td>
                <td><input type="email" name="email" value="<?php echo $row['email']; ?>" required></td>
                <td><input type="text" name="phone" value="<?php echo $row['phone']; ?>" required></td>
                <td>
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <button type="submit" name="edit_staff">Edit</button>
                    <button type="submit" name="delete_staff">Delete</button>
                </td>
            </form>
        </tr>
        <?php endwhile; ?>
    </table>

    <h1>Courses</h1>
    <form method="post">
        <input type="text" name="name" placeholder="Name" required>
        <input type="text" name="code" placeholder="Code" required>
        <textarea name="description" placeholder="Description" required></textarea>
        <input type="text" name="instructor" placeholder="Instructor" required>
        <input type="number" name="credits" placeholder="Credits" required>
        <button type="submit" name="add_course">Add Course</button>
    </form>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Code</th>
            <th>Description</th>
            <th>Instructor</th>
            <th>Credits</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result_courses->fetch_assoc()): ?>
        <tr>
            <form method="post">
                <td><?php echo $row['id']; ?></td>
                <td><input type="text" name="name" value="<?php echo $row['name']; ?>" required></td>
                <td><input type="text" name="code" value="<?php echo $row['code']; ?>" required></td>
                <td><textarea name="description" required><?php echo $row['description']; ?></textarea></td>
                <td><input type="text" name="instructor" value="<?php echo $row['instructor']; ?>" required></td>
                <td><input type="number" name="credits" value="<?php echo $row['credits']; ?>" required></td>
                <td>
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <button type="submit" name="edit_course">Edit</button>
                    <button type="submit" name="delete_course">Delete</button>
                </td>
            </form>
        </tr>
        <?php endwhile; ?>
    </table>

    <h1>Contact Us Messages</h1>
    <form method="post">
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <textarea name="message" placeholder="Message" required></textarea>
        <button type="submit" name="add_contact">Submit Message</button>
    </form>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Message</th>
            <th>Submission Date</th>
        </tr>
      
    </table>
</body>
</html>

<?php
$conn->close();
?>
