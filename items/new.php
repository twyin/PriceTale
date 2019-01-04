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

$nameErr="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST['name'])) {
    $nameErr = "Please enter a product name.";
  } else {
    $name = $_POST['name'];
    $product_code = $_POST['product_code'];
    $image_url = $_POST['image_url'];
    $description = $_POST['description'];
    $brand_id = $_POST['brand'];
    $category_id = $_POST['category'];

    $new_item_query = "INSERT INTO item (brand_id, category_id, product_code, image_url, name, description) VALUES ('".$brand_id."', '".$category_id."', '".$product_code."', '".$image_url."', '".$name."', '".$description."');";

    $new_item_query_result = $conn->query($new_item_query);
    if ($new_item_query_result) { // Success
      header('Location: /index.php?new_product_name='.$name);
      die();
    }
  }
}

$get_brands_query = "SELECT * FROM brand ORDER BY name";
$get_brands_result = $conn->query($get_brands_query);
if ($get_brands_result->num_rows > 0) {
    // output data of each row
    $brand_rows = [];
    while($brand_row = $get_brands_result->fetch_assoc()) {
      array_push($brand_rows, $brand_row);
    }
} else {
    echo "0 results";
}

$get_categories_query = "SELECT * FROM category";
$get_categories_result = $conn->query($get_categories_query);
if ($get_categories_result->num_rows > 0) {
    $category_rows = [];
    while($category_row = $get_categories_result->fetch_assoc()) {
      array_push($category_rows, $category_row);
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
  <?php include '../general/header.php';?>

  <div class="container">
    <h1>New Item</h1>
      <div class="card border-secondary mb-3">
        <div class="card-header">
          Create a new Item
        </div>
        <div class="card-body">
          <form action="/items/new.php" method="post">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="name">Name</label>
                <?php if(empty($nameErr)) { ?>
                  <input type="text" class="form-control" name="name" id="name" placeholder="Black Crossbody Bag">
                <?php } else { ?>
                  <input type="text" class="form-control is-invalid" id="name" placeholder="Black Crossbody Bag"" required>
                  <div class="invalid-feedback">
                    <?php echo $nameErr ?>
                  </div>
                <?php } ?>
              </div>
              <div class="form-group col-md-6">
                <label for="product_code">Product Code</label>
                <input type="text" class="form-control" name="product_code" id="product_code" placeholder="M007">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="image_url">Image URL</label>
                <input type="text" class="form-control" name="image_url" id="image_url" placeholder="https://louisvuitton.com/product/123.jpg" onchange="onURLChange">
              </div>
              <div class="form-group col-md-6">
                <label for="">Image Preview</label>
                <p id="image-placeholder">None</p>
                <img id="image-display" style="display:none" src="" class="img-thumbnail product-image" alt="...">
              </div>
            </div>
            <div class="form-group">
              <label for="description">Description</label>
              <textarea class="form-control" name="description" id="description" rows="3" placeholder="Size, Colour, Material..."></textarea>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="brand">Brand</label>
                <select id="brand" name="brand" class="form-control">
                  <option value="0" selected>Choose...</option>
                  
                  <?php foreach ($brand_rows as $brand) { ?>
                    <option value="<?php echo $brand['id'] ?>"><?php echo $brand['name'] ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="category">Category</label>
                <select id="category" name="category" class="form-control">
                  <option value="0" selected>Choose...</option>
                  <?php foreach ($category_rows as $category) { ?>
                    <option value="<?php echo $category['id'] ?>"><?php echo $category['name'] ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
  </div>


  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  <script>
    function onURLChange(event) {
      url = event.target.value;
      image = document.getElementById('image-display')
      image.src = url;
      image.style = "display:block";
      placeholder = document.getElementById('image-placeholder')
      placeholder.style = "display:none";
    }
    document.getElementById("image_url").addEventListener("change", onURLChange)
  </script>
</body>
</html>
