<?php
    session_start();
    $adminname = $_SESSION['adminname'];
    $adminid = $_SESSION['adminid'];
    require("../../config/db.inc.php");
    $mysqli = new mysqli($servername, $username, $password, $dbname);
    // if we did not received $_SESSION['incidentreport'] from mainaction.php, redirect to main.php with error message
    $incidentreport = $_SESSION['incidentreport'];
    $incidentdate = $_SESSION['incidentdate'];
    $superadmin = $_SESSION['superadmin'];
    if ($incidentreport && $incidentdate && $incidentreport != '-') {
        $sql = "SELECT * FROM Incident WHERE Incident_Report LIKE '%$incidentreport%' AND Incident_Date LIKE '%$incidentdate%' ORDER BY Incident_Date";
        $result = $mysqli->query($sql);
    }
    else if ($incidentreport == '-') {
      $sql = "SELECT * FROM Incident ORDER BY Incident_Date";
      $result = $mysqli->query($sql);
    } 
    else if ($incidentreport) {
        $sql = "SELECT * FROM Incident WHERE Incident_Report LIKE '%$incidentreport%' ORDER BY Incident_Date";
        $result = $mysqli->query($sql);
    }
    else if ($incidentdate) {
        $sql = "SELECT * FROM Incident WHERE Incident_Date LIKE '%$incidentdate%' ORDER BY Incident_Date";
        $result = $mysqli->query($sql);
    }
?>
<!-- 
  The MIT License (MIT)

  Copyright (c) 2022 jgx (https://codepen.io/jgx/pen/ANRBpb)
 -->
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Incident Database</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link rel="stylesheet" href="./style.css">

</head>
<body>
<a id="container_home" href="../main/main.php">
    <div class="rond"></div>
    <div class="rondlogo" id="rondhome"></div>
</a>
  <h1>Incident Database</h1>
    <div id="container">
      <table class="normal">
        <thead>
          <tr>
            <th>Officer Name</th>
            <th>Incident Date</th>
            <th>Vehicle(s) Number</th>
            <th>People Involved</th>
            <th>Incident Report</th>
            <?php
              if ($superadmin) {
                echo "<th>Fine</th>";
                echo "<th>Points</th>";
              }
            ?>
            <th>Edit</th>
          </tr>
        </thead>
        <tbody>
          <form name="report" method="POST" action="editreport.php">
            <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                      // retrieve officer name
                      $officerid = $row['Officer_ID'];
                      $sql_officer = "SELECT Officer_name FROM Officer WHERE Officer_ID = '$officerid'";
                      try {
                        $result_officer = $mysqli->query($sql_officer);
                      } catch (Exception $e) {
                        echo $e;
                      }
                      $row_officer = $result_officer->fetch_assoc();
                      // retrieve vehicle data
                      $incidentid = $row['Incident_ID'];
                      $sql_incident_vehicle = "SELECT Vehicle_ID FROM Incident_Vehicle WHERE Incident_ID = '$incidentid'";
                      try {
                        $result_incident_vehicle = $mysqli->query($sql_incident_vehicle);
                      } catch (Exception $e) {
                        echo $e;
                      }
                      $involvedvehicles = "";
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
                        $involvedvehicles = $involvedvehicles . $vehiclelicence . "<br>";
                      }
                      // retrieve people data
                      $sql_incident_people = "SELECT People_ID FROM Incident_People WHERE Incident_ID = '$incidentid'";
                      try {
                        $result_incident_people = $mysqli->query($sql_incident_people);
                      } catch (Exception $e) {
                        echo $e;
                      }
                      $involvedpeople = "";
                      while ($row_incident_people = $result_incident_people->fetch_assoc()) {
                        $peopleid = $row_incident_people['People_ID'];
                        $sql_people = "SELECT People_name FROM People WHERE People_ID = '$peopleid'";
                        try {
                          $result_people = $mysqli->query($sql_people);
                        } catch (Exception $e) {
                          echo $e;
                        }
                        $row_people = $result_people->fetch_assoc();
                        $peoplename = $row_people['People_name'];
                        $involvedpeople = $involvedpeople . $peoplename . "<br>";
                      }
                      // retrieve fine data
                      if ($superadmin) {
                        $sql_fine = "SELECT * From Fines WHERE Incident_ID = '$incidentid'";
                        try {
                          $result_fine = $mysqli->query($sql_fine);
                        } catch (Exception $e) {
                          echo $e;
                        }
                        $row_fine = $result_fine->fetch_assoc();
                        $fineid = $row_fine['Fine_ID'];
                        $fineamount = $row_fine['Fine_Amount'];
                        $finepoints = $row_fine['Fine_Points'];
                      }
                      
                      // display data
                      echo "<tr>";
                      if ($row_officer) {
                        echo "<td>" . $row_officer['Officer_name'] . "</td>";
                      }
                      else {
                        echo "<td>" . "No Officer Data" . "</td>";
                      }
                      echo "<td>" . $row['Incident_Date'] . "</td>";
                      echo "<td>" . $involvedvehicles . "</td>";
                      echo "<td>" . $involvedpeople . "</td>";
                      echo "<td>" . $row['Incident_Report'] . "</td>";
                      if ($superadmin) {
                        echo "<td>" . $fineamount . "</td>";
                        echo "<td>" . $finepoints . "</td>";
                      }
                      $reportid = $row['Incident_ID'];
                      echo "<td><button type='submit' name='reportid' id='reportid' value='$reportid'>Edit</button></td>";
                      echo "</tr>";
                    }
                } 
                else {
                    echo "<tr>";
                    if ($superadmin) {
                      echo "<td colspan='8'>No results found</td>";
                    } else {
                      echo "<td colspan='6'>No results found</td>";
                    }
                    echo "</tr>";
                  
                }
                $mysqli->close();
            ?>
          </form>
        </tbody>
      </table>
    </div>
</body>
</html>