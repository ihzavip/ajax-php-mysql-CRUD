<?php
require "config.php";
// Query the database to get data
$querySelectAll = "SELECT * FROM data_customer";
$result = mysqli_query($conn, $querySelectAll);

if (!$result) {
  die("Query failed: " . mysqli_error($conn));
}

// Process the data and return as JSON
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
  $data[] = $row;
}
echo json_encode($data);

// Close the database connection
mysqli_close($conn);
?>

