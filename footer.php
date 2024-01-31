<?php
  function footer() {
    $ret_html = "
      <div id='divFooter'>
        <div style='flex:2;'>
          <img style='width:100px' src='images/logo.jpg'>
          <h3 style='font: normal 36px 'Cookie', cursive;'>NabilahJamil<span style='color:#e0ac1c;'>Hijab</span></h3>

          <p class='divFooter_a'>
            <a href='index.php' class='divFooter_a'>Home</a> | <a href='aboutus.php' class='divFooter_a'>About</a> | <a href='contact.php' class='divFooter_a'>Contact</a>
          </p>

          <p class='footer-company-name'>© 2024 NabilahJamilHijab</p>
        </div>

        <div style='flex:3;'>
          <div style='display:flex;gap:10px;'>
            <p class='divFooter_btn_icon'><img src='resources/icons/location.svg' class='divFooter_icon'></p>
            <p><span>No 18, (Bawah) , Jalan Cempaka 1,<br>Taman Cempaka 1, Taman Bunga Cempaka,<br>Jln Serom 5, 84410 Tangkak, Johor</p>
          </div>
          <div style='display:flex;gap:10px;align-items:center;'>
            <p class='divFooter_btn_icon'><img src='resources/icons/phone.svg' class='divFooter_icon'></p>
            <p>+04-502 2900</p>
          </div>
          <div style='display:flex;gap:10px;align-items:center;'>
            <p class='divFooter_btn_icon'><img src='resources/icons/email.svg' class='divFooter_icon'></p>
            <p><a href='https://mail.google.com/mail/u/0/?ogbl#search/msyeyna01%40gmail.com' target='_blank' class='divFooter_a'>NabilahJamil@gmail.com</a></p>
          </div>
        </div>
        <div style='flex:3;'>
          <h3>About the company</h3>
          <p>We provide various types of beautiful hijabs for you.</p>
          <div class='footer-icons'>
            <a href='https://api.whatsapp.com/send?phone=60103841178&text=Hi%20there%3F%20We%20are%20here%20to%20help.%20Chat%20with%20us%20on%20WhatsApp%20for%20any%20questions%20and%20enquiry.' target='_blank' class='divFooter_btn_icon'><img src='resources/icons/whatsapp.svg' class='divFooter_icon'></a>
            <a href='https://shopee.com.my/msyeyna?smtt=0.0.9' target='_blank' class='divFooter_btn_icon'><img src='resources/icons/cart.svg' class='divFooter_icon'></a>
            <a href='https://www.instagram.com/ainahijab.hq/?utm_medium=copy_link' target='_blank' class='divFooter_btn_icon'><img src='resources/icons/instagram.svg' class='divFooter_icon'></a>
          </div>
        </div>
      </div>
    ";   
    
    return $ret_html;
  }

?>