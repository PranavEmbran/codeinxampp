<?php
session_start();
include 'connector.php';
?>

<!DOCTYPE html>
<html>

<head>
    <title>HMIS Login</title>
    <link rel="stylesheet" href="Style/loginStyle.css">
    <link rel="stylesheet" href="style.css">


</head>

<body>
    <h1 id="loginh1">HMIS Login</h1>
    <form id = "loginform" method="post" action="">
        <label for="userid">Enter User Name:</label>
        <input type="text" id="userid" name="uid" required><br><br>
        <label for="passwd">Enter Password:</label>
        <input type="password" id="passwd" name="pwd" required><br><br>
        <input type="submit" name="Login" value="Login">
    </form>

    <?php
    if (isset($_GET['Logout']) || isset($_POST['Logout'])) {
        session_unset();
        session_destroy();
        header("Location: login.php");
        exit();
    }


    if (isset($_POST['Login'])) {
        $userid = $_POST['uid'];
        $password = $_POST['pwd'];

        // Prepared statement to fetch password hash
        $stmt = $conn->prepare("SELECT Password FROM login WHERE Userid = ?");
        $stmt->bind_param("s", $userid);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 1) {
            $stmt->bind_result($db_password);
            $stmt->fetch();

            // Compare hashed password (or plain text fallback if needed)
            if (password_verify($password, $db_password) || $password === $db_password) {
                $_SESSION['user'] = $userid;
                header("Location: displayPatients.php");
                exit();
            } else {
                echo "<p style='color:red;'>Invalid password.</p>";
            }
        } else {
            echo "<p style='color:red;'>User not found.</p>";
        }

        $stmt->close();
    }

    ?>
</body>

</html>