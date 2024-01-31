<?php
  include "server/setup.php";
  include "menu_bar.php";
  include "server/product.class.php";
  session_start();
  protection("owner");
  
  $product = new product();
?>
<html>
<head>
  <title>Product Master</title>
  <link rel="icon" href="images/logo.jpg" type="image/x-icon">
  <link rel="stylesheet" type="text/css" href="setup.css"/>
  <script src="jquery/jquery.js"></script>
  <script src="setup.js"></script>
  <style>
    #divCreateProduct_container {
      width: 600px;
    }

    #divEditProduct_container {
      width: 600px;
      height: calc(100vh - 100px);
      overflow: auto;
    }

    #divManageCategory_container {
      width: 400px;
      max-height: calc(100vh - 100px);
      overflow: auto;
    }

    #divMediaList {
      display: flex;
      gap: 10px;
      flex-wrap: wrap;
      padding: 10px;
      margin-top: 10px;
      border: 1px solid black;
      border-radius: 7px;
    }

    .img-media {
      height: 150px;
      width: 150px;
      object-fit: cover;
      border-radius: 7px;
    }
  </style>
</head>
<body>
  <div id="divMain">
    <div id="divTop"><?php print menu_bar(); ?></div>
    <div id="divBottom" style="padding:20px;">
      <div id="divCreateProduct" class="overlay">
        <div id="divCreateProduct_container" class="overlay-container">
          <h2>Add New Product</h2>
          <h3 style="margin-top:10px;">Product Details</h3>
          <div style="display:flex;gap:10px;">
            <div style="flex:4;">
              <label class="labelinputbox">Product Name</label>
              <input id="input_create_title" class="inputbox" autocomplete="off">
            </div>
          </div>
          <div style="display:flex;gap:10px;">
            <div style="">
              <label class="labelinputbox">Category / Collection</label>
              <select id="input_create_category" class="inputbox"><?php print $product->option_category(); ?></select>
            </div>
            <div style="flex:1;">
              <label class="labelinputbox">Price</label>
              <input id="input_create_price" type="number" class="inputbox" autocomplete="off">
            </div>
            <div style="flex:1;">
              <label class="labelinputbox">Discount</label>
              <input id="input_create_discount" type="number" class="inputbox" autocomplete="off">
            </div>
          </div>
          <label class="labelinputbox">About</label>
          <div id="input_create_about" class="inputbox" style="width:calc(100% - 16px);min-height:100px;" contenteditable="true"></div>
          <div style="display:flex;gap:10px;margin-top:10px;">
            <button onclick="create_product()">Add New Product</button>
            <button class='btn-cancel' onclick="close_divCreateProduct()">Cancel</button>
          </div>
        </div>
      </div>
      <div id="divEditProduct" class="overlay">
        <div id="divEditProduct_container" class="overlay-container">
          <h2>Edit Product</h2>
          <h3 style="margin-top:10px;">Product Details</h3>
          <div style="display:flex;gap:10px;">
            <div style="flex:1;">
              <label class="labelinputbox">Rowid</label>
              <input id="input_edit_rowid" class="inputbox" autocomplete="off" readonly>
            </div>
            <div style="flex:4;">
              <label class="labelinputbox">Product Name</label>
              <input id="input_edit_title" class="inputbox" autocomplete="off">
            </div>
          </div>
          <div style="display:flex;gap:10px;">
            <div style="">
              <label class="labelinputbox">Category / Collection</label>
              <select id="input_edit_category" class="inputbox"><?php print $product->option_category(); ?></select>
            </div>
            <div style="flex:1;">
              <label class="labelinputbox">Price</label>
              <input id="input_edit_price" type="number" class="inputbox" autocomplete="off">
            </div>
            <div style="flex:1;">
              <label class="labelinputbox">Discount</label>
              <input id="input_edit_discount" type="number" class="inputbox" autocomplete="off">
            </div>
          </div>
          <label class="labelinputbox">About</label>
          <div id="input_edit_about" class="inputbox" style="width:calc(100% - 16px);min-height:100px;" contenteditable="true"></div>
          <div style="display:flex;gap:10px;margin-top:10px;">
            <button onclick="update_product()">Save Changes</button>
            <button class='btn-cancel' onclick="$('#divEditProduct').css('display','none')">Cancel</button>
          </div>

          <h3 style="margin-top:20px;">Product Media</h3>
          <input type="file" id="input_edit_file" name="file" onchange="validateFileType()">
          <button onclick="upload_image()">Upload</button>
          <div id="divMediaList"></div>

          <h3 style="margin-top:20px;">Product Type</h3>
          <div style="display:flex;gap:10px;align-items:flex-end;">
            <div style="flex:1;">
              <label class="labelinputbox">Rowid</label>
              <input id="input_type_rowid" class="inputbox" readonly>
            </div>
            <div style="flex:2;">
              <label class="labelinputbox">Type Name</label>
              <input id="input_type_name" class="inputbox" autocomplete="off">
            </div>
            <button style="height:33px;" onclick="create_type()">Save</button>
          </div>
          
          
          <table id="table_type_list" class="table1" style="margin-top:15px;"></table>
        </div>
      </div>
      <div id="divManageCategory" class="overlay">
        <div id="divManageCategory_container" class="overlay-container">
          <h2>Manage Category / Collection  <span style="color:red;cursor:pointer;" onclick="$('#divManageCategory').css('display','none');">X</span></h2>
          <div style="display:flex;gap:10px;align-items:flex-end;">
            <div style="flex:1;">
              <label class="labelinputbox">Category Name</label>
              <input type="hidden" id="input_category_old" class="inputbox" autocomplate="off">
              <input id="input_category" class="inputbox" autocomplate="off">
            </div>
            <button style="height:33px;" class="create_category" onclick="create_category()">Add</button>
            <button style="height:33px;" class="edit_category" onclick="update_category()" hidden>Update</button>
            <button style="height:33px;" class="edit_category" onclick="close_edit_category()" hidden>Cancel</button>
          </div>
          <table id="table_category_list" class="table1" style="margin-top:20px;"></table>
        </div>
      </div>
      <button onclick="$('#divCreateProduct').css('display','flex');">Add New Product</button>
      <button onclick="open_divManageCategory()">Manage Category / Collection</button>
      <table id="table_product_list" class='table1' style="margin-top:20px;">
        <?php print $product->html_table_product_list(); ?>
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

  function open_divManageCategory() {
    loadingStart();
    var data = {};
    data['action'] = "get_table_category"; 
    $.ajax({
      url: 'server/product.php',
      type: 'post',
      data: data,
      dataType: 'JSON',
      success: function(response) {
        console.log(response);
        if(response.result) {
          $("#table_category_list").html(response.gui_table_category);
        }
        loadingEnd();
      }        
    });
    $('#divManageCategory').css('display','flex');
  }

  function edit_category(category) {
    $("#input_category_old").val(category);
    $("#input_category").val(category);
    $(".edit_category").show();
    $(".create_category").hide();
  }

  function close_edit_category() {
    $("#input_category_old").val("");
    $("#input_category").val("");
    $(".edit_category").hide();
    $(".create_category").show();
  }

  function create_category() {
    if($("#input_category").val() == "") {
      alert("Please Fill in category input field");
      return false;
    }
    loadingStart();
    var data = {};
    data['action'] = "create_category"; 
    data['category'] = $("#input_category").val(); 
    $.ajax({
      url: 'server/product.php',
      type: 'post',
      data: data,
      dataType: 'JSON',
      success: function(response) {
        console.log(response);
        if(response.result) {
          $("#table_category_list").html(response.gui_table_category);
          $("#input_create_category").html(response.gui_option_category);
          $("#input_edit_category").html(response.gui_option_category);
        }
        loadingEnd();
      }        
    });
  }

  function update_category() {
    if($("#input_category").val() == "") {
      alert("Please Fill in category input field");
      return false;
    }
    loadingStart();
    var data = {};
    data['action'] = "update_category"; 
    data['new'] = $("#input_category").val(); 
    data['old'] = $("#input_category_old").val(); 
    $.ajax({
      url: 'server/product.php',
      type: 'post',
      data: data,
      dataType: 'JSON',
      success: function(response) {
        console.log(response);
        if(response.result) {
          $("#table_category_list").html(response.gui_table_category);
          $("#input_create_category").html(response.gui_option_category);
          $("#input_edit_category").html(response.gui_option_category);
          $("#table_product_list").html(response.gui_table_product);
        }
        close_edit_category();
        loadingEnd();
      }        
    });
  }

  function delete_category(category) {
    if(confirm("Confirm to delete Category: " + category) == true) {
      loadingStart();
      var data = {};
      data['action'] = "delete_category";
      data['category'] = category;
      console.table(data);
      $.ajax({
        url: 'server/product.php',
        type: 'post',
        data: data,
        dataType: 'JSON',
        success: function(response) {
          console.log(response);
          if(response.result) {
            $("#table_category_list").html(response.gui_table_category);
            $("#input_create_category").html(response.gui_option_category);
            $("#input_edit_category").html(response.gui_option_category);
            $("#table_product_list").html(response.gui_table_product);
          }
          loadingEnd();
        }        
      });
    } else {
      console.log("Cancel delete type rowid: " + category);
    }
  }

  function create_product() {
    if(create_product_validation()) {
      loadingStart();
      var data = {};
      data['action'] = "create_product";
      data['title'] = $("#input_create_title").val();
      data['category'] = $("#input_create_category").val();
      data['price'] = $("#input_create_price").val();
      data['discount'] = $("#input_create_discount").val();
      data['about'] = $("#input_create_about").html();
      $.ajax({
        url: 'server/product.php',
        type: 'post',
        data: data,
        dataType: 'JSON',
        success: function(response) {
          console.log(response);
          if(response.result) {
            $("#table_product_list").html(response.gui_table_product);
            close_divCreateProduct();
          }
          loadingEnd();
        }        
      });
    } else {
      alert("Please fill all input");
    }
  }

  function create_product_validation() {
    if($("#input_create_title").val() == "") {
      alert("Please fill in Product Name input field");
      return false;
    }
    if($("#input_create_category").val() == "") {
      return false;
    }
    if($("#input_create_price").val() == "") {
      alert("Please fill in Price input field");
      return false;
    }

    return true;
  }

  function close_divCreateProduct() {
    $("#input_create_title").val("");
    $("#input_create_category").val("");
    $("#input_create_price").val("");
    $("#input_create_about").html("");
    $("#divCreateProduct").css("display","none");
  }

  function edit_product(rowid) {
    loadingStart();
    var data = {};
    data['action'] = "get_product_details";
    data['rowid'] = rowid;    
    $.ajax({
      url: 'server/product.php',
      type: 'post',
      data: data,
      dataType: 'JSON',
      success: function(response) {
        console.log(response);
        if(response.result) {
          $("#input_edit_rowid").val(response.details.rowid);
          $("#input_edit_title").val(response.details.title);
          $("#input_edit_category").val(response.details.category);
          $("#input_edit_price").val(response.details.price);
          $("#input_edit_discount").val(response.details.discount);
          $("#input_edit_about").html(response.details.about);
          $("#divMediaList").html(response.gui_media_list);
          $("#table_type_list").html(response.gui_table_type);
        }
        loadingEnd();
      }        
    });
    $("#divEditProduct").css("display","flex");
  }

  function update_product() {
    if(update_product_validation()) {
      loadingStart();
      var data = {};
      data['action'] = "update_product";
      data['rowid'] = $("#input_edit_rowid").val();
      data['title'] = $("#input_edit_title").val();
      data['category'] = $("#input_edit_category").val();
      data['price'] = $("#input_edit_price").val();
      data['discount'] = $("#input_edit_discount").val();
      data['about'] = $("#input_edit_about").html();
      $.ajax({
        url: 'server/product.php',
        type: 'post',
        data: data,
        dataType: 'JSON',
        success: function(response) {
          console.log(response);
          if(response.result) {
            $("#table_product_list").html(response.gui_table_product);
            $("#divEditProduct").css("display","none");
          }
          loadingEnd();
        }        
      });
    } else {
      alert("Please fill all input");
    }
  }

  function update_product_validation() {
    if($("#input_edit_title").val() == "") {
      alert("Please fill in Product Name input field");
      return false;
    }
    if($("#input_edit_category").val() == "") {
      return false;
    }
    if($("#input_edit_price").val() == "") {
      alert("Please fill in Price input field");
      return false;
    }

    return true;
  }

  function delete_product(rowid) {
    if (confirm("Confirm to delete Product Rowid: " + rowid) == true) {
      var data = {};
      data['action'] = "delete_product";
      data['rowid'] = rowid;
      $.ajax({
        url: 'server/product.php',
        type: 'post',
        data: data,
        dataType: 'JSON',
        success: function(response) {
          console.log(response);
          if(response.result) {
            $("#table_product_list").html(response.gui_table_product);
          }
          loadingEnd();
        }        
      });
    } else {
      console.log("Cancel delete Product Rowid: " + rowid);
    }
  }

  function add_media(filename) {
    loadingStart();
    var data = {};
    data['action'] = "add_media";
    data['rowid'] = $("#input_edit_rowid").val();
    data['filename'] = filename;
    $.ajax({
      url: 'server/product.php',
      type: 'post',
      data: data,
      dataType: 'JSON',
      success: function(response) {
        console.log(response);
        if(response.result) {
          $("#divMediaList").html(response.gui_media_list);
        }
        loadingEnd();
      }        
    });
  }

  function upload_image() {
    if(document.getElementById("input_edit_file").files.length == 0 ){
      alert("Please choose your file");
    } else {
      console.log("Start upload");
      loadingStart();
      var fd = new FormData();
      var files = $('#input_edit_file')[0].files[0];
      fd.append('file',files);
      $.ajax({
        url: 'resources/products/manager.php',
        type: 'post',
        data: fd,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(response){
          loadingEnd();
          console.log(response);
          if(response.result){
            add_media(response.filename);
            $('#input_edit_file').val("");
          } else {
            alert('file not uploaded');
          }
        },
      }); 
    }
  }

  function validateFileType() {
    var selectedFile = document.getElementById('input_edit_file').files[0];
    console.log(selectedFile.type);
    var allowedTypes = ['image/jpeg', 'image/jpg', 'image/png','image/svg+xml', 'application/pdf'];

    if(!allowedTypes.includes(selectedFile.type)) {
      alert('Invalid file type. Please upload a JPEG, PNG, or PDF file.');
      document.getElementById('input_edit_file').value = '';
    }
  }

  function delete_media(rowid) {
    if (confirm("Confirm to delete Media: " + rowid) == true) {
      loadingStart();
      var data = {};
      data['action'] = "delete_media";
      data['rowid'] = $("#input_edit_rowid").val();
      data['media_rowid'] = rowid;
      $.ajax({
        url: 'server/product.php',
        type: 'post',
        data: data,
        dataType: 'JSON',
        success: function(response) {
          console.log(response);
          if(response.result) {
            $("#divMediaList").html(response.gui_media_list);
          }
          loadingEnd();
        }        
      });
    } else {
      console.log("Cancel delete media: " + rowid);
    }
  }

  function create_type() {
    if($("#input_type_rowid").val() != "") {
      update_type();
      return false;
    }
    if($("#input_type_name").val() == "") {
      alert("Please Fill in Type Name input field");
      return false;
    }
    loadingStart();
    var data = {};
    data['action'] = "create_type";
    data['rowid'] = $("#input_edit_rowid").val();
    data['type_name'] = $("#input_type_name").val();
    $.ajax({
      url: 'server/product.php',
      type: 'post',
      data: data,
      dataType: 'JSON',
      success: function(response) {
        console.log(response);
        if(response.result) {
          $("#table_type_list").html(response.gui_table_type);
          $("#input_type_name").val("");
        }
        loadingEnd();
      }        
    });
  }

  function edit_type(rowid) {
    loadingStart();
    $("#input_type_rowid").val(rowid);
    var data = {};
    data['action'] = "get_type_name";
    data['type_rowid'] = rowid;
    console.table(data);
    $.ajax({
      url: 'server/product.php',
      type: 'post',
      data: data,
      dataType: 'JSON',
      success: function(response) {
        console.log(response);
        if(response.result) {
          $("#input_type_name").val(response.type_name);
        }
        loadingEnd();
      }        
    });
  }

  function update_type() {
    if($("#input_type_name").val() == "") {
      alert("Please Fill in Type Name input field");
      return false;
    }
    loadingStart();
    var data = {};
    data['action'] = "update_type";
    data['type_rowid'] = $("#input_type_rowid").val();
    data['type_name'] = $("#input_type_name").val();
    $.ajax({
      url: 'server/product.php',
      type: 'post',
      data: data,
      dataType: 'JSON',
      success: function(response) {
        console.log(response);
        if(response.result) {
          $("#table_type_list").html(response.gui_table_type);
          $("#input_type_rowid").val("");
          $("#input_type_name").val("");
        }
        loadingEnd();
      }        
    });
  }

  function delete_type(rowid) {
    if (confirm("Confirm to delete Type: " + rowid) == true) {
      loadingStart();
      var data = {};
      data['action'] = "delete_type";
      data['rowid'] = $("#input_edit_rowid").val();
      data['type_rowid'] = rowid;
      $.ajax({
        url: 'server/product.php',
        type: 'post',
        data: data,
        dataType: 'JSON',
        success: function(response) {
          console.log(response);
          if(response.result) {
            $("#table_type_list").html(response.gui_table_type);
          }
          loadingEnd();
        }        
      });
    } else {
      console.log("Cancel delete type rowid: " + rowid);
    }
  }
</script>
</html>