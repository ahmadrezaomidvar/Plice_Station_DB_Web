<?php
    session_start();
    $adminname = $_SESSION['adminname'];
    require("../../config/db.inc.php");
    $mysqli = new mysqli($servername, $username, $password, $dbname);
    $peopleid = $_POST['peopleid'];
    $sql = "SELECT * FROM People WHERE People_ID = '$peopleid'";
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();
?>
<?php
    $peopleid = $row['People_ID'];
    $people = $row['People_name'];
    $license = $row['People_licence'];
    $address = $row['People_address'];
    $dob = $row['People_DOB'];
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
              <th>Licence Number</th>
              <th>Address</th>
              <th>Date of Birth</th>
            </tr>
          </thead>
          <tbody>
            <form name="people" method="POST" action="editpeopleaction.php">
              <tr>
                <td><input type="text" name="people" id="people" value="<?php echo $people; ?>"></td>
                <td><input type="text" name="license" id="license" value="<?php echo $license; ?>"></td>
                <td><input type="text" name="address" id="address" value="<?php echo $address; ?>"></td>
                <td><input type="date" name="dob" id="dob" value="<?php echo $dob; ?>"></td>
              </tr>
              <tr>
                <td colspan="4"><input type="submit" class="button3 alternative" name="submit" value="Edit"></td>
              </tr>
              <input type="hidden" name="peopleid" id="peopleid" value="<?php echo $peopleid; ?>">
            </form>
          </tbody>
        </table>
      </div>            
</body>
</html>