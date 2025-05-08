<?php

include 'connector.php';

// Get the 'id' from the URL using GET method
$id = $_GET['id'] ?? null; // if not set, $id will be null

// If an ID is provided in the URL
if ($id) {
    // Query to fetch the existing data for the record with this ID
    $sql = "SELECT * FROM studentdetails WHERE id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc(); // Fetch the record into an associative array
}

// If the update form is submitted
if (isset($_POST['update'])) {
    // Get updated values from the form
    $new_fname = $_POST['fname'];
    $new_lname = $_POST['lname'];
    $new_age = $_POST['age'];

    // SQL query to update the existing record in the database
    $update_sql = "UPDATE studentdetails SET firstname='$new_fname', lastname='$new_lname', age='$new_age' WHERE id=$id";

    // Execute the update query
    if ($conn->query($update_sql) === TRUE) {
        // If update successful, redirect back to main page
        header("Location: create.php"); // Change to your actual main page if it's not create.php
        exit();
    } else {
        // If update fails, show error
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!-- HTML section to show the edit form -->
<html>

<head>
    <title>Edit Record</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Edit Record</h1>
    <!-- Form to update existing record -->
    <form method="post">
        <!-- Input for First Name with value filled from database -->
        <label>First Name:</label>
        <input type="text" name="fname" value="<?php echo $row['firstname']; ?>" required><br><br>

        <!-- Input for Last Name -->
        <label>Last Name:</label>
        <input type="text" name="lname" value="<?php echo $row['lastname']; ?>" required><br><br>

        <!-- Input for Age -->
        <label>Age:</label>
        <input type="number" name="age" value="<?php echo $row['age']; ?>" required><br><br>

        <!-- Submit button to update record -->
        <input type="submit" name="update" value="Update">
    </form>
</body>

</html>