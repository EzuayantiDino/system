<?php
  include "server/setup.php";
  include "menu_bar.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home</title>
  <link rel="icon" href="images/logo.jpg" type="image/x-icon">
  <meta charset="UTF-8">
  <meta name="description" content="NabilahJamilHijab Homepage">
  <meta name="keywords" content="HTML, meta tag, hijab">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="design.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="footer.css" />
  <link rel="stylesheet" type="text/css" href="slide.css" />
  <link rel="stylesheet" type="text/css" href="photo.css" />
  <link rel="stylesheet" type="text/css" href="whatsapp.css" />

  <!-- overwrite all css -->
  <link rel="stylesheet" type="text/css" href="setup.css" />
</head>
<style>

.box {
  float: left;
  width: 50%;
  padding: 50px;
}

.clearfix::after {
  content: "";
  clear: both;
  display: table;
}
</style>
<body>
  <?php print menu_bar(); ?>

<div class="slideshow-container">

<div class="mySlides fade">
  <center><img src="images/slide.jpg" style="width:80% height:100%"></center>
</div>

<div class="mySlides fade">
  <center><img src="images/slide1.jpg" style="width:80% height:5%"></center>
</div>

<div class="mySlides fade">
  <center><img src="images/slide2.jpg" style="width:80% height:5%"></center>
</div>

</div>

<div class="mySlides fade">
  <center><img src="images/slide3.jpg" style="width:80% height:5%"></center>
</div>

</div>
<br>

<div style="text-align:center">
  <span class="dot"></span> 
  <span class="dot"></span> 
  <span class="dot"></span> 
</div>

<script>
var slideIndex = 0;
showSlides();

function showSlides() {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
  setTimeout(showSlides, 2000); // Change image every 2 seconds
}
</script>

<br>

<section style="padding-bottom:170px;">
<h2 align="center">Our Collection</h2>
<center>
<div class="row">
  <div class="column">
   <div class="container">
  <img src="images/mekar.jpg" class="image" style="width:95%">
  <div class="middle">
    <a href="thaliapleatedshawl.html"><div class="text">Buy Now</div></a>
  </div>
</div>
  <h4>Mekar</h4>
  <p>Tudung Bawal Corak Bidang 45</p>
  </div>
  <div class="column">
    <div class="container">
  <img src="images/flora.jpg" class="image" style="width:100%">
  <div class="middle">
    <a href="mileasquare.html"><div class="text">Buy Now</div></a>
  </div>
</div>
  <h4>Flora</h4>
  <p>Tudung Bawal Corak Bidang 45</p>
  </div>
  <div class="column">
   <div class="container">
  <img src="images/FB.jpg" alt="Avatar" class="image" style="width:90%">
  <div class="middle">
    <a href="lunasatinsilk.html"><div class="text">Buy Now</div></a>
  </div>
</div>
  <h4>Cotton Corak FB</h4>
  <p>Bawal Cotton Bidang 45</p>
  </div>
  <div class="column">
   <div class="container">
  <img src="images/lailapremium.jpg" alt="Avatar" class="image" style="width:101%">
  <div class="middle">
    <a href="sericottonsquare.html"><div class="text">Buy Now</div></a>
  </div>
</div>
<h4>Laila Premium B45</h4>
<p>Bawal Cotton B45</p>
  </div>
</div>
</center>
</section>
<hr>
<section>
<center>
<h2 align="center">Let's Watch</h2>
<div class="clearfix">
  <div class="box" style="background-color:white">
  <center>
<h2><u><p class="mix"><span> Collection Montage  </p></u></h2></span>
<video width="300" height="300" controls>
     <source src="video.MP4" type="video/MP4">
</center>
  </div>
  <div class="box" style="background-color:white">
  <center>
<h2><u><p class="mix"><span> Pro Tips About Hijab  </p></u></h2></span>
<video width="300" height="300" controls>
     <source src="video1.MP4" type="video/MP4">
</center>
  </div>
</div>
</section>

<hr>
<section>
<h2 align="center">Outlet</h2>
<center>
  <p>No 18, (Bawah) , Jalan Cempaka 1,Taman Cempaka 1,</p>
  <p>Taman Bunga Cempaka, Jln Serom 5, </p>
  <p>84410 Tangkak, Johor</p>
   <br>
  <h3>Open Hours</h3>
  <p>Everday - 9:00 am - 9:00 pm</p>

<div class="mapouter"><div class="gmap_canvas">
<iframe width="800" height="300" id="gmap_canvas" src="images/nabilahlocation.PNG" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
<a href="https://123movies-to.org">123movies</a><br><style>.mapouter{position:relative;text-align:right;height:300px;width:800px;}</style><a href="https://www.embedgooglemap.net">map widgets for websites</a><style>.gmap_canvas {overflow:hidden;background:none!important;height:300px;width:800px;}</style></div></div>
</center>
</section>

<a href="https://api.whatsapp.com/send?phone=60103841178&text=Hi%20there%3F%20We%20are%20here%20to%20help.%20Chat%20with%20us%20on%20WhatsApp%20for%20any%20questions%20and%20enquiry." class="float" target="_blank">
<i class="fa fa-whatsapp my-float"></i>
</a>


<footer class="footer-distributed">

			<div class="footer-left">
          <img src="images/logo.jpg">
				<h3>NabilahJamil<span>Hijab</span></h3>

				<p class="footer-links">
					<a href="index.php">Home</a>
					|
					<a href="aboutus.php">About</a>
					|
					<a href="contact.php">Contact</a>
				</p>

				<p class="footer-company-name">© 2024 NabilahJamilHijab</p>
			</div>

			<div class="footer-center">
				<div>
					<i class="fa fa-map-marker"></i>
		       <p><span>No 18, (Bawah) , Jalan Cempaka 1,Taman Cempaka 1, 
              Taman Bunga Cempaka, Jln Serom 5, 84410 Tangkak, Johor</p>
				</div>

				<div>
					<i class="fa fa-phone"></i>
					<p>+04-502 2900</p>
				</div>
				<div>
					<i class="fa fa-envelope"></i>
					<p><a href="https://mail.google.com/mail/u/0/?ogbl#search/msyeyna01%40gmail.com" target="_blank">NabilahJamil@gmail.com</a></p>
				</div>
			</div>
			<div class="footer-right">
				<p class="footer-company-about">
					<span>About the company</span>
					We provide various types of beautiful hijabs for you.</p>
				<div class="footer-icons">
					<a href="https://api.whatsapp.com/send?phone=60103841178&text=Hi%20there%3F%20We%20are%20here%20to%20help.%20Chat%20with%20us%20on%20WhatsApp%20for%20any%20questions%20and%20enquiry." target="_blank"><i class="fa fa-whatsapp"></i></a>
					<a href="https://shopee.com.my/msyeyna?smtt=0.0.9" target="_blank"><i class="fa fa-shopping-cart"></i></a>
					<a href="https://www.instagram.com/ainahijab.hq/?utm_medium=copy_link" target="_blank"><i class="fa fa-instagram"></i></a>
				</div>
			</div>
		</footer>



</body>
</html>
