<html>

<head>
        <title>HMIS</title>
        <link rel="stylesheet" href="../style.css">

</head>

<body>
        <h1>Update Visit - Bill Details</h1>
        <?php
        include 'connector.php';

        if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $stmt = $conn->prepare("SELECT * FROM visitdetails WHERE id = ?");
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $result = $stmt->get_result();
                $visit = $result->fetch_assoc();
                $stmt->close();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $stmt = $conn->prepare("UPDATE visitdetails SET
        Patient_id = ?, Reason_for_visit = ?, Discharge_status = ?, IP_OP = ?,
        Consultation_fee = ?, Procedure_charge = ?, Equipment_charge = ?, Medicine_charge = ?,
        Room_charge = ?, Miscellaneous_charge = ?, Visit_Date = ?, Bill_Date = ?,
        Total_amount = ?, Payed_amount = ?, Payable_amount = ?
        WHERE id = ?");

                $stmt->bind_param(
                        "isssddddddsssddi",
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
                        $_POST['Payable_amount'],
                        $_POST['id']
                );

                if ($stmt->execute()) {
                        echo "Visit updated successfully!";
                } else {
                        echo "Error: " . $stmt->error;
                }

                $stmt->close();
        }
        ?>

        <form method="post">
                <input type="hidden" name="id" value="<?= htmlspecialchars($visit['id']) ?>">
                <label>Patient ID: <input type="number" name="Patient_id" readonly
                                value="<?= htmlspecialchars($visit['Patient_id']) ?>"></label><br><br>

                <label>Reason for Visit: <input type="text" name="Reason_for_visit"
                                value="<?= htmlspecialchars($visit['Reason_for_visit']) ?>"></label><br><br>

                <label>Discharge Status: <input type="text" name="Discharge_status"
                                value="<?= htmlspecialchars($visit['Discharge_status']) ?>"></label><br><br>

                <label>IP/OP: <input type="text" name="IP_OP"
                                value="<?= htmlspecialchars($visit['IP_OP']) ?>"></label><br><br>

                <label>Consultation Fee: <input type="number" step="0.01" name="Consultation_fee"
                                value="<?= htmlspecialchars($visit['Consultation_fee']) ?>"></label><br><br>

                <label>Procedure Charge: <input type="number" step="0.01" name="Procedure_charge"
                                value="<?= htmlspecialchars($visit['Procedure_charge']) ?>"></label><br><br>

                <label>Equipment Charge: <input type="number" step="0.01" name="Equipment_charge"
                                value="<?= htmlspecialchars($visit['Equipment_charge']) ?>"></label><br><br>

                <label>Medicine Charge: <input type="number" step="0.01" name="Medicine_charge"
                                value="<?= htmlspecialchars($visit['Medicine_charge']) ?>"></label><br><br>

                <label>Room Charge: <input type="number" step="0.01" name="Room_charge"
                                value="<?= htmlspecialchars($visit['Room_charge']) ?>"></label><br><br>

                <label>Miscellaneous Charge: <input type="number" step="0.01" name="Miscellaneous_charge"
                                value="<?= htmlspecialchars($visit['Miscellaneous_charge']) ?>"></label><br><br>

                <label>Visit Date: <input type="date" name="Visit_Date"
                                value="<?= htmlspecialchars($visit['Visit_Date']) ?>"></label><br><br>

                <label>Bill Date: <input type="date" name="Bill_Date"
                                value="<?= htmlspecialchars($visit['Bill_Date']) ?>"></label><br><br>

                <label>Total Amount: <input type="number" step="0.01" name="Total_amount"
                                value="<?= htmlspecialchars($visit['Total_amount']) ?>"></label><br><br>

                <label>Payed Amount: <input type="number" step="0.01" name="Payed_amount"
                                value="<?= htmlspecialchars($visit['Payed_amount']) ?>"></label><br><br>

                <label>Payable Amount: <input type="number" step="0.01" name="Payable_amount"
                                value="<?= htmlspecialchars($visit['Payable_amount']) ?>"></label><br><br>

                <button type="submit">Update</button>

        </form>

        <form action="displayBill.php" method="get">
                <input type="hidden" name="patient_id" value="<?= htmlspecialchars($visit['Patient_id']) ?>">
                <button type="submit">Visit - Bill Details</button>
        </form>

</body>

</html>