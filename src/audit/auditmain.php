<!-- 
  The MIT License (MIT)
  Copyright (c) 2022 Hugo Rival (https://codepen.io/Liverus/pen/poRVZLJ)
 -->
<?php
  session_start();
  $adminname = $_SESSION['adminname'];
  $adminid = $_SESSION['adminid'];
  $superadmin = $_SESSION['superadmin'];
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Audit</title>
  <link rel="stylesheet" href="./style.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> 
  <link href="https://fonts.googleapis.com/css2?family=Sen&display=swap" rel="stylesheet"> 
  <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Sen&display=swap" rel="stylesheet"> 
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>
  <link rel="stylesheet" href="./style_5.css">
  <link rel="stylesheet" href="./style_4.css">
  <link rel="stylesheet" href="./style_2.css">
  <link rel="stylesheet" href="./style_3.css">
  <style>
    input[type='submit'] {font-size: 16px; color: crimson; background-color: #fff; border: none; padding: 10px 20px; border-radius: 5px; font-family: 'Courier New', Courier, monospace; font-weight: bold; }
  </style>
</head>
<body>
  <a id="container_home" href="../main/main.php">
    <div class="rond"></div>
    <div class="rondlogo" id="rondhome"></div>
  </a>
  <?php
    if ($_GET)
      {
  ?>
  <div>
      <p style="color:red; text-align:center; line-height:70px"><?php echo $_GET['msg'];?></p>
  </div>
  <?php
      }
  ?>
  <div class="app">
    <!-- 
    People Table
     -->
    <div class="main">
      <div class="main-header" align="center">
        Database
      </div>
      <br>
      <br>
      <div class="main-body">
        <form name="database" method="POST" action="dbaction.php">
          <div class="main-body-row">
              <select name="databasename" id="databasename" style="width: 200px;">
                <option value="people_at">People</option>
                <option value="vehicle_at">Vehicle</option>
                <option value="incident_at">Incident</option>
                <option value="admin_at">Admin</option>
                <option value="fines_at">Fines</option>
                <option value="offence_at">Offence</option>
                <option value="officer_at">Officer</option>
              </select>
          </div>
          <br>
          <div class="main-body-row"> 
            <button type="submit" class="button3 alternative" id="DatabaseSearch">Search</button>
          </div>
        </form>
      </div>
    </div>

    <!-- 
    User
     -->
    <div class="main">
      <div class="main-header" align="center">
        User
      </div>
      <div class="main-body">
        <form name="user" method="POST" action="useraction.php">
          <div class="main-body-row">
            <div>
              <div type="text" font-size: 10px></div>
            </div>
          </div>
          <br>
          <div class="main-body-row">
            <div class="main-body-row-container">
              <span class="material-icons">person</span>
              <input class="main-body-input" type="text" placeholder="username" name="username" id="username"></input>
            </div>
          </div>
          <br>
          <br>
          <div class="main-body-row"> 
            <button type="submit" class="button3 alternative" id="UserSearch">Search</button>
          </div>
        </form>
      </div>
    </div>

    <!-- 
      Date
      -->
    <div class="main">
      <div class="main-header" align="center">
        Date
      </div>
      <div class="main-body">
        <form name="date" method="POST" action="dateaction.php">
          <div class="main-body-row">
            <div>
              <div type="text" font-size: 10px>Start Date - End Date</div>
            </div>
          </div>
          <div class="main-body-row">
            <div class="main-body-row-container">
              <span class="material-icons">calendar_month</span>
              <input class="main-body-input" type="date" name="startdate" id="startdate"></input>
              <input class="main-body-input" type="date" name="enddate" id="enddate"></input>
            </div>
          </div>
          <br>
          <br>
          <div class="main-body-row"> 
            <button type="submit" class="button3 alternative" id="DateSearch">Search</button>
          </div>
        </form>
      </div>
    </div>
  </div>  
</body>
</html>
