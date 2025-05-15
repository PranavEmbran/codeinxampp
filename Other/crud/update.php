<html>
<head><title>Edit Record</title></head>
<body>
    <h1>Edit Record</h1>
    <form method="post">
        <label>First Name:</label>
        <input type="text" name="fname" value="<?php echo $row['firstname']; ?>" required><br><br>

        <label>Last Name:</label>
        <input type="text" name="lname" value="<?php echo $row['lastname']; ?>" required><br><br>

        <label>Age:</label>
        <input type="number" name="age" value="<?php echo $row['age']; ?>" required><br><br>

        <input type="submit" name="update" value="Update">
    </form>
</body>

<?php
$id = $_GET['id'] ?? null; 

if ($id) {
    $sql = "SELECT * FROM studentdetails WHERE id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc(); 
}

if (isset($_POST['update'])) {
    $new_fname = $_POST['fname'];
    $new_lname = $_POST['lname'];
    $new_age = $_POST['age'];

    $update_sql = "UPDATE studentdetails SET firstname='$new_fname', lastname='$new_lname', age='$new_age' WHERE id=$id";

    if ($conn->query($update_sql) === TRUE) {
        header("Location: create.php"); 
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

</html>
