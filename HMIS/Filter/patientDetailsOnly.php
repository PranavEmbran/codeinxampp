<?php
include '../connector.php';
include '../titlebar.php';

?>
<html>

<head>
    <title>HMIS</title>
    <link rel="stylesheet" href="../style.css">

</head>

<body>
    <h1>Patient Details</h1>
    <table border="1">
        <tr>
            <th>Patient_ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Age</th>
            <th>Phone number</th>
            <th>Gender</th>
            <th>Delete</th>

        </tr>

        <?php

        $sql = "SELECT * FROM patientdetails";


        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                foreach ($row as $value) {
                    echo "<td>" . htmlspecialchars($value) . "</td>";
                }
                //     echo "<td>
                //     <form method='post' action='../job/deletePatient.php' onsubmit=\"return confirm('Are you sure?\nAll patient - visit records will be deleted');\">
        
                //         <input type='hidden' name='delete_id' value='" . htmlspecialchars($row["id"]) . "'>
                //         <button type='submit' name='delete'>Delete Patient</button>
                //     </form>
        
                // </td>
                echo "<td>
    <form method='post' action='../job/deletePatient.php' onsubmit='return confirm(\"Are you sure?\\nAll patient - visit records will be deleted\");'>
        <input type='hidden' name='delete_id' value='" . htmlspecialchars($row["id"]) . "'>
        <button type='submit' name='delete'>Delete Patient</button>
    </form>
</td>


</tr>";
            }
        } else {
            echo "<tr><td colspan='15'>No records found</td></tr>";
        }
        ?>
    </table><br>

    <form method="get" action="../displayPatients.php">
        <button type="submit">All Visits</button>
    </form>

</body>

</html>