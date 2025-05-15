<?php
if (isset($_POST['delete'])) {
    $delete_id = $_POST['delete_id'];

    $sql_delete = "DELETE FROM studentdetails WHERE id='$delete_id'";
    $conn->query($sql_delete);
}
?>