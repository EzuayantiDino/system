<?php
  include "server/setup.php";
  include "server/product.class.php";
  include "menu_bar.php";
  include "footer.php";
  session_start();
  protection("user");
  
  $product = new product();
  $rowid = $_GET['rowid'];
  $product->get_details($rowid);
?>
<html>
<head>
  <title>Product</title>
  <link rel="icon" href="images/logo.jpg" type="image/x-icon">
  <link rel="stylesheet" type="text/css" href="setup.css">
  <script src="jquery/jquery.js"></script>
  <script src="setup.js"></script>
  <style>
    #divPoster {
      overflow-x: hidden;
    }

    .img_poster {
      height: calc(100vh - 47px);
      width: 100vw;
      object-fit: cover;
    }

    #divProduct {
      display: block;
      margin-top: 20px;
      width: 100vw;
      overflow-x: hidden;
      min-height: calc(100vh - 330px);
    }

    #divProductList {
      display: flex;
      gap: 20px;
      justify-content: center;
      flex-wrap: wrap;
    }

    .product_card {
      width: 250px;
    }

    .product_img {
      height: 250px;
      width: 250px;
      object-fit: cover;
      border-radius: 10px;
    }

    .product_p {
      margin: 0px;
      font-size: 20px;
      font-weight: bold;
    }
    .product_price {
      margin: 0px;
      font-size: 16px;
      font-weight: bold;
    }

    .img-media {
      width: 100%;
      border-radius: 7px;
      opacity: 50%;
    }

    .img-media:hover {
      opacity: 100%;
    }
  </style>
</head>
<body>
  <div id="divMain">
    <div id="divTop"><?php print menu_bar(); ?></div>
    <div id="divBottom">
      <div id="divProduct">
        <h2 align="center">Product: <?php print ucfirst($product->title); ?></h2>
        <div style="display:flex;gap:20px;width:1000px;margin:auto;margin-top:20px;">
          <div style="flex:3;display:flex;gap:20px;">
            <div style="display:flex;gap:10px;flex-direction:column;width:100px;">
              <?php print $product->html_media_view(); ?>
            </div>
            <div style="flex:1;"><img id="img_media_view" style="width:100%;border-radius:15px;" src="resources/products/<?php print $product->get_product_cover($rowid); ?>"></div>
            
          </div>
          <div style="flex:2;">
            <h3>About the Product</h3>
            <div><?php print $product->about; ?></div>
            <br>
            <h4>Price: RM<?php print $product->price; ?></h4>
            <br>
            <h4>Select Product Type:</h4>
            <select id="input_type" class="inputbox" style="width:fit-content"><?php print $product->option_type(); ?></select>
            <br>
            <h4>Quantity:</h4>
            <input id="input_qty" class="inputbox" type="number" style="width:70px;">
            <br>
            <button onclick="add_to_cart()">Add to Card</button>
          </div>
        </div>
        
      </div>
      <br><br>
      <?php print footer(); ?>
    </div>
  </div>
  <!-- ###### start of div for loading overlay ###### -->
  <div id="divLoading" class="overlay">
    <div class="overlay-container">
      <h2>Loading...</h2>
    </div>
  </div>
  <!-- ###### end of div for loading overlay ###### -->
</body>
<script>
  var rowid = "<?php print $rowid; ?>";
  function open_product(rowid) {
    location.replace("product_details.php?rowid="+rowid);
  }

  function change_media_view(filename) {
    $("#img_media_view").attr("src", "resources/products/"+filename);
  }

  function add_to_cart() {
    if($("#input_type").val() == "") {
      alert("Please select product type before add to cart");
      return false;
    }
    if($("#input_qty").val() == "") {
      alert("Please set quantity");
      return false;
    }
    loadingStart();
    var data = {};
    data['action'] = "add_cart";
    data['product'] = rowid;
    data['product_type'] = $("#input_type").val();
    data['qty'] = $("#input_qty").val();
    console.table(data);
    $.ajax({
      url: 'server/cart.php',
      type: 'post',
      data: data,
      dataType: 'JSON',
      success: function(response) {
        console.log(response);
        if(response.result) {
          //location.replace("cart.php");
        }
        loadingEnd();
      }        
    });
  }
</script>
</html>