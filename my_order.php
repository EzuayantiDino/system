


<?php
  include "server/setup.php";
  include "server/order.class.php";
  include "menu_bar.php";
  include "footer.php";
  session_start();
  protection("user");
  
  $order = new order();
?>
<html>
<head>
  <title>My Order</title>
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
      padding: 20px;
      overflow-x: hidden;
      min-height: calc(100vh - 330px);
    }

    .product_card {
      width: 250px;
    }

    .product_img {
      height: 150px;
      width: 150px;
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
        <h2 align="center">My Order</h2><br>
        <table id="divProductList" style="width:95vw;" class="table1">
          <?php print $order->html_table_order(); ?>
        </table>
      </div>
      
      <?php print footer(); ?>
    </div>
    <!-- ###### start of div for loading overlay ###### -->
    <div id="divLoading" class="overlay">
        <div class="overlay-container">
          <h2>Loading...</h2>
        </div>
      </div>
      <!-- ###### end of div for loading overlay ###### -->
  </div>
</body>
<script>
  function open_product(rowid) {
    location.replace("product_details.php?rowid="+rowid);
  }
</script>
</html>