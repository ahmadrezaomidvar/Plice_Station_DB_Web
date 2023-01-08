<?php
    session_start();
    $adminname = $_SESSION['adminname'];
    $adminid = $_SESSION['adminid'];
    require("../../config/db.inc.php");
    $mysqli = new mysqli($servername, $username, $password, $dbname);
    $startdate = $_POST['startdate'];
    $enddate = $_POST['enddate'];
    $sql_admin = "SELECT * FROM admin_at WHERE done_at BETWEEN '$startdate' AND '$enddate' ORDER BY done_at DESC";
    $result_admin = $mysqli->query($sql_admin);
    $sql_fines = "SELECT * FROM fines_at WHERE done_at BETWEEN '$startdate' AND '$enddate' ORDER BY done_at DESC";
    $result_fines = $mysqli->query($sql_fines);
    $sql_people = "SELECT * FROM people_at WHERE done_at BETWEEN '$startdate' AND '$enddate' ORDER BY done_at DESC";
    $result_people = $mysqli->query($sql_people);
    $sql_vehicle = "SELECT * FROM vehicle_at WHERE done_at BETWEEN '$startdate' AND '$enddate' ORDER BY done_at DESC";
    $result_vehicle = $mysqli->query($sql_vehicle);
    $sql_incident = "SELECT * FROM incident_at WHERE done_at BETWEEN '$startdate' AND '$enddate' ORDER BY done_at DESC";
    $result_incident = $mysqli->query($sql_incident);
    $sql_offence = "SELECT * FROM offence_at WHERE done_at BETWEEN '$startdate' AND '$enddate' ORDER BY done_at DESC";
    $result_offence = $mysqli->query($sql_offence);
    $sql_officer = "SELECT * FROM officer_at WHERE done_at BETWEEN '$startdate' AND '$enddate' ORDER BY done_at DESC";
    $result_officer = $mysqli->query($sql_officer);
?>
<!-- 
  The MIT License (MIT)

  Copyright (c) 2022 jgx (https://codepen.io/jgx/pen/ANRBpb)
 -->
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Audit</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link rel="stylesheet" href="./style_7.css">

</head>
<body>
<a id="container_home" href="auditmain.php">
    <div class="rond"></div>
    <div class="rondlogo" id="rondhome"></div>
</a>
  <h1>Audit</h1>
    <div id="container">
      <table class="normal">
        <thead>
          <tr>
            <th>DB</th>
            <th>Main DB ID</th>
            <th>Column Name</th>
            <th>Old Value</th>
            <th>New Value</th>
            <th>Done By</th>
            <th>Date</th>
          </tr>
        </thead>
        <tbody>
          <form name="db" method="POST" action="">
            <?php
                if ($result_admin->num_rows > 0) {
                    while($row = $result_admin->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>Admin</td>";
                        echo "<td>" . $row['main_ID'] . "</td>";
                        echo "<td>" . $row['column_name'] . "</td>";
                        echo "<td>" . $row['old_value'] . "</td>";
                        echo "<td>" . $row['new_value'] . "</td>";
                        echo "<td>" . $row['done_by'] . "</td>";
                        echo "<td>" . $row['done_at'] . "</td>";
                        echo "</tr>";
                    }
                }
                if ($result_fines->num_rows > 0) {
                    while($row = $result_fines->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>Fines</td>";
                        echo "<td>" . $row['main_ID'] . "</td>";
                        echo "<td>" . $row['column_name'] . "</td>";
                        echo "<td>" . $row['old_value'] . "</td>";
                        echo "<td>" . $row['new_value'] . "</td>";
                        echo "<td>" . $row['done_by'] . "</td>";
                        echo "<td>" . $row['done_at'] . "</td>";
                        echo "</tr>";
                    }
                }
                if ($result_people->num_rows > 0) {
                    while($row = $result_people->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>People</td>";
                        echo "<td>" . $row['main_ID'] . "</td>";
                        echo "<td>" . $row['column_name'] . "</td>";
                        echo "<td>" . $row['old_value'] . "</td>";
                        echo "<td>" . $row['new_value'] . "</td>";
                        echo "<td>" . $row['done_by'] . "</td>";
                        echo "<td>" . $row['done_at'] . "</td>";
                        echo "</tr>";
                    }
                }
                if ($result_vehicle->num_rows > 0) {
                    while($row = $result_vehicle->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>Vehicle</td>";
                        echo "<td>" . $row['main_ID'] . "</td>";
                        echo "<td>" . $row['column_name'] . "</td>";
                        echo "<td>" . $row['old_value'] . "</td>";
                        echo "<td>" . $row['new_value'] . "</td>";
                        echo "<td>" . $row['done_by'] . "</td>";
                        echo "<td>" . $row['done_at'] . "</td>";
                        echo "</tr>";
                    }
                }
                if ($result_incident->num_rows > 0) {
                    while($row = $result_incident->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>Incident</td>";
                        echo "<td>" . $row['main_ID'] . "</td>";
                        echo "<td>" . $row['column_name'] . "</td>";
                        echo "<td>" . $row['old_value'] . "</td>";
                        echo "<td>" . $row['new_value'] . "</td>";
                        echo "<td>" . $row['done_by'] . "</td>";
                        echo "<td>" . $row['done_at'] . "</td>";
                        echo "</tr>";
                    }
                }
                if ($result_offence->num_rows > 0) {
                    while($row = $result_offence->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>Offence</td>";
                        echo "<td>" . $row['main_ID'] . "</td>";
                        echo "<td>" . $row['column_name'] . "</td>";
                        echo "<td>" . $row['old_value'] . "</td>";
                        echo "<td>" . $row['new_value'] . "</td>";
                        echo "<td>" . $row['done_by'] . "</td>";
                        echo "<td>" . $row['done_at'] . "</td>";
                        echo "</tr>";
                    }
                }
                if ($result_officer->num_rows > 0) {
                    while($row = $result_officer->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>Officer</td>";
                        echo "<td>" . $row['main_ID'] . "</td>";
                        echo "<td>" . $row['column_name'] . "</td>";
                        echo "<td>" . $row['old_value'] . "</td>";
                        echo "<td>" . $row['new_value'] . "</td>";
                        echo "<td>" . $row['done_by'] . "</td>";
                        echo "<td>" . $row['done_at'] . "</td>";
                        echo "</tr>";
                    }
                }
                else {
                    echo "<tr>";
                    echo "<td colspan='7'>No other record found</td>";
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