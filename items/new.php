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
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/">PriceTale</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Brands</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Categories</a>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <a href="/items/new.php" class="btn btn-outline-primary mr-sm-2 my-sm-0" role="button">Add Item</a>
      </form>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search Items" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
      </form>
    </div>
  </nav>

  <div class="container">
    <h1>New Item</h1>
      <div class="card border-secondary mb-3">
        <div class="card-header">
          Create a new Item
        </div>
        <div class="card-body">
          <form>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" placeholder="Black Crossbody Bag">
              </div>
              <div class="form-group col-md-6">
                <label for="product_code">Product Code</label>
                <input type="text" class="form-control" id="product_code" placeholder="M007">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="image_url">Image URL</label>
                <input type="text" class="form-control" id="image_url" placeholder="https://louisvuitton.com/product/123.jpg" onchange="onURLChange">
              </div>
              <div class="form-group col-md-6">
                <label for="">Image Preview</label>
                <p id="image-placeholder">None</p>
                <img id="image-display" style="display:none" src="" class="img-thumbnail" alt="...">
              </div>
            </div>
            <div class="form-group">
              <label for="description">Description</label>
              <textarea class="form-control" id="description" rows="3" placeholder="Size, Colour, Material..."></textarea>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="brand">Brand</label>
                <select id="brand" class="form-control">
                  <option selected>Choose...</option>
                  <option>...</option>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="category">Category</label>
                <select id="category" class="form-control">
                  <option selected>Choose...</option>
                  <option>...</option>
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
