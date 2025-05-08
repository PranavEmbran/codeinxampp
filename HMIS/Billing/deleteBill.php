<?php
include 'connector.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['delete_id'];

    // $stmt = $conn->prepare("DELETE FROM visitdetails WHERE id = ?");

    // $stmt = $conn->prepare("DELETE FROM visitdetails (
    //     Consultation_fee, Procedure_charge, Equipment_charge, Medicine_charge,
    //     Room_charge, Miscellaneous_charge, Bill_Date,
    //     Total_amount, Payed_amount, Payable_amount
    // ) WHERE id = ?");

$stmt = $conn->prepare("UPDATE visitdetails
SET 
    Consultation_fee = NULL,
    Procedure_charge = NULL,
    Equipment_charge = NULL,
    Medicine_charge = NULL,
    Room_charge = NULL,
    Lab_charge = NULL,
    Miscellaneous_charge = NULL,
    Bill_Date = NULL,
    Total_amount = NULL,
    Payed_amount = NULL,
    Payable_amount = NULL
WHERE id = ?;");
    

    $stmt->bind_param("i", $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Visit deleted successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // $stmt->close();
    // $conn->close();
}


$sql = "SELECT Patient_id FROM visitdetails WHERE id = $id";
$result = $conn->query($sql);
$pidRow = $result->fetch_assoc();

if ($pidRow) {
    $patient_id = $pidRow['Patient_id'];
    header("Location: displayBill.php?patient_id=" . urlencode($patient_id));
    exit();
} else {
    echo "No patient found for visit ID: $id";
}

$stmt->close();
$conn->close();

// $sql="SELECT Patient_id FROM visitdetails where id = $id";
// $result = $conn->query($sql);
// $pid=$result->fetch_assoc();

// header("Location: displayBill.php?patient_id=" . urlencode($pid) );
// // header("Location: displayBill.php" . urlencode($visit['delete_id']) );
// exit();
?>