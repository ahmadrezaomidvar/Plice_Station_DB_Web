<?php
    session_start();
    $adminname = $_SESSION['adminname'];
    $adminid = $_SESSION['adminid'];
    require("../../config/db.inc.php");
    $mysqli = new mysqli($servername, $username, $password, $dbname);
    $offenceid = $_POST['offenceid'];
    $sql = "SELECT * FROM Offence WHERE Offence_ID = '$offenceid';";
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();
?>
<?php
    $offenceid = $row['Offence_ID'];
    $offencedesc = $row['Offence_description'];
    $maxfine = $row['Offence_maxFine'];
    $maxpoint = $row['Offence_maxPoints'];
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
              <th>Offence Description</th>
              <th>Max Fine</th>
              <th>Max Points</th>
            </tr>
          </thead>
          <tbody>
            <form name="offence" method="POST" action="editoffenceaction.php">
              <tr>
                <td><input type="text" name="offencedesc" id="offencedesc" value="<?php echo $offencedesc; ?>"></td>
                <td><input type="text" name="maxfine" id="maxfine" value="<?php echo $maxfine; ?>"></td>
                <td><input type="text" name="maxpoint" id="maxpoint" value="<?php echo $maxpoint; ?>"></td>
              </tr>
              <tr>
                <td colspan="3"><input type="submit" class="button3 alternative" name="submit" value="Edit"></td>
              </tr>
              <input type="hidden" name="offenceid" id="offenceid" value="<?php echo $offenceid; ?>">
            </form>
          </tbody>
        </table>
      </div>            
</body>
</html>