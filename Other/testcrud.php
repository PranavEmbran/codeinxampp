<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hodointern";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>

<html>
<head>
    <title>CRUD Operations</title>
<body>
    <h1>Basic Details</h1>
    <form method="post" action="">
        <label for="name">First Name:</label>
        <input type="text" name="fname" required><br><br>
        <label for="name">Last Name:</label>
        <input type="text" name="lname" required><br><br>
        <label for="age">Age:</label>
        <input type="age" name="age" required><br><br>
        <input type="submit" name="submit" value="Create">
    </form>
</body>
</html>

<?php
if (isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $age = $_POST['age'];

    $sql = "INSERT INTO crudoperation (firstname, lastname, age) VALUES ('$fname', '$lname', '$age')";
    // $conn->query($sql);
    if ($conn->query($sql) === TRUE) {
        //Redirect to the same page to prevent resubmission
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<?php
$sql_read = "SELECT * FROM crudoperation";
$result = $conn->query($sql_read);
?>

<?php
if (isset($_POST['delete'])) {
    $delete_id = $_POST['delete_id'];

    $sql_delete = "DELETE FROM crudoperation WHERE id='$delete_id'";
    $conn->query($sql_delete);
}
?>

<html>
<head>
    <title>CRUD Operations</title>
<body>
    <h1>Data Table</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Age</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["firstname"] . "</td>";
                echo "<td>" . $row["lastname"] . "</td>";
                echo "<td>" . $row["age"] . "</td>";
                echo "<td>
                    <form method='post' action=''>
                        <input type='hidden' name='delete_id' value='" . $row["id"] . "'>
                        <button name = 'delete'>Delete</button>
                    </form>
                </td>";
                echo "<td><button>Update</button></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No records found</td></tr>";
        }
        ?>
    </table>
</body> 
</html>