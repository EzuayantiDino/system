<?php
  include "server/setup.php";
  include "server/user.class.php";
  include "server/cart.class.php";
  include "menu_bar.php";
  include "footer.php";
  session_start();
  protection("user");

  $user = new user();
  if(!$user->is_complete_details($_SESSION['userid'])) {
    header("Location: my_account.php");
  }
  $cart = new cart();
?>
<html>
<head>
  <title>Cart</title>
  <link rel="icon" href="images/logo.jpg" type="image/x-icon">
  <link rel="stylesheet" type="text/css" href="setup.css">
  <script src="jquery/jquery.js"></script>
  <script src="setup.js"></script>
  <style>
    #divBottom {
      background: #e7e7e7;
    }

    table {
      border-collapse: collapse;  
    }

    .img_poster {
      height: calc(100vh - 47px);
      width: 100vw;
      object-fit: cover;
    }

    #divCart {
      display: flex;
      gap: 20px;
      margin: auto;
      margin-top: 20px;
      width: calc(100vw - 100px);
      overflow-x: hidden;
      min-height: calc(100vh - 330px);
    }

    #divCartList {
      height: fit-content;
      border-radius: 10px;
      background: white;
    }

    h4 {
      margin-top: 10px;
    }

    .cart-card {
      display: flex;
      margin-bottom: 20px;
      gap: 10px;
      padding: 20px;
    }

    .img-product {
      height: 150px;
      width: 150px;
      border-radius: 10px;
    }

    #btn_checkout {
      font-family: RubikMedium;
      margin-top: 20px;
      width: 100%;
    }

    #tableCart {
      border-collapse: collapse;
      width: 100%;
    }

    #tableCart input {
      text-align: center;
      width: 50px;
    }

    #tableCart > tbody > tr > td:not(:first-child) {
      text-align: center;
    }

    #tableCart > tbody > tr > th {
      padding: 20px 0px;
      font-size: 18px;
    }

    #tableCart > tbody > tr > td {
      border-top: 2px solid lightgray;
      padding: 20px 0px;
    }

    #tableCart > tbody > tr > td:first-child {
      display: flex;
      align-items: center;
    }

    #tableCart > tbody > tr > td:first-child > div {
      display: flex;
      flex-direction: column;
      padding-left: 10px;
      height: fit-content;
    }
    #tableCart > tbody > tr > td:first-child > div > p {
      font-size: 14px;
    }

    #tableCart > tbody > tr > td:first-child > img {
      height: 150px;
      width: 150px;
      border-radius: 10px;
      margin-left: 20px;
    }

    #tableCart > tbody > tr {
      padding: 10px;
    }

    #tableCart .divQty {
      display: flex;
      justify-content: center;
      gap: 10px;
    }

    #tableCart h1 {
      cursor: pointer;
    }

    input[type='checkbox'] {
      width: 20px;
    }

  </style>
