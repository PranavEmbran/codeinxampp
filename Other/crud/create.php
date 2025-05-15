<?php
// include 'connector.php' ;
include 'delete.php' ;
include 'display.php' ;
?>
<html>
<head>
    <title>CRUD Operations</title>
    <body>
        <h1>Basic Details</h1>
        <form method="post" action="">
            <label for="firstname">First Name:</label>
            <input id="firstname" type="text" name="fname" required><br><br>
            <label for="lastname">Last Name:</label>
            <input id="lastname" type="text" name="lname" required><br><br>
            <label for="age">Age:</label>
            <input id="age" type="age" name="age" required><br><br>
            <input type="submit" name="submit" value="Create">
        </form>
    </body>
</html>

<?php
if (isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $age = $_POST['age'];
    $sql = "INSERT INTO studentdetails (firstname, lastname, age) VALUES ('$fname', '$lname', '$age')";
    if ($conn->query($sql) === TRUE) {
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>


    </table>
</body> 
</html>
