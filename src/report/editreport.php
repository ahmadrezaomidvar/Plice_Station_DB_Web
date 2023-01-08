<?php
    session_start();
    $adminname = $_SESSION['adminname'];
    $adminid = $_SESSION['adminid'];
    require("../../config/db.inc.php");
    $mysqli = new mysqli($servername, $username, $password, $dbname);
    $superadmin = $_SESSION['superadmin'];
    $reportid = $_POST['reportid'];
    $sql = "SELECT * FROM Incident WHERE Incident_ID = '$reportid'";
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();
?>
<?php
    $incidentid = $row['Incident_ID'];
    $officerid = $row['Officer_ID'];
    $incidentdate = $row['Incident_Date'];
    $incidentreport = $row['Incident_Report'];

    $sql_officer = "SELECT Staff_ID FROM Officer WHERE Officer_ID = '$officerid'";
    $result_officer = $mysqli->query($sql_officer);
    $row_officer = $result_officer->fetch_assoc();
    $staffid = $row_officer['Staff_ID'];

    // retrieve vehicle data
    $sql_incident_vehicle = "SELECT Vehicle_ID FROM Incident_Vehicle WHERE Incident_ID = '$incidentid'";
    try {
      $result_incident_vehicle = $mysqli->query($sql_incident_vehicle);
    } catch (Exception $e) {
      echo $e;
    }
    $involvedvehicles = array();
    while ($row_incident_vehicle = $result_incident_vehicle->fetch_assoc()) {
      $vehicleid = $row_incident_vehicle['Vehicle_ID'];
      $sql_vehicle = "SELECT Vehicle_licence FROM Vehicle WHERE Vehicle_ID = '$vehicleid'";
      try {
        $result_vehicle = $mysqli->query($sql_vehicle);
      } catch (Exception $e) {
        echo $e;
      }
      $row_vehicle = $result_vehicle->fetch_assoc();
      $vehiclelicence = $row_vehicle['Vehicle_licence'];
      array_push($involvedvehicles, $vehiclelicence);
    }
    $count_vehicle = count($involvedvehicles);

    // retrieve people data
    $sql_incident_people = "SELECT People_ID FROM Incident_People WHERE Incident_ID = '$incidentid'";
    try {
      $result_incident_people = $mysqli->query($sql_incident_people);
    } catch (Exception $e) {
      echo $e;
    }
    $involvedpeople = array();
    while ($row_incident_people = $result_incident_people->fetch_assoc()) {
      $peopleid = $row_incident_people['People_ID'];
      $sql_people = "SELECT People_licence FROM People WHERE People_ID = '$peopleid'";
      try {
        $result_people = $mysqli->query($sql_people);
      } catch (Exception $e) {
        echo $e;
      }
      $row_people = $result_people->fetch_assoc();
      $peoplelicense = $row_people['People_licence'];
      array_push($involvedpeople, $peoplelicense);
    }
    $count_people = count($involvedpeople);
    
    if ($superadmin) {
      $sql_fine = "SELECT * FROM Fines WHERE Incident_ID = '$incidentid'";
      $result_fine = $mysqli->query($sql_fine);
      $row_fine = $result_fine->fetch_assoc();
      $fineid = $row_fine['Fine_ID'];
      $fineamount = $row_fine['Fine_Amount'];
      $finepoints = $row_fine['Fine_Points'];
    }
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
              <th>Officer ID</th>
              <th>Incident Report</th>
              <th>Incident Date</th>
              <?php
              for ($i = 0; $i < $count_vehicle; $i++) {
                echo "<th>Vehicle " . ($i + 1) . "</th>";
              }
              ?>
              <?php
              for ($j = 0; $j < $count_people; $j++) {
                echo "<th>Person " . ($j + 1) . "</th>";
              }
              ?>
              <?php
              if ($superadmin) {
                echo "<th>Fine</th>";
                echo "<th>Points</th>";
              }
              ?>
            </tr>
          </thead>
          <tbody>
            <form name="incident" method="POST" action="editreportaction.php">
              <tr>
                <td><input type="text" name="staffid" id="staffid" value="<?php echo $staffid; ?>"></td>
                <td><input type="text" name="incidentreport" id="incidentreport" value="<?php echo $incidentreport; ?>"></td>
                <td><input type="date" name="incidentdate" id="incidentdate" value="<?php echo $incidentdate; ?>"></td>
                <?php
                for ($i = 0; $i < $count_vehicle; $i++) {
                  echo "<td><input type='text' name='vehicle" . ($i + 1) . "' id='vehicle" . ($i + 1) . "' value='" . $involvedvehicles[$i] . "'></td>";
                }
                for ($j = 0; $j < $count_people; $j++) {
                  echo "<td><input type='text' name='person" . ($j + 1) . "' id='person" . ($j + 1) . "' value='" . $involvedpeople[$j] . "'></td>";
                }
                if ($superadmin) {
                  echo "<td><input type='text' name='fineamount' id='fineamount' value='$fineamount'></td>";
                  echo "<td><input type='text' name='finepoints' id='finepoints' value='$finepoints'></td>";
                }
                ?>
              </tr>
              <tr>
                <?php
                $column_no = $count_vehicle + $count_people + 3;
                if ($superadmin) {
                  $column_no = $column_no + 2;
                }
                echo "<td colspan='$column_no'><input type='submit' class='button3 alternative' name='submit' value='Edit'></td>";
                echo "<td><input type='hidden' name='count_vehicle' id='count_vehicle' value='$count_vehicle'></td>";
                echo "<td><input type='hidden' name='count_people' id='count_people' value='$count_people'></td>";
                ?>
              </tr>
              <input type="hidden" name="incidentid" id="incidentid" value="<?php echo $incidentid; ?>">
            </form>
          </tbody>
        </table>
      </div>            
</body>
</html>