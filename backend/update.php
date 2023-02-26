<?php

require 'config.php';

$customer_id = $_POST['customer_id'];
$perusahaan = $_POST['perusahaan'];
$jenis_barang = $_POST['jenis_barang'];
$tanggal_masuk = $_POST['tanggal_masuk'];
$tanggal_keluar = $_POST['tanggal_keluar'];
$kuantiti = $_POST['kuantiti'];

// Create a prepared statement
$updateQuery = "UPDATE data_customer SET perusahaan=?, jenis_barang=?, tanggal_masuk=?, tanggal_keluar=?, kuantiti=? WHERE customer_id=?";
$stmt = mysqli_prepare($conn, $updateQuery);

// Bind parameters to the prepared statement
// mysqli_stmt_bind_param($stmt, "ssssii", $perusahaan, $jenis_barang, $tanggal_masuk, $tanggal_keluar, $kuantiti, $customer_id);

// Execute the statement
// if (mysqli_stmt_execute($stmt)) {
//     http_response_code(200);
//     echo json_encode(['message' => 'Data updated successfully']);
// } else {
//     http_response_code(500);
//     echo json_encode(['error' => 'Error updating data: ' . mysqli_error($conn)]);
// }

if ($stmt === false) {
  // Return a JSON response indicating failure with the error message
  $response = array("success" => false, "error" => mysqli_error($conn));
  echo json_encode($response);
  error_log(mysqli_error($conn));
} else {
  // Bind the parameters to the prepared statement
  $bindResult = mysqli_stmt_bind_param($stmt, "ssssii", $perusahaan, $jenis_barang, $tanggal_masuk, $tanggal_keluar, $kuantiti, $customer_id);

  if ($bindResult === false) {
    // Return a JSON response indicating failure with the error message
    $response = array("success" => false, "error" => mysqli_stmt_error($stmt));
    echo json_encode($response);
    error_log(mysqli_stmt_error($stmt));
  } else {
    // Execute the SQL query
    $executeResult = mysqli_stmt_execute($stmt);

    if ($executeResult === false) {
      // Return a JSON response indicating failure with the error message
      $response = array("success" => false, "error" => mysqli_stmt_error($stmt));
      echo json_encode($response);
      error_log(mysqli_stmt_error($stmt));
    } else {
      // Return a JSON response indicating success
      $response = array("success" => true);
      echo json_encode($response);
    }
  }
}

// Close the prepared statement and database connection
mysqli_stmt_close($stmt);
mysqli_close($conn);

?>
