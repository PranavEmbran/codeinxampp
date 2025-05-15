<?php
include  'connector.php';
?>
<!DOCTYPE html>

<html>
<head>
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form method="post" action="">
        <label for="username">Enter User Name:</label>
        <input type="text" id="username" name="uname" required><br><br>
        <label for="passwd">Enter Password:</label>
        <input type="text" id="passwd" name="pwd" required><br><br>
        <input type="submit" name="Login" value="Login">
    </form>

    <?php

// Check if the form is submitted
    if (isset($_POST['Login'])) {
        
        // Get values from the form inputs
        $username = $_POST['uname'];
        $password = $_POST['pwd'];
        // SQL query to  the database
        $sql = "SELECT * FROM LOGIN;";

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

    
    // SQL query to read all data from the table
    $sql_read = "SELECT * FROM login";
    // Execute the read query
    $result = $conn->query($sql_read);
    
   

    $pass=0;

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if($username === $row["Username"] && $password === $row["Password"]){
                $pass = 1;
                echo $pass;
            }
        }
    }

    if($pass ===1){
        header("Location: create.php");
        exit();
    }
    
    ?>
    
    
</body>
</html>