</head>
<body>
  <div id="divMain">
    <div id="divTop"><?php print menu_bar(); ?></div>
    <div id="divBottom">
      <br>
      <h2 align="center">Shopping Cart</h2>
      <div id="divCart">
        <div id="divCartList" style="flex:1;">
          <table id="tableCart">
            <tbody><tr>
              <th>Product Details</th>
              <th>Unit Price</th>
              <th>Discount</th>
              <th>Quantity</th>
              <th>Total Price</th>
              <th></th>
            </tbody></tr>
            <tbody id="tableCartContent">
              <?php print $cart->html_cart(); ?>
            </tbody>
            
          </table>
          
        </div>
        <div style="width:250px;padding:20px;background:white; border-radius:10px;height:fit-content;">
          <h2>Checkout</h2>
          <br>
          <table style="width:100%;">
            <tr style="font-size:18px;font-family:RubikMedium;">
              <td style="padding-bottom:10px;">Subtotal:</td>
              <td id="dydata_subtotal_price" style="text-align:right;padding-bottom:10px;"><?php print ringgit(0); ?></td>
            </tr>
            <tr>
              <td style="padding-bottom:10px;">Shipping:</td>
              <td id="dydata_shipping_fee" style="text-align:right;padding-bottom:10px;"><?php print ringgit(0); ?></td>
            </tr>
            <tr>
              <td style="padding-bottom:10px;">Discount:</td>
              <td id="dydata_total_discount" style="text-align:right;padding-bottom:10px;"><?php print ringgit(0); ?></td>
            </tr>
            <tr>
              <td style="border-top:1px solid black;padding-top:10px;">Total:</td>
              <td id="dydata_total_price" style="text-align:right;border-top:1px solid black;padding-top:10px;"><?php print ringgit(0); ?></td>
            </tr> 
          </table>
          
          <button id="btn_checkout" onclick="checkout()">Proceed to Checkout</button>
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
  var no_of_items = <?php print $cart->no_of_items; ?>;
  var cart_list = <?php print json_encode($cart->cart_list); ?>;
  var checked_cart = [];
  var subtotal_price = 0;
  var total_discount = 0;
  var shipping_fee = <?php print $cart->shipping_fee; ?>;
  var total_price = 0;

  function remove(rowid) {
    loadingStart();
    var data = {};
    data['action'] = "remove_cart";
    data['rowid'] = rowid;
    for(var i = 0; i < checked_cart.length; i++) {                         
      if(checked_cart[i] == rowid) { 
        checked_cart.splice(i, 1); 
        i--; 
      }
    }
    console.table(data);
    $.ajax({
      url: 'server/cart.php',
      type: 'post',
      data: data,
      dataType: 'JSON',
      success: function(response) {
        console.log(response);
        if(response.result) {
          $("#tableCartContent").html(response.gui_table_cart);
          cart_list = response.cart_list;
          calc_subtotal_price();
        }
        loadingEnd();
      }        
    });
  }

  function checkbox(dom, rowid) {
    console.log("Value: " + dom.checked);
    if(dom.checked) {
      checked_cart.push(rowid);
    } else {
      for(var i = 0; i < checked_cart.length; i++) {                         
        if(checked_cart[i] == rowid) { 
          checked_cart.splice(i, 1); 
          i--; 
        }
      }
    }
    console.table(checked_cart);
    calc_subtotal_price();
  }

  function calc_subtotal_price() {
    subtotal_price = 0;
    total_discount = 0;
    for(var i = 0; i < checked_cart.length; i++) {
      $("#checkbox_"+checked_cart[i]).attr("checked","true");
      subtotal_price = subtotal_price + parseInt(cart_list[location_by_rowid(checked_cart[i])]['price'] * cart_list[location_by_rowid(checked_cart[i])]['qty']);
      total_discount = total_discount + parseInt(cart_list[location_by_rowid(checked_cart[i])]['discount'] * cart_list[location_by_rowid(checked_cart[i])]['qty']);
    }
    if(subtotal_price == 0) {
      shipping_fee = 0;
    } else {
      shipping_fee = 4.9;
    }
    total_price = subtotal_price - total_discount + shipping_fee;
    $("#dydata_subtotal_price").html(subtotal_price.toFixed(2));
    $("#dydata_shipping_fee").html(shipping_fee.toFixed(2));
    $("#dydata_total_discount").html(total_discount.toFixed(2));
    $("#dydata_total_price").html(total_price.toFixed(2));
  }

  function checkout() {
    var data = {};
    data['action'] = "create_order";
    data['total_discount'] = total_discount;
    data['shipping_fee'] = shipping_fee;
    data['total_price'] = total_price;
    data['checked_cart'] = checked_cart;
    console.table(data);
    $.ajax({
      url: 'server/order.php',
      type: 'post',
      data: data,
      dataType: 'JSON',
      success: function(response) {
        console.log(response);
        if(response.result) {
          location.replace("payment_gateway.php");
        }
        loadingEnd();
      }        
    });
  }

  function update_qty(rowid, qty) {
    loadingStart();
    var data = {};
    data['action'] = "update_qty";
    data['rowid'] = rowid;
    data['qty'] = parseInt(cart_list[location_by_rowid(rowid)]['qty']) + parseInt(qty);
    if(data['qty'] < 1) {
      remove(rowid);
      return true;
    }
    $.ajax({
      url: 'server/cart.php',
      type: 'post',
      data: data,
      dataType: 'JSON',
      success: function(response) {
        console.log(response);
        if(response.result) {
          $("#tableCartContent").html(response.gui_table_cart);
          cart_list = response.cart_list;
          calc_subtotal_price();
        }
        loadingEnd();
      }        
    });
  }

  function location_by_rowid(rowid) {
    for(let l = 0; l < cart_list.length; l++) {
      if(cart_list[l]['rowid'] == rowid) {
        return l;
      }
    }
  }
</script>
</html>