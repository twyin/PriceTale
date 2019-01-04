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
    $nameErr = "Please enter a category name.";
  } else {
    $name = $_POST['name'];

    $new_category_query = "INSERT INTO category (name) VALUES ('".$name."');";

    $new_category_query_result = $conn->query($new_category_query);
    if ($new_category_query_result) { // Success
      header('Location: /categories/index.php?new_category_name='.$name);
      die();
    }
  }
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
    <h1>New category</h1>
      <div class="card border-secondary mb-3">
        <div class="card-header">
          Create a new category
        </div>
        <div class="card-body">
          <form action="/categories/new.php" method="post">
            <div class="form-group">
              <label for="name">Name</label>
              <?php if(empty($nameErr)) { ?>
                <input type="text" class="form-control" name="name" id="name" placeholder="Clothes">
              <?php } else { ?>
                <input type="text" class="form-control is-invalid" id="name" placeholder="Clothes"" required>
                <div class="invalid-feedback">
                  <?php echo $nameErr ?>
                </div>
              <?php } ?>
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
</body>
</html>
