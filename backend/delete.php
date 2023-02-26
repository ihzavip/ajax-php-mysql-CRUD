<?php

require 'config.php';

// Get the id of the row to be deleted
$customer_id = $_POST['customer_id'];

$sql = "DELETE FROM data_customer WHERE customer_id = $customer_id";

if($conn->query($sql) === TRUE) {
    echo json_encode("Row delete succesfully");
} else {
    echo json_encode("Error deleting row: " . $conn->error);
}

$conn->close();
?>