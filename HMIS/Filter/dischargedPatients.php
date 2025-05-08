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
    <h1>Discharged Patient - Visit Details</h1>
    <table border="1">
        <tr>
            <th>Visit_ID</th>
            <th>Patient_ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Age</th>
            <th>Phone number</th>
            <th>Gender</th>
            <th>Reason for visit</th>
            <th>Discharge status</th>
            <th>IP/OP</th>
            <th>Visit_Date</th>

        </tr>

        <?php

        $sql = "SELECT 
    v.id AS visit_id, p.id AS patient_id, p.firstname, p.lastname, p.age, p.phoneno, p.gender, v.Reason_for_visit, v.Discharge_status, v.IP_OP,v.Visit_Date FROM patientdetails p
LEFT JOIN 
    visitdetails v ON v.Patient_id = p.id
WHERE 
    v.Discharge_status = 'Discharged'";


        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                foreach ($row as $value) {
                    echo "<td>" . htmlspecialchars($value) . "</td>";
                }
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