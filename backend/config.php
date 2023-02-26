
<?php
error_reporting(E_ALL);
// Connect to the database
$host = "localhost:3307"; // Change this to your database host
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "wilsonDB"; // Change this to your database name
$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>

