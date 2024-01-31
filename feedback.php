<?php
  include "server/setup.php";
  include "server/feedback.class.php";
  include "menu_bar.php";
  include "footer.php";
  session_start();
  protection("user");

  $feedback = new feedback();
?>
<html>
<head>
  <title>Feedback</title>
  <link rel="icon" href="images/logo.jpg" type="image/x-icon">
  <link rel="stylesheet" type="text/css" href="setup.css">
  <script src="jquery/jquery.js"></script>
  <script src="setup.js"></script>
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

    .feedback-card {
      margin-top: 10px;
    }
  </style>
</head>
<body>
<div id="divMain">
    <div id="divTop"><?php print menu_bar(); ?></div>
    <div id="divBottom">
      <div id="divDetails">
        <center>
          <h3 align="center">Feedback</h3>
          <p>Give your Feedback</p>
          <label class="labelinputbox">Star</label>
          <select class="inputbox" id="input_star">
            <option>5</option>
            <option>4</option>
            <option>3</option>
            <option>2</option>
            <option>1</option>
          </select>
          <label class="labelinputbox">Comment</label>
          <textarea class="inputbox" rows="5" id="input_comment"></textarea>
          <br>
          <button onclick="submit()">Submit</button>
          <br>
          <div id="div_feedback"><?php print $feedback->html_list_all(); ?></div>
          <br>
        </center>
      </div>
      <?php print footer(); ?>
    </div>
  </div>
</body>
<script>
  function submit() {
    if(validation_form()) {
      var data = {};
      data['action'] = "create";
      data['star'] = $("#input_star").val();
      data['comment'] = $("#input_comment").val();
      $.ajax({
        url: 'server/feedback.php',
        type: 'post',
        data: data,
        dataType: 'JSON',
        success: function(response) {
          console.log(response);
          if(response.result) {
            $("#input_comment").val("");
            $("#div_feedback").html(response.gui);
          }
          loadingEnd();
        }        
      });
    } else {
      alert("Please give your comment");
    }
  }

  function validation_form() {
    if($("#input_star").val() == "") {
      return false;
    }
    if($("#input_comment").val() == "") {
      return false;
    }
    return true;
  }
</script>
</html>