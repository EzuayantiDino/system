<html>
<head>
  <title>Payment Gateway</title>
  <style>
    body {
      font-family: Arial;
      background: lightgray;
      display: flex;
      align-items: center;
      justify-content: center
    }

    #divMain {
      width: 400px;
      background: white;
      padding: 20px;
      border-radius: 10px;
    }

    #divDetails {
      display: flex;
      gap: 10px;
      background: lightgray;
      padding: 20px;
      border-radius: 10px;
    }

    button {
      display: block;
      margin: auto;
      color: white;
      background-color: orange;
      border-radius: 5px;
      font-size: 15px;
      font-family: Arial;
      padding: 6px 15px;
      border: none;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <div id="divMain">
    <h2 align="center">Demo Payment Gateway</h2>
    <div id="divDetails">
      <div style="text-align:right;font-weight:bold;">From Account:<br>Merchant Name:<br>Payment Reference:<br>FPX Transaction ID:<br>Amount:</div>
      <div>43216542056<br>Nabilah Jamil Hijab<br>OSD-4598978598<br>24694998257967<br>RM123</div>
    </div>
    <span>*Payment successful</span>
    <button onclick="back()">Back to Page</button>
  </div>
</body>
<script>
  function back() {
    location.replace("index.php");
  }
</script>
</html>