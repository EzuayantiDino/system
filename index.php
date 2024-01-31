<?php
  include "server/setup.php";
  include "server/product.class.php";
  include "menu_bar.php";
  include "footer.php";
  
  $product = new product();
?>
<html>
<head>
  <title>Home</title>
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

    #divCategory {
      display: block;
      margin-top: 20px;
      width: 100vw;
    }

    #divCategoryList {
      display: flex;
      gap: 20px;
      justify-content: center;
      overflow-x: auto;
    }

    .category_card {
      width: 250px;
    }

    .category_img {
      height: 250px;
      width: 250px;
      object-fit: cover;
      border-radius: 10px;
    }

    .category_p {
      margin: 5px;
      text-align: center;
      font-size: 20px;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div id="divMain">
    <div id="divTop"><?php print menu_bar(); ?></div>
    <div id="divBottom">
      <div id="divPoster">
        <img class="img_poster" src="images/slide3.jpg">
      </div>
      <div id="divCategory">
        <h1 align="center">Our Collection</h1>
        <br><br>
        <div id="divCategoryList">
          <?php print $product->html_category_list(); ?>
        </div>
        
      </div>
      <br><br><hr>
      <div>
        <h2 align="center">Outlet</h2>
        <center>
          <p>No 18, (Bawah) , Jalan Cempaka 1,Taman Cempaka 1,</p>
          <p>Taman Bunga Cempaka, Jln Serom 5, </p>
          <p>84410 Tangkak, Johor</p>
          <br>
          <h3>Open Hours</h3>
          <p>Everday - 9:00 am - 9:00 pm</p>
          <img style="width:70vw;" src="images/nabilahlocation.PNG">
        </center>
      </div>
      <br><br>
      <?php print footer(); ?>
    </div>
  </div>
</body>

<script>
  function open_category(category) {
    location.replace("product.php?category="+category);
  }
</script>
</html>