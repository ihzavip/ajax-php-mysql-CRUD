<?php
require "config.php";

// Check if customer_id is set in the query string
if(isset($_GET['customer_id'])) {
  $customer_id = $_GET['customer_id'];

  // Query the database to get data for the specified customer_id
  $querySelectById = "SELECT * FROM data_customer WHERE customer_id = '$customer_id'";
  $result = mysqli_query($conn, $querySelectById);

  if (!$result) {
    die("Query failed: " . mysqli_error($conn));
  }

  // Process the data and return as JSON
  $data = array();
  while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
  }
  echo json_encode($data);

} else {
  echo "Error: customer_id parameter is missing";
}

// Close the database connection
mysqli_close($conn);
?>
