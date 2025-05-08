<?php
include 'connector.php';
include 'titlebar.php';
include 'displaySetting.php';
?>
<html>

<head>
    <title>HMIS</title>
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <h1>All Patient Visits</h1>
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
            <!-- <th>Bill_Date</th> -->
            <th>Delete</th>
            <th>Update</th>
            <th>Billing</th>
        </tr>

        <?php

        $sql = "SELECT v.id AS visit_id, p.id AS patient_id, p.firstname, p.lastname, p.age, p.phoneno, p.gender,v.Reason_for_visit, v.Discharge_status, v.IP_OP, v.Visit_Date
FROM 
    patientdetails p
INNER JOIN 
    visitdetails v ON v.Patient_id = p.id
ORDER BY 
    v.Visit_Date DESC";
/******************************* */
        // $sql = "SELECT v.id AS visit_id, p.id AS patient_id, p.firstname, p.lastname, p.age, p.phoneno, p.gender,
        //                v.Reason_for_visit, v.Discharge_status, v.IP_OP, v.Visit_Date
        //                -- , v.Bill_Date
        //         FROM patientdetails p
        //         LEFT JOIN visitdetails v ON v.Patient_id = p.id
        //         ORDER BY 
        //         v.Visit_Date DESC
        //         ";
/******************************* */

        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                foreach ($row as $value) {
                    echo "<td>" . htmlspecialchars($value) . "</td>";
                }



                echo "<td>
                        <form method='post' action='delete.php' onsubmit=\"return confirm('Are you sure?');\">
                            <input type='hidden' name='delete_id' value='" . htmlspecialchars($row["visit_id"]) . "'>
                            <button type='submit' name='delete'>Delete Visit</button>
                        </form>
                    </td>";

/******************************* */
                // $visitId = $row["visit_id"] ?? null;
                // $pid = $row["patient_id"];
                // $hasVisitId = !empty($visitId);
                
                // $actionUrl = $hasVisitId 
                //     ? "update.php?id=" . urlencode($visitId) 
                //     : "createForExisting.php?id=" . urlencode($pid);
                
                // echo "<td>
                //         <form method='get' action='$actionUrl'>";
                
                // if ($hasVisitId) {
                //     echo "<input type='hidden' name='id' value='" . htmlspecialchars($visitId) . "'>";
                // }
                
                // echo "  <button type='submit'>Update</button>
                //         </form>
                //       </td>";
/******************************* */
                echo "<td>
                        <form method='get' action='update.php'>
                            <input type='hidden' name='id' value='" . htmlspecialchars($row["visit_id"]) . "'>
                            <button type='submit'>Update</button>
                        </form>
                      </td>";

                echo "<td>
                        <form method='get' action='Billing/displayBill.php'>
                            <input type='hidden' name='patient_id' value='" . htmlspecialchars($row["patient_id"]) . "'>
                            <button type='submit'>Billing</button>
                        </form>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='15'>No records found</td></tr>";
        }
        ?>
    </table><br>

    <form method='get' action='create.php'>
        <label for="newPatient">Create new patient-visit record</label>
        <button id="newPatient" type='submit'>Create</button>
    </form>


    <!-- <form method='get' action='createForExisting.php'>
        <label for="existingPatient">Create visit record for existing patient</label>
        <button id="existingPatient" type='submit'>Create</button>
    </form> -->
    <?php
    // Fetch patients from DB
    $sql = "SELECT id, firstname, lastname FROM patientdetails ORDER BY firstname ASC";
    $result = $conn->query($sql);
    ?>

    <form method="get" action="createForExisting.php">
        <label for="patient_id">Create new visit for existing patient:<br>Select Patient:</label>
        <select name="patient_id" id="patient_id" required>
            <option value="" disabled selected>-- Choose Patient --</option>
            <?php
            while ($row = $result->fetch_assoc()) {
                echo "<option value='{$row['id']}'>{$row['firstname']} {$row['lastname']} (ID: {$row['id']})</option>";
            }
            ?>
        </select>
        <button type="submit">Create Visit</button>
    </form>




</body>

</html>