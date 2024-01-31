<?php
  include "server/setup.php";
  include "server/product.class.php";
  include "menu_bar.php";
  include "footer.php";
  session_start();
  protection("user");
?>
<html>
<head>
  <title>Contact</title>
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

    #divDetails {
      display: block;
      margin: auto;
      margin-top: 20px;
      width: 400px;
      overflow-x: hidden;
      min-height: calc(100vh - 330px);
    }
  </style>
</head>
<body>
  <div id="divMain">
    <div id="divTop"><?php print menu_bar(); ?></div>
    <div id="divBottom">
      <div id="divDetails">
        <center>
          <h3 align="center">Contact US</h3>
          <p>Swing by for a cup of coffee, or leave us a message:</p>
          <label class="labelinputbox">Full Name</label>
          <input class="inputbox" placeholder="Full Name">
          <label class="labelinputbox">Phone Number</label>
          <input class="inputbox" placeholder="Phone">
          <label class="labelinputbox">Email</label>
          <input class="inputbox" placeholder="Email">
          <br>
          <button>Submit</button>
        </center>
      </div>
      <?php print footer(); ?>
    </div>
  </div>
</body>
</html>