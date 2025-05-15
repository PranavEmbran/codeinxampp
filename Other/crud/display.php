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
        
        $sql_read = "SELECT * FROM studentdetails";
        $result = $conn->query($sql_read);
    
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
                
                echo "<td>
                        <form method='get' action='update.php'>
                            <input type='hidden' name='id' value='" . $row["id"] . "'>
                            <button type='submit'>Update</button>
                        </form>
                    </td>";

                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No records found</td></tr>";
        }
        ?>