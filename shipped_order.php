


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
  <title>Shipped Out Order</title>
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
      padding: 20px;
      overflow-x: hidden;
      min-height: calc(100vh - 330px);
    }

    #divCustomerDetails_container {
      width: 400px;
      max-height: calc(100vh - 100px);
      overflow: auto;
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
        <h2 align="center">Shipped Out Order</h2><br>
        <table id="divProductList" style="width:95vw;" class="table1">
          <?php print $order->html_table_order_shipped(); ?>
        </table>
      </div>
      <div id="divCustomerDetails" class="overlay">
        <div id="divCustomerDetails_container" class="overlay-container">
          <h2>Customer Details  <span style="color:red;cursor:pointer;" onclick="$('#divCustomerDetails').css('display','none');">X</span></h2>
          <p>Name: <span id="span_fullname"></span></p>
          <p>Phone: <span id="span_phone"></span></p>
          <p>Email: <span id="span_email"></span></p>
          <p>Address: <span id="span_address"></span></p>
          <p>City: <span id="span_city"></span></p>
          <p>State: <span id="span_state"></span></p>
          <p>Postcode: <span id="span_postcode"></span></p>
        </div>
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
  function details(userid) {
    loadingStart();
    var data = {};
    data['action'] = "get_user_details";
    data['userid'] = userid;
    $.ajax({
      url: 'server/user.php',
      type: 'post',
      data: data,
      dataType: 'JSON',
      success: function(response) {
        console.log(response);
        if(response.result) {
          $("#span_fullname").html(response.details.full_name);
          $("#span_phone").html(response.details.phone);
          $("#span_email").html(response.details.email);
          $("#span_address").html(response.details.address1 + ", " + response.details.address2 + ", " + response.details.address3);
          $("#span_city").html(response.details.city);
          $("#span_state").html(response.details.state);
          $("#span_postcode").html(response.details.postcode);
        }
        loadingEnd();
        $("#divCustomerDetails").css("display","flex");
      }        
    });
  }

  function arrived_order(rowid) {
    if(confirm("Confirm to arrived order: " + rowid) == true) {
      loadingStart();
      var data = {};
      data['action'] = "arrived_order";
      data['rowid'] = rowid;
      $.ajax({
        url: 'server/order.php',
        type: 'post',
        data: data,
        dataType: 'JSON',
        success: function(response) {
          console.log(response);
          if(response.result) {
            $("#divProductList").html(response.gui_table_order_shipped);
          }
          loadingEnd();
        }        
      });
    }
  }
</script>
</html>