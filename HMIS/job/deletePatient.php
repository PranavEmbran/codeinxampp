<?php
include '../connector.php';

if (isset($_POST['delete'])) {
    $delete_id = $_POST['delete_id'];

    $check = 0;

    try {
        // Start transaction
        $conn->begin_transaction();

        // Delete associated visitdetails
        $stmt_visits = $conn->prepare("DELETE FROM visitdetails WHERE Patient_id = ?");
        $stmt_visits->bind_param("i", $delete_id);
        $stmt_visits->execute();

        $conn->commit();

        // Redirect after deletion
        // header("Location: displayPatients.php");
        // exit();
        $check = 1;
    } catch (Exception $e) {
        $conn->rollback();
        echo "Error during deletion: " . $e->getMessage();
    }
    if ($check === 1) {
        try {
            // Start transaction
            $conn->begin_transaction();

            // Delete associated visitdetails
            $stmt_visits = $conn->prepare("DELETE FROM patientdetails WHERE id = ?");
            $stmt_visits->bind_param("i", $delete_id);
            $stmt_visits->execute();

            $conn->commit();

            // Redirect after deletion
            header("Location: ../Filter/patientDetailsOnly.php");
            exit();
        } catch (Exception $e) {
            $conn->rollback();
            echo "Error during deletion: " . $e->getMessage();
        }
    }
}
?>