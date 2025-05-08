<?php
include 'connector.php';
include 'titlebar.php';

?>

<html>

<head>
    <title>HMIS - Create Patient</title>
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <h1>Basic Details</h1>
    <form method="post" action="">
        <label for="firstname">First Name:</label>
        <input id="firstname" type="text" name="fname" required><br><br>

        <label for="lastname">Last Name:</label>
        <input id="lastname" type="text" name="lname" required><br><br>

        <label for="age">Age:</label>
        <input id="age" type="number" name="age" required><br><br>

        <label for="ph">Phone no:</label>
        <input id="ph" type="text" name="phno" required><br><br>

        <label for="gen">Gender:</label>
        <select id="gen" name="gender" required>
            <option value="F">Female</option>
            <option value="M">Male</option>
            <option value="O">Other</option>
        </select><br><br>

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

        <!-- <label for="billdate">Bill Date:</label>
        <input id="billdate" type="date" name="Bill_Date" required><br><br> -->

        <input type="submit" name="submit" value="Create">
    </form>

    <form method="get" action="displayPatients.php">
        <button type="submit">Close Create</button>
    </form>
</body>

</html>

<?php
if (isset($_POST['submit'])) {
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

    try {
        // Insert into patientdetails
        $stmt1 = $conn->prepare("INSERT INTO patientdetails (firstname, lastname, age, phoneno, gender) VALUES (?, ?, ?, ?, ?)");
        $stmt1->bind_param("ssiss", $fname, $lname, $age, $phone, $gender);
        $stmt1->execute();

        $patient_id = $stmt1->insert_id;

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