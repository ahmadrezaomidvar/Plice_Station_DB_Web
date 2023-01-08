<?php
    session_start();
    $adminname = $_SESSION['adminname'];
    $adminid = $_SESSION['adminid'];
    require("../../config/db.inc.php");
    $mysqli = new mysqli($servername, $username, $password, $dbname);
    $officerid = $_POST['officerid'];
    $sql = "SELECT * FROM Officer WHERE Officer_ID = '$officerid';";
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();
?>
<?php
    $officerid = $row['Officer_ID'];
    $officername = $row['Officer_Name'];
    $staffid = $row['Staff_ID'];
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
              <th>Name</th>
              <th>Staff ID</th>
            </tr>
          </thead>
          <tbody>
            <form name="officer" method="POST" action="editofficeraction.php">
              <tr>
                <td><input type="text" name="officername" id="officername" value="<?php echo $officername; ?>"></td>
                <td><input type="text" name="staffid" id="staffid" value="<?php echo $staffid; ?>"></td>
              </tr>
              <tr>
                <td colspan="2"><input type="submit" class="button3 alternative" name="submit" value="Edit"></td>
              </tr>
              <input type="hidden" name="officerid" id="officerid" value="<?php echo $officerid; ?>">
            </form>
          </tbody>
        </table>
      </div>            
</body>
</html>