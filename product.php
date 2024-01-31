<?php
  include "server/setup.php";
  include "server/product.class.php";
  include "menu_bar.php";
  include "footer.php";
  session_start();
  protection("user");
  
  $product = new product();
  $category = $_GET['category'];
?>
<html>
<head>
  <title>Product</title>
  <link rel="icon" href="images/logo.jpg" type="image/x-icon">
  <link rel="stylesheet" type="text/css" href="setup.css">
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
      margin-top: 20px;
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
  </style>
</head>
<body>
  <div id="divMain">
    <div id="divTop"><?php print menu_bar(); ?></div>
    <div id="divBottom">
      <div id="divProduct">
        <h1 align="center">Collection </h1>
        <br>
        <h3 align="center"> <?php print ucfirst($category); ?></h3>
        <div id="divProductList">
          <?php print $product->html_product_list($category); ?>
        </div>
      </div>
      <br><br><br>
      <?php print footer(); ?>
    </div>
  </div>
</body>
<script>
  function open_product(rowid) {
    location.replace("product_details.php?rowid="+rowid);
  }
</script>
</html>