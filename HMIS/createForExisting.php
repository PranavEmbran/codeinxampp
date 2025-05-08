<?php
include 'connector.php';
include 'titlebar.php';

$patient_id = $_GET['patient_id'] ?? null;
$firstname = $lastname = $age = $phno = $gender = '';

if ($patient_id) {
    $stmt = $conn->prepare("SELECT 
        pd.firstname, pd.lastname, pd.age, pd.phoneno, pd.gender, 
        vd.Reason_for_visit, vd.Discharge_status, vd.IP_OP
    FROM 
        patientdetails pd
    LEFT JOIN 
        visitdetails vd ON vd.patient_id = pd.id
    WHERE 
        pd.id = ?");
    $stmt->bind_param("i", $patient_id);
    $stmt->execute();
    $stmt->bind_result($firstname, $lastname, $age, $phno, $gender, $reason, $discharge, $inpop);
    $stmt->fetch();
    $stmt->close();
}
?>

<html>

<head>
    <title>HMIS - Create Visit for Existing Patient</title>
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <h1>Basic Details</h1>
    <form method="post" action="">
        <input type="hidden" name="patient_id" value="<?= htmlspecialchars($patient_id) ?>">

        <label for="firstname">First Name:</label>
        <input id="firstname" type="text" name="fname" value="<?= htmlspecialchars($firstname) ?>" required
            readonly><br><br>

        <label for="lastname">Last Name:</label>
        <input id="lastname" type="text" name="lname" value="<?= htmlspecialchars($lastname) ?>" required
            readonly><br><br>

        <label for="age">Age:</label>
        <input id="age" type="number" name="age" value="<?= htmlspecialchars($age) ?>" required readonly><br><br>

        <label for="ph">Phone no:</label>
        <input id="ph" type="text" name="phno" value="<?= htmlspecialchars($phno) ?>" required readonly><br><br>

        <label for="gen">Gender:</label>
        <input id="gen" type="text" name="gender" value="<?= htmlspecialchars($gender) ?>" required readonly><br><br>

        <label for="reason">Reason for visit:</label>
        <input id="reason" type="text" name="Reason_for_visit" required><br><br>

        <label for="dstatus">Discharge status:</label>
        <select id="dstatus" name="Discharge_status" required>
            <option value="Active">Active</option>
            <option value="Discharged">Discharged</option>
        </select><br><br>

        <label for="ipop">IP/OP:</label>
        <select id="ipop" name="IP_OP" required>
            <option value="OP">OP</option>
            <option value="IP">IP</option>
        </select><br><br>

        <label for="visitdate">Visit Date:</label>
        <input id="visitdate" type="date" name="Visit_Date" required><br><br>

        <button type="submit" name="submit">Create Visit Record</button>
    </form>

    <form method="get" action="displayPatients.php">
        <button type="submit">Close Create</button>
    </form>
    <!-- *********************************************************** -->
    <?php
    if (isset($_POST['submit'])) {

        $reason = $_POST['Reason_for_visit'];
        $disstat = $_POST['Discharge_status'];
        $inpout = $_POST['IP_OP'];
        $visitDate = $_POST['Visit_Date'];
        // $billdate = $_POST['Bill_Date'];
    
        try {
            // Insert into patientdetails
            // $stmt1 = $conn->prepare("INSERT INTO patientdetails (firstname, lastname, age, phoneno, gender) VALUES (?, ?, ?, ?, ?)");
            // $stmt1->bind_param("ssiss", $fname, $lname, $age, $phone, $gender);
            // $stmt1->execute();
    
            $patient_id = $_GET['patient_id'] ?? null;

            // $patient_id = $stmt1->insert_id;
    
            // Insert into visitdetails
            $stmt2 = $conn->prepare("INSERT INTO visitdetails (Patient_id, Reason_for_visit, Discharge_status, IP_OP, Visit_Date) VALUES (?, ?, ?, ?, ?)");
            $stmt2->bind_param("issss", $patient_id, $reason, $disstat, $inpout, $visitDate);
            $stmt2->execute();

            // Redirect to self to avoid form resubmission
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    ?>
    <!-- *********************************************************** -->


</body>

</html>