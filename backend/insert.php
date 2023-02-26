<?php 
require "config.php";

// Get the form data sent by the client
$perusahaan = $_POST["perusahaan"];
$jenis_barang = $_POST["jenis_barang"];
$tanggal_masuk = $_POST["tanggal_masuk"];
$tanggal_keluar = $_POST["tanggal_keluar"];
$kuantiti = $_POST["kuantiti"];

// Prepare a SQL query to insert the form data into the database
$insertQuery = "INSERT INTO data_customer (perusahaan, jenis_barang, tanggal_masuk, tanggal_keluar, kuantiti) VALUES (?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $insertQuery);

if ($stmt === false) {
  // Return a JSON response indicating failure with the error message
  $response = array("success" => false, "error" => mysqli_error($conn));
  echo json_encode($response);
  error_log(mysqli_error($conn));
} else {
  // Bind the parameters to the prepared statement
  $bindResult = mysqli_stmt_bind_param($stmt, "ssssi", $perusahaan, $jenis_barang, $tanggal_masuk, $tanggal_keluar, $kuantiti);

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
