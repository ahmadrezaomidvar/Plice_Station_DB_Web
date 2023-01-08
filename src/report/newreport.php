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
    $sql = "SELECT Offence_ID, Offence_description FROM Offence;";
    $result = $mysqli->query($sql);
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>New Report</title>
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
  <form id="contact" action="newreportaction.php" method="POST" style="background-color: whitesmoke ;">
    <h3 align='center'>New Report</h3>
    <h4 align='center'>Add details of new incident</h4>
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
      <label for="incidentdate">Date:</label>
      <input placeholder="Date: 2022-12-15" type="date" tabindex="1" id="incidentdate" name="incidentdate" required autofocus>
    </fieldset>
    <fieldset>
      <input placeholder="Officer ID" type="text" tabindex="1" id="staffid" name="staffid" required autofocus>
    </fieldset>
    <fieldset>
      <input placeholder="1st Vehicle Plate No" type="text" tabindex="1" id="plateno1" name="plateno1" required autofocus>
    </fieldset>
    <fieldset>
      <input placeholder="1st Name" type="text" tabindex="1" id="people1" name="people1" required autofocus>
    </fieldset>
    <fieldset>
      <input placeholder="1st License No" type="text" tabindex="1" id="license1" name="license1" autofocus>
    </fieldset>
    <fieldset>
      <input placeholder="Optional: 2nd Vehicle Plate No" type="text" tabindex="1" id="plateno2" name="plateno2" autofocus>
    </fieldset>
    <fieldset>
      <input placeholder="Optional: 2nd Name" type="text" tabindex="1" id="people2" name="people2" autofocus>
    </fieldset>
    <fieldset>
      <input placeholder="Optional: 2nd License No" type="text" tabindex="1" id="license2" name="license2" autofocus>
    </fieldset>
    <fieldset>
    <label for="cars">Choose an Offence:</label>
    <select name="Offencedescription" id="Offencedescription">
    <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) { 
                    $Offencedescription = $row['Offence_description'];                   
                    echo "<option id='offencedescription' value='$Offencedescription' name='offencedescription'>" . $Offencedescription . "</option>";
                }
            }
          ?>
    </select>
    </fieldset>
    <fieldset>
      <textarea placeholder="Type report description here...." id="incidentreport" name="incidentreport" tabindex="5" required></textarea>
    </fieldset>
    <fieldset>
      <button name="submit" type="submit" id="AddNewReport" data-submit="...Sending">Submit</button>
    </fieldset>
  </form>
</div>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js'></script>
<script  src="./script.js"></script>
</body>
</html>
