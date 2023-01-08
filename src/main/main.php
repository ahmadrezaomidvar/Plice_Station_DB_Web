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
  <title>Dashboard</title>
  <link rel="stylesheet" href="./style.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> 
  <link href="https://fonts.googleapis.com/css2?family=Sen&display=swap" rel="stylesheet"> 
  <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Sen&display=swap" rel="stylesheet"> 
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'>
  <link rel="stylesheet" href="./style_5.css">
  <style>
    input[type='submit'] {font-size: 16px; color: crimson; background-color: #fff; border: none; padding: 10px 20px; border-radius: 5px; font-family: 'Courier New', Courier, monospace; font-weight: bold; }
  </style>
</head>
<body>
  <div id="navbar" class="collapse navbar-collapse">
    <ul class="nav navbar-nav navbar-user navbar-right">
      <?php
        if ($superadmin) {
          echo '<li><a href="../audit/auditmain.php"><span class="glyphicon glyphicon-th-list"></span> Audit</a></li>';
        }
      ?>
      <li><a href="../security/pass.php"><span class="glyphicon glyphicon-user"></span> Change Password</a></li>
      <li><a href="../security/logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
    </ul>
  </div><!--/.nav-collapse -->
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
        People
      </div>
      <br>
      <br>
      <div class="main-body">
        <form name="people" method="POST" action="../people/peopleaction.php">
          <div class="main-body-row">
            <div class="main-body-row-container">
              <span class="material-icons">person</span>
              <input class="main-body-input" type="text" placeholder="Name" name="peoplename" id="peoplename"></input>
            </div>
          </div>
          <div class="main-body-row">
            <div class="main-body-row-container">
              <span class="material-icons">sticky_note_2</span>
              <input class="main-body-input" type="text" placeholder="Licence Number" name="licence" id="licence"></input>
            </div>
          </div>
          <br>
          <!-- <br>
          <br> -->
          <div class="main-body-row"> 
            <button type="submit" class="button3 alternative" id="PeopleSearch">Search</button>
            <script>
              document.getElementById("PeopleSearch").addEventListener("click", myFunction);
              function myFunction() {
                window.location.href="../people/peopleaction.php";
              }
            </script>
          </div>
        </form>
      </div>
    </div>

    <!-- 
    Vehicle Table
     -->
    <div class="main">
      <div class="main-header" align="center">
        Vehicle
      </div>
      <div class="main-body">
        <form name="vehicle" method="POST" action="mainaction.php">
          <div class="main-body-row">
            <div class="main-body-row-container">
              <input type="submit" class="button3 alternative" value="Add New" id="newvehicle" name="newvehicle" font-size: 14px></input>
            </div>
          </div>
          <div class="main-body-row">
            <div class="main-body-row-container">
              <span class="material-icons">directions_car</span>
              <input class="main-body-input" type="text" placeholder="Plate Number" name="platenumber" id="platenumber"></input>
            </div>
          </div>
          <br>
          <br>
          <br>
          <div class="main-body-row"> 
            <button type="submit" class="button3 alternative" id="VehicleSearch">Search</button>
              <script>
                document.getElementById("VehicleSearch").addEventListener("click", myFunction);
                function myFunction() {
                  window.location.href="../vehicle/vehicleaction.php";
                }
              </script>
          </div>
        </form>
      </div>
    </div>

    <!-- 
      Report Table
      -->
    <div class="main">
      <div class="main-header" align="center">
        Report
      </div>
      <div class="main-body">
        <form name="vehicle" method="POST" action="mainaction.php">
          <div class="main-body-row">
            <div class="main-body-row-container">
              <input type="submit" class="button3 alternative" value="Add New" id="newreport" name="newreport" font-size: 14px></input>
            </div>
          </div>
          <div class="main-body-row">
            <div class="main-body-row-container">
              <span class="material-icons">calendar_month</span>
              <input class="main-body-input" type="date" name="incidentdate" id="incidentdate"></input>
            </div>
          </div>
          <div class="main-body-row">
            <div class="main-body-row-container">
              <span class="material-icons">description</span>
              <input class="main-body-input" type="text" placeholder="Report description" name="incidentreport" id="incidentreport"></input>
            </div>
          </div>
          <br>
          <!-- <br>
          <br> -->
          <div class="main-body-row"> 
            <button type="submit" class="button3 alternative" id="ReportSearch">Search</button>
              <script>
                document.getElementById("ReportSearch").addEventListener("click", myFunction);
                function myFunction() {
                  window.location.href="mainaction.php";
                }
              </script>
          </div>
        </form>
      </div>
    </div>
  </div>
    <!-- 
      Officer Table
    -->
    <?php
    if ($superadmin) {
    echo '<div class="app">';
      echo '<div class="main">';
        echo '<div class="main-header" align="center">';
          echo 'Officer';
        echo '</div>';
        echo '<div class="main-body">';
          echo '<form name="officer" method="POST" action="mainaction.php">';
            echo '<div class="main-body-row">';
              echo '<div class="main-body-row-container">';
                echo '<input type="submit" class="button3 alternative" value="Add New" id="newofficer" name="newofficer" font-size: 14px></input>';
              echo '</div>';
            echo '</div>';
            echo '<div class="main-body-row">';
              echo '<div class="main-body-row-container">';
                echo '<span class="material-icons">person</span>';
                  echo '<input class="main-body-input" type="text" placeholder="Officer Name" name="officername" id="officername"></input>';
              echo '</div>';
            echo '</div>';
            echo '<br>';
            echo '<br>';
            echo '<br>';
            echo '<div class="main-body-row">'; 
              echo '<button type="submit" class="button3 alternative" id="OfficerSearch">Search</button>';
              echo '<script>';
                echo 'document.getElementById("OfficerSearch").addEventListener("click", myFunction);';
                echo 'function myFunction() {';
                  echo 'window.location.href="mainaction.php";';
                echo '}';
              echo '</script>';
            echo '</div>';
          echo '</form>';
        echo '</div>';
      echo '</div>';
    }
    ?>
   <!--
      Offence Table
    -->
    <?php
    if ($superadmin) {
      echo '<div class="main">';
        echo '<div class="main-header" align="center">';
          echo 'Offence';
        echo '</div>';
        echo '<div class="main-body">';
          echo '<form name="offence" method="POST" action="mainaction.php">';
            echo '<div class="main-body-row">';
              echo '<div class="main-body-row-container">';
                echo '<input type="submit" class="button3 alternative" value="Add New" id="newoffence" name="newoffence" font-size: 14px></input>';
              echo '</div>';
            echo '</div>';
            echo '<div class="main-body-row">';
              echo '<div class="main-body-row-container">';
                echo '<span class="material-icons">sticky_note_2</span>';
                  echo '<input class="main-body-input" type="text" placeholder="Offence" name="offence" id="offence"></input>';
              echo '</div>';
            echo '</div>';
            echo '<br>';
            echo '<br>';
            echo '<br>';
            echo '<div class="main-body-row">'; 
              echo '<button type="submit" class="button3 alternative" id="OffencceSearch">Search</button>';
              echo '<script>';
                echo 'document.getElementById("OffenceSearch").addEventListener("click", myFunction);';
                echo 'function myFunction() {';
                  echo 'window.location.href="mainaction.php";';
                echo '}';
              echo '</script>';
            echo '</div>';
          echo '</form>';
        echo '</div>';
      echo '</div>';
    echo '</div>';
    }
    ?>  
</body>
</html>
