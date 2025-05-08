<html>

<head>
    <title>HMIS</title>
    <link rel="stylesheet" href="../style.css">

</head>

<body>


    <?php
    include 'connector.php';
    include '../titlebar.php';

    $patient_id = $_GET['patient_id'] ?? null;


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $stmt = $conn->prepare("INSERT INTO visitdetails (
        Patient_id, Reason_for_visit, Discharge_status, IP_OP,
        Consultation_fee, Procedure_charge, Equipment_charge, Medicine_charge,
        Room_charge, Miscellaneous_charge, Visit_Date, Bill_Date,
        Total_amount, Payed_amount, Payable_amount
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->bind_param(
            "isssddddddsssdd",
            $_POST['Patient_id'],
            $_POST['Reason_for_visit'],
            $_POST['Discharge_status'],
            $_POST['IP_OP'],
            $_POST['Consultation_fee'],
            $_POST['Procedure_charge'],
            $_POST['Equipment_charge'],
            $_POST['Medicine_charge'],
            $_POST['Room_charge'],
            $_POST['Miscellaneous_charge'],
            $_POST['Visit_Date'],
            $_POST['Bill_Date'],
            $_POST['Total_amount'],
            $_POST['Payed_amount'],
            $_POST['Payable_amount']
        );

        if ($stmt->execute()) {
            echo "Visit created successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }
    ?>

    <form method="post">
        <label>Patient ID: <input type="number" name="Patient_id" required readonly
                value="<?= htmlspecialchars($patient_id) ?>"></label><br><br>

        <label>Reason for Visit: <input type="text" name="Reason_for_visit" required></label><br><br>

        <!-- <label>Discharge Status: <input type="text" name="Discharge_status" required></label><br><br> -->
        <label for="dstatus">Discharge status:</label>
        <select id="dstatus" name="Discharge_status" required>
            <option value="Active">Active</option>
            <option value="Discharged">Discharged</option>
        </select><br><br>

        <!-- <label>IP/OP: <input type="text" name="IP_OP" required></label><br><br> -->
        <label for="ipop">IP/OP:</label>
        <select id="ipop" name="IP_OP" required>
            <option value="IP">IP</option>
            <option value="OP">OP</option>
        </select><br><br>

        <label>Consultation Fee: <input type="number" step="0.01" name="Consultation_fee"></label><br><br>
        <label>Procedure Charge: <input type="number" step="0.01" name="Procedure_charge"></label><br><br>
        <label>Equipment Charge: <input type="number" step="0.01" name="Equipment_charge"></label><br><br>
        <label>Medicine Charge: <input type="number" step="0.01" name="Medicine_charge"></label><br><br>
        <label>Room Charge: <input type="number" step="0.01" name="Room_charge"></label><br><br>
        <label>Miscellaneous Charge: <input type="number" step="0.01" name="Miscellaneous_charge"></label><br><br>
        <label>Visit Date: <input type="date" name="Visit_Date" required></label><br><br>
        <label>Bill Date: <input type="date" name="Bill_Date"></label><br><br>
        <label>Total Amount: <input type="number" step="0.01" name="Total_amount"></label><br><br>
        <label>Payed Amount: <input type="number" step="0.01" name="Payed_amount"></label><br><br>
        <label>Payable Amount: <input type="number" step="0.01" name="Payable_amount"></label><br><br>
        <button type="submit">Create Bill</button>
    </form>

    <form action="displayBill.php" method="get">
        <input type="hidden" name="patient_id" value="<?= htmlspecialchars($patient_id) ?>">
        <button type="submit">Visit - Bill Details</button>
    </form>

</body>

</html>