<?php
  include "server/setup.php";
  include "menu_bar.php";
  include "server/user.class.php";
  session_start();
  protection("owner");
  
  $user = new user();
?>
<html>
<head>
  <title></title>
  <link rel="stylesheet" type="text/css" href="setup.css"/>
  <script src="jquery/jquery.js"></script>
  <script src="setup.js"></script>
  <style>
    #divCreateUser_container {
      width: 300px;
    }
  </style>
</head>
<body>
  <div id="divMain">
    <div id="divTop"><?php print menu_bar(); ?></div>
    <div id="divBottom" style="padding:20px;">
      <div id="divCreateUser" class="overlay">
        <div id="divCreateUser_container" class="overlay-container">
          <h2>Add New User</h2>
          <label class="labelinputbox">User ID</label>
          <input id="input_create_userid" class="inputbox" autocomplete="off">
          <label class="labelinputbox">Password</label>
          <input id="input_create_password" type="password" class="inputbox" autocomplete="off">
          <label class="labelinputbox">Type / Role</label>
          <select id="input_create_type" class="inputbox"><?php print $user->option_user_type(); ?></select>
          <div style="display:flex;gap:10px;margin-top:10px;">
            <button onclick="create_user()">Add New User</button>
            <button class='btn-cancel' onclick="$('#divCreateUser').css('display','none');">Cancel</button>
          </div>
        </div>
      </div>
      <div id="divEditUser" class="overlay">
        <div id="divEditUser_container" class="overlay-container">
          <h2>Edit User Details</h2>
          <div style="display:flex;gap:10px;">
            <div style="flex:1;">
              <label class="labelinputbox">User ID</label>
              <input id="input_edit_userid" class="inputbox" autocomplete="off" readonly>
            </div>
            <div style="flex:1;">
              <label class="labelinputbox">Type</label>
              <select id="input_edit_type" class="inputbox"><?php print $user->option_user_type(); ?></select>
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
              <input id="input_edit_city" class="inputbox" autocomplete="off" readonly>
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
            <button onclick="update_user()">Save Changes</button>
            <button class='btn-cancel' onclick="$('#divEditUser').css('display','none');">Cancel</button>
          </div>
        </div>
      </div>
      <button onclick="$('#divCreateUser').css('display','flex');">Add New User</button>
      <table id="table_user_list" class='table1' style="margin-top:20px;">
        <?php print $user->html_table_user_content(); ?>
      </table>


      <!-- ###### start of div for loading overlay ###### -->
      <div id="divLoading" class="overlay">
        <div class="overlay-container">
          <h2>Loading...</h2>
        </div>
      </div>
      <!-- ###### end of div for loading overlay ###### -->
    </div>
  </div>
</body>
<script>

  function edit_user(userid) {
    $("#input_edit_userid").val(userid);
    $("#divEditUser").css('display','flex');
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

  function create_user() {
    if(create_user_validation()) {
      loadingStart();
      var data = {};
      data['action'] = "create_user";
      data['userid'] = $("#input_create_userid").val();
      data['password'] = $("#input_create_password").val();
      data['user_type'] = $("#input_create_type").val();
      $.ajax({
        url: 'server/user.php',
        type: 'post',
        data: data,
        dataType: 'JSON',
        success: function(response) {
          console.log(response);
          if(response.result) {
            $("#table_user_list").html(response.gui);
          }
          loadingEnd();
        }        
      });
    } else {
      alert("Please fill all input");
    }
  }

  function update_user() {
    if(update_user_validation()) {
      loadingStart();
      var data = {};
      data['action'] = "update_user";
      data['userid'] = $("#input_edit_userid").val();
      data['user_type'] = $("#input_edit_type").val();
      data['phone'] = $("#input_edit_phone").val();
      data['fullname'] = $("#input_edit_fullname").val();
      data['email'] = $("#input_edit_email").val();
      data['address1'] = $("#input_edit_address1").val();
      data['address2'] = $("#input_edit_address2").val();
      data['address3'] = $("#input_edit_address3").val();
      data['city'] = $("#input_edit_city").val();
      data['state'] = $("#input_edit_state").val();
      data['postcode'] = $("#input_edit_postcode").val();
      console.table(data);
      $.ajax({
        url: 'server/user.php',
        type: 'post',
        data: data,
        dataType: 'JSON',
        success: function(response) {
          console.log(response);
          if(response.result) {
            $("#table_user_list").html(response.gui);
            $('#divEditUser').css('display','none');
          }
          loadingEnd();
        }        
      });
    } else {
      alert("Please fill all input");
    }
  }

  function create_user_validation() {
    if($("#input_create_userid").val() == "") {
      return false;
    }
    if($("#input_create_password").val() == "") {
      return false;
    }
    if($("#input_create_type").val() == "") {
      return false;
    }

    return true;
  }

  function update_user_validation() {
    if($("#input_edit_userid").val() == "") {
      return false;
    }

    return true;
  }

  function delete_user(userid) {
    if (confirm("Confirm to delete User ID: " + userid) == true) {
      loadingStart();
      var data = {};
      data['action'] = "delete_user";
      data['userid'] = userid;
      $.ajax({
        url: 'server/user.php',
        type: 'post',
        data: data,
        dataType: 'JSON',
        success: function(response) {
          console.log(response);
          if(response.result) {
            $("#table_user_list").html(response.gui);
          }
          loadingEnd();
        }        
      });
    } else {
      console.log("Cancel delete userid: " + userid);
    }
  }
</script>
</html>