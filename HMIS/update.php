<!DOCTYPE html>
<html lang="en">

<head>
    <title>HMIS</title>
    <link rel="stylesheet" href="style.css">

</head>

<body>


    <?php
    include 'connector.php';
    include 'titlebar.php';

    if (!isset($_GET['id'])) {
        echo "No visit ID provided.";
        exit;
    }

    $visit_id = $_GET['id'];
    $visit = null;

    // Fetch current visit and patient details
    $stmt = $conn->prepare("SELECT v.id AS visit_id, p.id AS patient_id, p.firstname, p.lastname, p.age, p.phoneno, p.gender,
                               v.Reason_for_visit, v.Discharge_status, v.IP_OP, v.Visit_Date
                        FROM patientdetails p
                        JOIN visitdetails v ON v.Patient_id = p.id
                        WHERE v.id = ?");
    $stmt->bind_param("i", $visit_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 0) {
        echo "Visit not found.";
        exit;
    }
    $visit = $result->fetch_assoc();

    // Handle update form submission
    if (isset($_POST['update'])) {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $age = $_POST['age'];
        $phone = $_POST['phno'];
        $gender = $_POST['gender'];
        $reason = $_POST['Reason_for_visit'];
        $disstat = $_POST['Discharge_status'];
        $inpout = $_POST['IP_OP'];
        $visitDate = $_POST['Visit_Date'];
        // $billdate = $_POST['Bill_Date'];
        $pid = $_POST['patient_id'];

        try {
            // Update patientdetails
            $stmt1 = $conn->prepare("UPDATE patientdetails SET firstname=?, lastname=?, age=?, phoneno=?, gender=? WHERE id=?");
            $stmt1->bind_param("ssissi", $fname, $lname, $age, $phone, $gender, $pid);
            $stmt1->execute();

            // Update visitdetails
            $stmt2 = $conn->prepare("UPDATE visitdetails SET Reason_for_visit=?, Discharge_status=?, IP_OP=?, Visit_Date=?
         WHERE id=?");
            $stmt2->bind_param("ssssi", $reason, $disstat, $inpout, $visitDate, $visit_id);
            $stmt2->execute();

            header("Location: displayPatients.php");
            exit();
        } catch (Exception $e) {
            echo "Update failed: " . $e->getMessage();
        }
    }
    ?>




    <h1>Update Patient</h1>
    <form method="post" action="">
        <input type="hidden" name="patient_id" value="<?= htmlspecialchars($visit['patient_id']) ?>">

        First Name: <input type="text" name="fname" value="<?= htmlspecialchars($visit['firstname']) ?>"
            required><br><br>
        Last Name: <input type="text" name="lname" value="<?= htmlspecialchars($visit['lastname']) ?>" required><br><br>
        Age: <input type="number" name="age" value="<?= htmlspecialchars($visit['age']) ?>" required><br><br>
        Phone Number: <input type="text" name="phno" value="<?= htmlspecialchars($visit['phoneno']) ?>"
            required><br><br>
        Gender:
        <select name="gender">
            <option value="M" <?= $visit['gender'] == 'M' ? 'selected' : '' ?>>Male</option>
            <option value="F" <?= $visit['gender'] == 'F' ? 'selected' : '' ?>>Female</option>
            <option value="O" <?= $visit['gender'] == 'O' ? 'selected' : '' ?>>Other</option>
        </select><br><br>

        Reason for visit: <input type="text" name="Reason_for_visit"
            value="<?= htmlspecialchars($visit['Reason_for_visit']) ?>" required><br><br>
        Discharge status:
        <select name="Discharge_status">
            <option value="Active" <?= $visit['Discharge_status'] == 'Active' ? 'selected' : '' ?>>Active</option>
            <option value="Discharged" <?= $visit['Discharge_status'] == 'Discharged' ? 'selected' : '' ?>>Discharged
            </option>
        </select><br><br>

        IP/OP:
        <select name="IP_OP">
            <option value="OP" <?= $visit['IP_OP'] == 'OP' ? 'selected' : '' ?>>OP</option>
            <option value="IP" <?= $visit['IP_OP'] == 'IP' ? 'selected' : '' ?>>IP</option>
        </select><br><br>

        Visit Date: <input type="date" name="Visit_Date" value="<?= htmlspecialchars($visit['Visit_Date']) ?>"
            required><br><br>

        <input type="submit" name="update" value="Update">
    </form>

    <form action="displayPatients.php" method="get">
        <input type="hidden" name="patient_id" value="<?= htmlspecialchars($visit['Patient_id']) ?>">
        <button type="submit">All Visits</button>
    </form>

</body>

</html>