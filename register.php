<html>
<head>
  <title>Register</title>
  <link rel="icon" href="images/logo.jpg" type="image/x-icon">
  <link rel="stylesheet" type="text/css" href="setup.css">
  <script src="jquery/jquery.js"></script>

  <style>
    body {
      width: 100vw;
      background: url(images/store.jpg);
      background-repeat: no-repeat;
      background-size: cover;
    }
    #divParent {
      display: flex;
      height: 100vh;
      justify-content: center;
      align-items: center; 
    }

    #container {
      width: 300px;
      background: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

    #btn_register {
      display: block;
      width: 100%;
      margin-top: 15px;
    }

    #btn_login {
      display: block;
      width: 100%;
      margin-top: 15px;
      color: black;
      background: lightgray;
    }
  </style>
</head>
<body>
  <div id="divParent">
    <div id="container">
      <h2>Register</h2>
      <label class="labelinputbox">User ID</label>
      <input type="text" id="input_userid" class="inputbox" autocomplete="off">
      <label class="labelinputbox">Password</label>
      <input type="password" id="input_password" class="inputbox">
      <label class="labelinputbox">Confirm Password</label>
      <input type="password" id="input_password_confirm" class="inputbox">
      <button id="btn_register" onclick="register()">Register</button>
      <button id="btn_login" onclick="login()">Back to Login</button>
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
<script src="setup.js"></script>
<script>
  listener_enter("input_userid", "focus('input_password')");
  listener_enter("input_password", "focus('input_password_confirm')");
  listener_enter("input_password_confirm", "register()");

  function register() {
    if(register_validation()) {
      loadingStart();
      var data = {};
      data['userid'] = $("#input_userid").val();
      data['password'] = $("#input_password").val();
      $.ajax({
        url: 'server/register.php',
        type: 'post',
        data: data,
        dataType: 'JSON',
        success: function(response) {
          console.log(response);
          if(response.result) {
            location.replace("login.php");
          } else {
            alert(response.reason);
          }
          loadingEnd();
        }        
      });
    }
  }

  function register_validation() {
    if($("#input_userid").val() == "") {
      alert("Please fill in all input field");
      return false;
    }
    if($("#input_password").val() == "") {
      alert("Please fill in all input field");
      return false;
    }
    $password = $("#input_password").val();
    if($password.split('').length < 8) {
      alert("Minimum Password is 8 figure");
      return false;
    }
    if($("#input_password_confirm").val() == "") {
      alert("Please fill in all input field");
      return false;
    }
    if($("#input_password").val() != $("#input_password_confirm").val()) {
      alert("password not match");
    }

    return true;
  }

  function login() {
    location.replace("login.php");
  }
</script>
</html>