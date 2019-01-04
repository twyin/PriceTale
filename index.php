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

$sql = "SELECT item.id, item.name, item.image_url, item.description, item.brand_id, brand.name AS brand_name, item.category_id, category.name AS category_name
FROM item
LEFT JOIN brand
  ON item.brand_id = brand.id
LEFT JOIN category
  ON item.category_id = category.id
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
  <link rel="stylesheet" href="/css/style.css">

  <title>PriceTale</title>
</head>
<body>
  <?php include './general/header.php';?>
  <div class="container">
    <?php if (!empty($_GET['new_product_name'])) { ?>
      <div class="alert alert-success mt-3" role="alert">
        <?php echo $_GET['new_product_name']." was successfully added!"?>
      </div>
    <?php }?>
    <h1>Items</h1>
    <div class="card-container">
      <?php foreach ($rows as $item) { ?>
          <div class="card item-card">
            <img src="<?php echo $item['image_url'] ?>" class="card-img-top product-image" alt="...">

            <div class="card-body">

              <h5 class="card-title"><?php echo $item['name'] ?></h5>
              <h6 class="card-subtitle mb-2">
                <?php if ($item['brand_name']) { ?>
                  <button type="button" class="btn btn-sm btn-outline-secondary brand-btn-sm" disabled>#<?php echo $item['brand_name'] ?></button>
                <?php } ?>
                <?php if ($item['category_name']) { ?>
                  <button type="button" class="btn btn-sm btn-outline-secondary brand-btn-sm" disabled>#<?php echo $item['category_name'] ?></button>
                <?php } ?>
              </h6>

              <p class="description-sm"><?php echo str_replace("\n", "<br>", $item['description']) ?></p>
            </div>
            <div class="card-footer bg-transparent">
              <small class="text"><?php echo 'Price: ???'?></small>
              <button type="button" class="btn btn-sm btn-link price-history-button">
                <i class="fas fa-chart-line"></i>
                History
              </button>
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
