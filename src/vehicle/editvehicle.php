<?php
    session_start();
    $adminname = $_SESSION['adminname'];
    $adminid = $_SESSION['adminid'];
    require("../../config/db.inc.php");
    $mysqli = new mysqli($servername, $username, $password, $dbname);
    $vehicleid = $_POST['vehicleid'];
    $sql = "SELECT * FROM Vehicle WHERE Vehicle_ID = '$vehicleid';";
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();
?>
<?php
    $vehicleid = $row['Vehicle_ID'];
    $vehicletype = $row['Vehicle_type'];
    $vehiclecolour = $row['Vehicle_colour'];
    $plateno = $row['Vehicle_licence'];
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Edit Record</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> 
  <link href="https://fonts.googleapis.com/css2?family=Sen&display=swap" rel="stylesheet"> 
  <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Sen&display=swap" rel="stylesheet"> 
  <link rel="stylesheet" href="./style.css">
  <style>
    input[type='submit'] {font-size: 16px; color: crimson; background-color: #fff; border: none; padding: 10px 20px; border-radius: 5px; font-family: 'Courier New', Courier, monospace; font-weight: bold; }
  </style>
</head>
<body>
<a id="container_home" href="../main/main.php">
    <div class="rond"></div>
    <div class="rondlogo" id="rondhome"></div>
</a>
  <h1>Edit Record</h1>
      <div id="container">
        <table class="normal">
          <thead>
            <tr>
              <th>Model</th>
              <th>Colour</th>
              <th>Plate Number</th>
            </tr>
          </thead>
          <tbody>
            <form name="vehicle" method="POST" action="editvehicleaction.php">
              <tr>
                <td><input type="text" name="model" id="model" value="<?php echo $vehicletype; ?>"></td>
                <td><input type="text" name="colour" id="colour" value="<?php echo $vehiclecolour; ?>"></td>
                <td><input type="text" name="plateno" id="plateno" value="<?php echo $plateno; ?>"></td>
              </tr>
              <tr>
                <td colspan="3"><input type="submit" class="button3 alternative" name="submit" value="Edit"></td>
              </tr>
              <input type="hidden" name="vehicleid" id="vehicleid" value="<?php echo $vehicleid; ?>">
            </form>
          </tbody>
        </table>
      </div>            
</body>
</html>