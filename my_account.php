<?php
  include "server/setup.php";
  include "menu_bar.php";
  include "footer.php";
  session_start();
  protection("user");
?>
<html>
<head>
  <title>My Account</title>
  <link rel="icon" href="images/logo.jpg" type="image/x-icon">
  <link rel="stylesheet" type="text/css" href="setup.css"/>
  <script src="jquery/jquery.js"></script>
  <script src="setup.js"></script>
</head>
<body>
  <div id="divMain">
    <div id="divTop"><?php print menu_bar(); ?></div>
    <div id="divBottom">
      <div style="width:600px;margin:auto;padding:20px;">
        <h2 align="center">My Account</h2>
          <div style="display:flex;gap:10px;">
            <div style="flex:1;">
              <label class="labelinputbox">User ID</label>
              <input id="input_edit_userid" class="inputbox" autocomplete="off" readonly>
            </div>
            <div style="flex:1;">
              <label class="labelinputbox">Phone</label>
              <input id="input_edit_phone" class="inputbox" autocomplete="off">
            </div>
          </div>
          <label class="labelinputbox">Full Name</label>
          <input id="input_edit_fullname" class="inputbox" autocomplete="off">
          <label class="labelinputbox">Email</label>
          <input id="input_edit_email" class="inputbox" autocomplete="off">
          <label class="labelinputbox">Address 1</label>
          <input id="input_edit_address1" class="inputbox" autocomplete="off">
          <label class="labelinputbox">Address 2</label>
          <input id="input_edit_address2" class="inputbox" autocomplete="off">
          <label class="labelinputbox">Address 3</label>
          <input id="input_edit_address3" class="inputbox" autocomplete="off">
          <div style="display:flex;gap:10px;">
            <div style="flex:1;">
              <label class="labelinputbox">City</label>
              <input id="input_edit_city" class="inputbox" autocomplete="off">
            </div>
            <div style="flex:1;">
              <label class="labelinputbox">State</label>
              <input id="input_edit_state" class="inputbox" autocomplete="off">
            </div>
            <div style="flex:1;">
              <label class="labelinputbox">Postcode</label>
              <input id="input_edit_postcode" class="inputbox" autocomplete="off">
            </div>
          </div>
          <div style="display:flex;gap:10px;margin-top:10px;">
            <button onclick="save()">Save Changes</button>
            <button class='btn-cancel' onclick="$('#divEditUser').css('display','none');">Cancel</button>
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
  set_data("<?php print $_SESSION['userid'] ?>");

  function set_data(userid) {
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
          $("#input_edit_userid").val(response.details.userid);
          $("#input_edit_phone").val(response.details.phone);
          $("#input_edit_fullname").val(response.details.full_name);
          $("#input_edit_email").val(response.details.email);
          $("#input_edit_address1").val(response.details.address1);
          $("#input_edit_address2").val(response.details.address2);
          $("#input_edit_address3").val(response.details.address3);
          $("#input_edit_city").val(response.details.city);
          $("#input_edit_state").val(response.details.state);
          $("#input_edit_postcode").val(response.details.postcode);
        }
        loadingEnd();
      }        
    });
  }

  function save() {
    loadingStart();
    var data = {};
    data['action'] = "update_my_details";
    data['userid'] = $("#input_edit_userid").val();
    data['phone'] = $("#input_edit_phone").val();
    data['fullname'] = $("#input_edit_fullname").val();
    data['email'] = $("#input_edit_email").val();
    data['address1'] = $("#input_edit_address1").val();
    data['address2'] = $("#input_edit_address2").val();
    data['address3'] = $("#input_edit_address3").val();
    data['city'] = $("#input_edit_city").val();
    data['state'] = $("#input_edit_state").val();
    data['postcode'] = $("#input_edit_postcode").val();
    $.ajax({
      url: 'server/user.php',
      type: 'post',
      data: data,
      dataType: 'JSON',
      success: function(response) {
        console.log(response);
        if(response.result) {
        }
        loadingEnd();
      }        
    });
  }
</script>
</html>