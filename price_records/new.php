<?php 
$servername = "localhost:8889";
$username = "root";
$password = "root";
$dbname = "pricetale";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

print_r($_POST);

$priceErr="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $date = $conn->real_escape_string($_POST['date']);
  $price = $conn->real_escape_string($_POST['price']);
  $item_id = $conn->real_escape_string($_POST['item_id']);

  // Convert to MYSQL date format
  $date = date("Y-m-d", strtotime($date));

  $new_price_record_query = "INSERT INTO price_record (date, price, item_id) VALUES ('".$date."', '".$price."', '".$item_id."');";

  $new_price_record_query_result = $conn->query($new_price_record_query);
  if ($new_price_record_query_result) { // Success
    header('Location: /index.php?item_id='.$item_id);
    die();
  }
}
$conn->close();
?>
