<?php
    include "server/setup.php";
    
    $error_msg = false;
    if((isset($_POST['userid']))&&(isset($_POST['password']))) {
        if(authUser($_POST['userid'], $_POST['password'])) {
            userlog($_POST['userid']);
            update_otp($_POST['userid']);
            setup_session($_POST['userid']);
            header("Location: index.php");
        } else {
            $error_msg = true;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Login</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="design.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="footer.css" />
    <link rel="stylesheet" href="login.css">
</head>
<body>

<main id="main-holder">
    <h1 id="login-header">Login</h1>
    
    <div id="login-error-msg-holder">
      <p id="login-error-msg">Invalid username <span id="error-msg-second-line">and/or password</span></p>
    </div>
    
    <form id="login-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" onsubmit="return false;">
      <input type="text" name="userid" id="username-field" class="login-form-field" placeholder="Username">
      <input type="password" name="password" id="password-field" class="login-form-field" placeholder="Password">
      <input type="submit" value="Login" id="login-form-submit">
      <a href="index.html"><input type="cancel" value="Home" id="login-form-cancel"></a>
    </form>
  </main>

<script>

    <?php 
        if($error_msg) {
            echo "alert('Login Failed');";
        }
    ?>
    const loginForm = document.getElementById("login-form");
    const loginButton = document.getElementById("login-form-submit");
    const loginErrorMsg = document.getElementById("login-error-msg");

    loginButton.addEventListener("click", (e) => {
        e.preventDefault();
        const userid = loginForm.userid.value;
        const password = loginForm.password.value;

        if (userid != "" && password != "") {
            loginForm.submit();
        } else {
            alert("Please fill in userid and password");
        }
    });
</script>

			
</body>
</html>