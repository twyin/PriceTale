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

$price_records_query = "SELECT * FROM price_record;";
$price_records_query_result = $conn->query($price_records_query);
if ($price_records_query_result->num_rows > 0) {
  $price_records_query_rows = [];
  while($price_records_query_row = $price_records_query_result->fetch_assoc()) {
    array_push($price_records_query_rows, $price_records_query_row);
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

  <!-- Datepicker CSS -->
  <link href="https://unpkg.com/gijgo@1.9.11/css/gijgo.min.css" rel="stylesheet" type="text/css" />

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
              <small class="text">Price: <?php echo '???'?></small>
              <button type="button" class="btn btn-sm btn-link price-history-button" data-toggle="modal" data-target="#priceHistoryModal<?php echo $item['id']?>" onclick="loadChart<?php echo $item['id']?>()">
                <i class="fas fa-chart-line"></i>
                History
              </button>
            </div>

            <!-- Modal -->
            <div class="modal" id="priceHistoryModal<?php echo $item['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" >
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <form method="post" action="/price_records/new.php">
                    <div class="modal-header">
                      <h5 class="modal-title">Price History for <?php echo $item['name']?></h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div id="chartContainer<?php echo $item['id']?>" style="display: none;"></div>
                      <table class="table table-bordered table-hover"> <thead>
                          <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Price</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            foreach ($price_records_query_rows as $price_record) {
                              if ($price_record['item_id'] == $item['id']) { ?>
                                <tr>
                                  <td><?php echo $price_record['date'] ?></td>
                                  <td><strong>$<?php echo $price_record['price'] ?></strong></td>
                                </tr>
                          <?php 
                              }
                            } ?>
                          <tr>
                            <td class="align-middle"><input name="date" id="datepicker<?php echo $item['id']?>" width="276" /></td>
                            <td>
                              <strong>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                  </div>
                                  <input type="number" name="price" class="form-control" placeholder="123.00">
                                  <input type="number" name="item_id" value="<?php echo $item['id'] ?>" style="display: none">
                                </div>
                              </strong>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Submit new price</button>
                    </div>
                  </form>
                </div>
              </div>
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
  <script src="https://unpkg.com/gijgo@1.9.11/js/gijgo.min.js" type="text/javascript"></script>
  <script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
  <?php foreach ($rows as $item) { ?>
    <!-- JS to prepare each modal's Price graph and Datepicker -->
    <script>
      // Datepicker for each modal
      $('#datepicker<?php echo $item['id']?>').datepicker({
        uiLibrary: 'bootstrap4'
      });
      // Display modal based on get parameter
      <?php
        if (!empty($_GET['item_id']) && $_GET['item_id']==$item['id']) {
          // display modal for that item
          echo "$(function() {
            $(\"#priceHistoryModal".$item['id']."\")[0].setAttribute(\"data-show\", true);
            $(\"#priceHistoryModal".$item['id']."\").modal();
          });";
        }
      ?>

      // Prepare Price History chart
      <?php
        $price_records_for_item = [];
        foreach ($price_records_query_rows as $price_record) {
          if ($price_record['item_id'] == $item['id']) {
            array_push($price_records_for_item, $price_record);
          }
        }
        if (count($price_records_for_item) > 0) {
      ?>
          $('#chartContainer<?php echo $item['id']?>')[0].setAttribute('style', 'height: 300px; width: 100%;');
          $(function() {
            var chart = new CanvasJS.Chart(
              "chartContainer<?php echo $item['id']?>",
              {
                axisX:{
                  title: "Date",
                  gridThickness: 2
                },
                axisY: {
                  title: "Price ($)"
                },
                data: [{        
                  type: "line",
                  xValueType: "dateTime",
                  dataPoints: [//array
                    <?php
                      foreach ($price_records_query_rows as $price_record) {
                        if ($price_record['item_id'] == $item['id']) {
                          echo "{ 'x': Date.parse(\"".$price_record['date']."\"), 'y': ".$price_record['price']."},";
                        }
                      }
                    ?>
                  ]
                }]
              }
            );
            chart.render();
          })
      <?php       
        }
      ?>
    </script>
  <?php } ?>
</body>
</html>
