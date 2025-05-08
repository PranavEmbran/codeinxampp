<html>

<head>
    <title>HMIS</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../Style/tableSmall.css">

</head>

<body>
    <h1>Visit - Billing Details</h1>
    <?php
    include 'connector.php';
    include '../titlebar.php';

    $patient_id = $_GET['patient_id'] ?? null;

    if (!$patient_id) {
        die("No patient ID provided.");
    }

    echo "Patient ID: " . htmlspecialchars($patient_id);

    $stmt = $conn->prepare("SELECT * FROM visitdetails WHERE Patient_id = ?");
    $stmt->bind_param("i", $patient_id);

    if (!$stmt->execute()) {
        die("Query failed: " . $stmt->error);
    }

    $result = $stmt->get_result();

    // $sql = "SELECT * FROM visitdetails where Patient_id = $patient_id";
// $result = $conn->query($sql);
    ?>


    <br>
    <table border="1">
        <tr>
            <th>ID</th>
            <!-- <th>Patient_id</th> -->
            <!-- <th>Reason_for_visit</th> -->
            <th>Discharge_status</th>
            <th>IP_OP</th>
            <th>Consultation_fee</th>
            <th>Procedure_charge</th>
            <th>Equipment_charge</th>
            <th>Room_charge</th>
            <th>Lab_charge</th>
            <th>Medicine_charge</th>
            <th>Misc_charge</th>
            <th>Total_bill</th>
            <th>Payed_amount</th>
            <th>Payable_amount</th>
            <th>Visit_Date</th>
            <th>Bill_Date</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>

        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['Discharge_status'] ?></td>
                <td><?= $row['IP_OP'] ?></td>
                <td><?= $row['Consultation_fee'] ?></td>
                <td><?= $row['Procedure_charge'] ?></td>
                <td><?= $row['Equipment_charge'] ?></td>
                <td><?= $row['Room_charge'] ?></td>
                <td><?= $row['Lab_charge'] ?></td>
                <td><?= $row['Medicine_charge'] ?></td>
                <td><?= $row['Miscellaneous_charge'] ?></td>
                <td><?= $row['Total_amount'] ?></td>
                <td><?= $row['Payed_amount'] ?></td>
                <td><?= $row['Payable_amount'] ?></td>
                <td><?= $row['Visit_Date'] ?></td>
                <td><?= $row['Bill_Date'] ?></td>
                <td class="action-buttons">
                    <form action="updateBill.php" method="get" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <button type="submit">Edit</button>
                    </form>
                </td>
                <td class="action-buttons">
                    <form action="deleteBill.php" method="post" style="display:inline;"
                        onsubmit="return confirm('Are you sure?');">
                        <input type="hidden" name="delete_id" value="<?= $row['id'] ?>">
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>


        <!-- <form action="createBill.php" method="get">
        <button type="submit">Add New Visit</button>
    </form> -->

        <form action="createBill.php" method="get">
            <input type="hidden" name="patient_id" value="<?= htmlspecialchars($patient_id) ?>">
            <button type="submit">Add New Visit</button>
        </form><br><br>

        <form action="../displayPatients.php">
            <button type="submit">All Visits</button>
        </form>
    </table>



</body>

</html>