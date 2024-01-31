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
  <title>About US</title>
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
      margin-top: 20px;
      width: 100vw;
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
          <img src="aboutus.jpg" width="50%" border="1">
          <br>
          <h3 align="center">Our Business</h3>
          <ul type="square" style="width:fit-content">
          <p align="justify">Welcome to Nabilah Jamil Hijab, where elegance meets modesty. 
            Founded with a passion for empowering Muslim women to embrace their cultural identity,
            we specialize in offering a curated collection of hijabs and scarves that effortlessly 
            blend style and tradition. At Nabilah Jamil Hijab, we believe in the transformative power 
            of fashion, and our carefully crafted designs aim to celebrate the diversity and beauty of 
            every woman. With a commitment to quality and authenticity, our hijabs are made from premium 
            fabrics, ensuring both comfort and durability. As a brand, we strive to inspire confidence 
            and individuality while fostering a sense of community among our customers. Join us on this 
            journey of self-expression and discover the perfect accessory to complement your personal 
            style at Nabilah Jamil Hijab.</p>
          </ul>

          <h3 align="center">Our Vision</h3>
          <ul type="square" style="width:fit-content">
            <li>To convey that women should feel proud and happy to wear scarves.</li>
          </ul>

          <br>
          <h3>Our Mission</h3>
          <ul type="square" style="width:fit-content">
            <li>To make high-quality hijabs accessible to all women</li>
            <li>To offer women affordable and stylish headwear options, allowing them to express individuality.</li>
            <li>Empowering women with trendy headwear that boosts confidence and complements personal fashion choices.</li>
          </ul>

          <br>
          <h3 align="center">Operation Hours</h3>
          <p>"OPEN EVERY DAY 9 AM - 9 PM"<br>
          Monday	9 am–9 pm<br>
          Tuesday	9 am–9 pm<br>
          Wednesday 9 am–9 pm<br>
          Thursday 9 am–9 pm<br>
          Friday 9 am–9 pm<br>
          Saturday 9 am–9 pm<br>
          Sunday	9 am–9 pm</p>
          
          <br>
          <h3 align="center">Location</h3>
          <img src="images/store.jpg" width="60%" border="1">
          <p>No 18, (Bawah) , Jalan Cempaka 1,<br>Taman Bunga Cempaka, Jln Serom 5,<br>84410 Tangkak, Johor</p>
          

          <br>
          <h3 align="center">Let's Connect</h3>
          <a href="https://www.instagram.com/nabilahjamillhijab/" target="_blank" class="divFooter_btn_icon"><img src="resources/icons/instagram.svg" class="divFooter_icon"></a>
          <a href="https://www.tiktok.com/@nabilahjamilhijab?is_from_webapp=1&sender_device=pc" target="_blank" class="divFooter_btn_icon"><img src="resources/icons/tiktok.svg" class="divFooter_icon"></a>
          <a href="tel:601116169806" target="_blank" class="divFooter_btn_icon"><img src="resources/icons/phone.svg" class="divFooter_icon"></a>


          <br><br><br>
          <h3 align="center">Our Tagline</h3>
          <p>"Ronyok ronyok ronyok, tudung tetap onpoint, mantap"</p>

        </center>
        <br><br><br>
      </div>
      <?php print footer(); ?>
    </div>
  </div>
</body>
</html>