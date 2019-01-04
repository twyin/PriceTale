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

$sql = "SELECT item.id, item.name, item.image_url, item.description, item.brand_id, brand.name AS brand_name
FROM item
LEFT JOIN brand
ON item.brand_id = brand.id
ORDER BY brand.name;
";

$result = $conn->query($sql);


if ($result->num_rows > 0) {
    // output data of each row
  $rows = [];
    while($row = $result->fetch_assoc()) {
      array_push($rows, $row);
    }
} else {
    echo "0 results";
}

$conn->close();
?>

<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

  <title>PriceTale</title>
  <style>
  .brand-btn-sm {
    padding: 0.25rem .3rem;
    font-size: 12px;
    line-height: 0.75;
    border-radius: .25rem;
  }
  .card-img-top {
    max-height: 300px;
    object-fit: contain;
  }
  .description-sm {
    margin-bottom: 0;
    font-size: 12px;
  }
  </style>
</head>
<body>
  <?php include 'general/header.php';?>
  <div class="container">
    <h1>Items</h1>
    <div class="card-columns">
      <?php foreach ($rows as $item) { ?>
          <div class="card">
            <img src="<?php echo $item['image_url'] ?>" class="card-img-top" alt="...">

            <div class="card-body">

              <h5 class="card-title"><?php echo $item['name'] ?></h5>
              <h6 class="card-subtitle mb-2"><button type="button" class="btn btn-sm btn-outline-secondary brand-btn-sm" disabled>#<?php echo $item['brand_name'] ?></button></h6>

              <p class="description-sm"><?php echo str_replace("\n", "<br>", $item['description']) ?></p>
            </div>
            <div class="card-footer">
              <small class="text-muted"><?php echo $item['brand_id'] ?></small>
            </div>
          </div>
      <?php } ?>
    </div>
  </div>


  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</html>
