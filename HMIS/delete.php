<?php
include 'connector.php';

if (isset($_POST['delete'])) {
    $delete_id = $_POST['delete_id'];

    try {
        // Start transaction
        $conn->begin_transaction();

        // Delete associated visitdetails
        $stmt_visits = $conn->prepare("DELETE FROM visitdetails WHERE id = ?");
        $stmt_visits->bind_param("i", $delete_id);
        $stmt_visits->execute();

        // Delete from patientdetails
        // $stmt_patient = $conn->prepare("DELETE FROM patientdetails WHERE id = ?");
        // $stmt_patient->bind_param("i", $delete_id);
        // $stmt_patient->execute();

        $conn->commit();

        // Redirect after deletion
        header("Location: displayPatients.php");
        exit();
    } catch (Exception $e) {
        $conn->rollback();
        echo "Error during deletion: " . $e->getMessage();
    }
}
?>