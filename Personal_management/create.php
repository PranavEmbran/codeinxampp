<?php
include 'connector.php' ;
include 'delete.php' ;
include 'display.php' ;
?>
<!-- Start of HTML form for data input -->
<html>
<head>
    <title>CRUD Operations</title>
    <body>
        <h1>Basic Details</h1>
        <!-- Form to create a new record -->
        <form method="post" action="">
            <!-- Input for first name -->
            <label for="firstname">First Name:</label>
            <input id="firstname" type="text" name="fname" style="width: 20%;" required><br><br>
            <!-- Input for last name -->
            <label for="lastname">Last Name:</label>
            <input id="lastname" type="text" name="lname" style="width: 20%;" required><br><br>
            <!-- Input for age -->
            <label for="age">Age:</label>
            <input id="age" type="age" name="age" style="width: 20%;" required><br><br>
            <!-- Submit button to create a new entry -->
            <input type="submit" name="submit" value="Create">
        </form>
    </body>
</html>

<?php
// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Get values from the form inputs
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $age = $_POST['age'];

    // SQL query to insert form data into the database
    $sql = "INSERT INTO studentdetails (firstname, lastname, age) VALUES ('$fname', '$lname', '$age')";

    // Execute the query and check if it's successful
    if ($conn->query($sql) === TRUE) {
        // If successful, redirect to the same page to avoid form resubmission
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        // If there is an error, show it
        echo "Error: " . $conn->error;
    }
}
?>


    </table>
</body> 
</html>
