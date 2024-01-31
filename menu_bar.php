<?php
  function menu_bar() {
    try {
      if(session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
      }
      if(!isset($_SESSION['user_type'])) {
        $_SESSION['user_type'] = "";
      }

      $data = sqlSelect(array("table" => "product_category", "column" => array("category")));


     
      $btn_category = "
       <div class='dropdown' onclick='navbar_dropdown()'>
          <button class='dropbtn' hover='navbar_dropdown()'>Collection</button>
          <div class='dropdown-content'>
      ";
      for($l = 0; $l < count($data); $l++) {
        $btn_category .= "<a href='product.php?category=" . $data[$l]['category'] . "'>" . $data[$l]['category'] . "</a>";
      }
      $btn_category .= "
        </div></div>
      ";

      $btn_admin = "";
      if($_SESSION['user_type'] == "owner") {
        $btn_admin = "
        <div class='dropdown'>
          <button class='dropbtn'>Admin</button>
          <div class='dropdown-content'>
            <a href='m_staff.php'>User Master</a>
            <a href='m_product.php'>Product Master</a>
          </div>
        </div>
        ";
      }

      $btn_order = "
        <div class='dropdown' onclick='navbar_dropdown()'>
          <button class='dropbtn' hover='navbar_dropdown()'>Orders</button>
          <div class='dropdown-content'>
            <a href='my_order.php'>My Order</a>
      ";


      if($_SESSION['user_type'] == "owner" || $_SESSION['user_type'] == "staff") {
        $btn_order .= "
          <a href='new_order.php'>New Order List</a>
          <a href='accepted_order.php'>Accepted List</a>
          <a href='shipped_order.php'>Shipped List</a>
          <a href='arrived_order.php'>Arrived List</a>
        ";
      }

      $btn_order .= "</div></div>";

      $ret_html = "
        <div id='navbar' class='navbar'>
          <a class='navbar_btn' href='index.php'>Home</a>
          <a class='navbar_btn' href='aboutus.php'>About Us</a>
          $btn_category
          <a class='navbar_btn' href='feedback.php'>Feedback</a>
          <a class='navbar_btn' href='contact.php'>Contact Us</a>
          $btn_order
          $btn_admin
          <a class='navbar_btn' href='my_account.php'>My Account</a>
          
          <a href='login.php' style='float:right'><i class='icon_login'>###</i></a>
          <a href='cart.php' style='float:right'><i class='icon_cart'>##</i></a>
        </div>
      ";



      return $ret_html;
    } catch(Exception $e) {
      echo $e->getMessage();
      return false;
    }
  }
?>