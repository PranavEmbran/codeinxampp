<?php
session_start();
if ($_SESSION['user'] == '') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="style.css"> -->

</head>

<body>
    <div id="user-panel">
        <div id="Session_user">
            <h3>
                <?php
                // echo $_SESSION['user'];
                if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
                    // echo htmlspecialchars($_SESSION['user']);
                    echo $_SESSION['user'];
                } else {
                    echo "User Not Logged in";
                }
                ?>
            </h3>

        </div>
        <form id="logout" action="login.php">
            <input type="submit" name="Logout" value="Logout">
        </form>
    </div>
    <style>
        #user-panel {
            position: absolute;
            top: 10px;
            right: 10px;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 0.5em;
        }

        #Session_user {
            background-color: #3498db;
            color: white;
            padding: 0.5em 1em;
            border-radius: 8px;
            font-size: 0.9em;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        #Session_user h3 {
            margin: 0;
            font-size: 1em;
            font-weight: normal;
        }

        #logout {
            padding: 0px;
            margin-top: 1px;
        }

        #logout input[type="submit"] {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 0.5em 1em;
            border-radius: 8px;
            font-size: 0.9em;
            cursor: pointer;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            transition: background-color 0.2s ease;
        }

        #logout input[type="submit"]:hover {
            background-color: #c0392b;
        }
    </style>

</body>

</html>