<!-- 
The MIT License (MIT)

Copyright (c) 2022 ssbalakumar (https://codepen.io/ssbalakumar/pen/bGwwaG)
Copyright (c) 2022 harish bhavanichikar (https://codepen.io/harish2rock/pen/mRVWwB)

-->
<?php
    session_start();
    $adminname = $_SESSION['adminname'];
    $adminid = $_SESSION['adminid'];
    require("../../config/db.inc.php");
    $mysqli = new mysqli($servername, $username, $password, $dbname);
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>New Vehicle</title>
  <link rel="stylesheet" href="./style_2.css">
  <link rel="stylesheet" href="./style_3.css">
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css"> -->
  <link rel="stylesheet" href="./style_4.css">
  

</head>
<a id="container_home" href="../main/main.php">
    <div class="rond"></div>
    <div class="rondlogo" id="rondhome"></div>
</a>
<body style="background-color:#0CF;">
<div class="container">  
  <form id="contact" action="newofficeraction.php" method="POST" style="background-color: whitesmoke ;">
    <h3 align='center'>New Officer</h3>
    <h4 align='center'>Add details of new officer</h4>
    <?php
      if ($_GET)
      {
    ?>
    <div>
        <p class="text-danger text-center"><?php echo $_GET['msg'];?></p>
    </div>
    <?php
      }
    ?>
    <fieldset>
      <input placeholder="Name" type="text" tabindex="1" id="officername" name="officername" required autofocus>
    </fieldset>
    <fieldset>
      <input placeholder="Staff ID" type="text" tabindex="1" id="staffid" name="staffid" required autofocus>
    </fieldset>
    <fieldset>
      <button name="submit" type="submit" id="AddNewOfficer" data-submit="...Sending">Submit</button>
    </fieldset>
  </form>
</div>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js'></script>
<script  src="./script.js"></script>
</body>
</html>
