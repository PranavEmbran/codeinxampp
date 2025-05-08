<?php
// Check if the delete button was clicked
if (isset($_POST['delete'])) {
    // Get the ID of the record to delete
    $delete_id = $_POST['delete_id'];

    // SQL query to delete the record with the given ID
    $sql_delete = "DELETE FROM studentdetails WHERE id='$delete_id'";
    // Execute the delete query
    $conn->query($sql_delete);
}
?>