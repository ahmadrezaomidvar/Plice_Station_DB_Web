<?php
  session_start();
  $username = $_SESSION['adminname'];
?>

<!-- 
The MIT License (MIT)

Copyright (c) 2022 Nodws (https://codepen.io/nodws/pen/owVpGV)

-->

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Change Password</title>
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'><link rel="stylesheet" href="./style_6.css">
  <link rel="stylesheet" href="./style.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> 
  <link href="https://fonts.googleapis.com/css2?family=Sen&display=swap" rel="stylesheet"> 
  <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Sen&display=swap" rel="stylesheet"> 

</head>
<body>
<a id="container_home" href="../main/main.php">
    <div class="rond"></div>
    <div class="rondlogo" id="rondhome"></div>
</a>
<div id="box">
  <form id="myform-search" method="post" autocomplete="off" action="passaction.php">
  <h1>Change Password</h1>
  <?php
    if ($_GET)
    {
  ?>
  <div>
    <p style="color:red" align='center' color='red'><?php echo $_GET['msg'];?></p>
  </div>
  <?php
    }
  ?>
  <form>
    <p>
      <input type="password" value="" placeholder="Enter New Password" id="p" name="p" class="password" required>
      <button class="unmask" type="button"></button>
    </p>
    <p>     
      <input type="password" value="" placeholder="Confirm Password" id="p-c" name="p-c" class="password" required>
      <button class="unmask" type="button"></button>
    <!-- <small>Must be 6+ characters long and contain at least 1 upper case letter, 1 number, 1 special character</small> -->
      <div class="main-body-row"> 
        <button type="submit" class="button3 alternative" id="save">Save</button>
        <a type="submit" class="button3 alternative" id="cancel" href='../main/main.php' style="background-color: gray; text-decoration: none;">Cancel</a>
      </div>
      <!-- <div id="strong"><span></span></div> -->
      <div id="valid"></div>
    </p>
  </form>
</div>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script><script  src="./script.js"></script>

</body>
</html>
