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
$pass=0;
    if (isset($_POST['Login'])) { 

        $username = $_POST['uname'];
        $password = $_POST['pwd'];
        $sql = "SELECT * FROM login;";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    if($username === $row["Username"] && $password === $row["Password"]){
                        $pass = 1;
                    }
                }
            }
        }
        
            if($pass === 1){

                header("Location: create.php");
                exit();
            }
    ?>
    
</body>
</html>