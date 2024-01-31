<html>
<head>
  <title>Login</title>
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

    #btn_login {
      display: block;
      width: 100%;
      margin-top: 15px;
    }

    #btn_register {
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
      <h2>Login</h2>
      <label class="labelinputbox">User ID</label>
      <input type="text" id="input_userid" class="inputbox" autocomplete="off">
      <label class="labelinputbox">Password</label>
      <input type="password" id="input_password" class="inputbox">
      <button id="btn_login" onclick="login()">Login</button>
      <button id="btn_register" onclick="register()">Register</button>
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
  listener_enter("input_password", "login()");
  function login() {
    if(login_validation()) {
      loadingStart();
      var data = {};
      data['userid'] = $("#input_userid").val();
      data['password'] = $("#input_password").val();
      $.ajax({
        url: 'server/login.php',
        type: 'post',
        data: data,
        dataType: 'JSON',
        success: function(response) {
          console.log(response);
          if(response.result) {
            location.replace("index.php");
          } else {
            alert(response.reason);
          }
          loadingEnd();
        }        
      });
    } else {
      alert("Please fill in all input field");
    }
  }

  function login_validation() {
    if($("#input_userid").val() == "") {
      return false;
    }
    if($("#input_password").val() == "") {
      return false;
    }

    return true;
  }

  function register() {
    location.replace("register.php");
  }
</script>
</html>