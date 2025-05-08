<!-- HTML to display data in a table -->
<html>

<head>
    <title>CRUD Operations</title>
    <link rel="stylesheet" href="style.css">

<body>
    <h1>Data Table</h1>
    <table border="1">
        <tr>
            <!-- Table headings -->
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Age</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php

        // SQL query to read all data from the table
        $sql_read = "SELECT * FROM studentdetails";
        // Execute the read query
        $result = $conn->query($sql_read);

        // Check if there are any rows returned from the read query
        if ($result->num_rows > 0) {
            // Loop through each row in the result
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                // Output each column in its own cell
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["firstname"] . "</td>";
                echo "<td>" . $row["lastname"] . "</td>";
                echo "<td>" . $row["age"] . "</td>";

                // Create a form with a hidden ID field to handle deletion
                echo "<td>
                    <form method='post' action=''>
                        <input type='hidden' name='delete_id' value='" . $row["id"] . "'>
                        <button name = 'delete'>Delete</button>
                    </form>
                </td>";

                // Create a form with a hidden ID field to handle update
                echo "<td>
                        <form method='get' action='update.php'>
                            <input type='hidden' name='id' value='" . $row["id"] . "'>
                            <button type='submit'>Update</button>
                        </form>
                    </td>";

                echo "</tr>";
            }
        } else {
            // If no rows are found, display this message
            echo "<tr><td colspan='5'>No records found</td></tr>";
        }
        ?>