<?php
    session_start();
    $adminname = $_SESSION['adminname'];
    $adminid = $_SESSION['adminid'];
    require("../../config/db.inc.php");
    $mysqli = new mysqli($servername, $username, $password, $dbname);
    $platenumber = $_SESSION['platenumber'];
    if ($platenumber=='-') {
        $sql_vehicle = "SELECT * FROM Vehicle ORDER BY Vehicle_licence";
        $result_vehicle = $mysqli->query($sql_vehicle);
    } else {
        $sql_vehicle = "SELECT * FROM Vehicle WHERE Vehicle_licence LIKE '%$platenumber%'";
        $result_vehicle = $mysqli->query($sql_vehicle);
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
  <title>Vehicle Database</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link rel="stylesheet" href="./style.css">

</head>
<body>
<a id="container_home" href="../main/main.php">
    <div class="rond"></div>
    <div class="rondlogo" id="rondhome"></div>
</a>
  <h1>Vehicle Database</h1>
    <div id="container">
      <table class="normal">
        <thead>
          <tr>
            <th>Model</th>
            <th>Colour</th>
            <th>Plate Number</th>
            <th>Owner</th>
            <th>Owner License</th>
            <th>Edit</th>
          </tr>
        </thead>
        <tbody>
          <form name="people" method="POST" action="editvehicle.php">
            <?php
                if ($result_vehicle->num_rows > 0) {
                    while($row = $result_vehicle->fetch_assoc()) {
                      $sql_people = "SELECT People_name, People_licence FROM People INNER JOIN Ownership ON People.People_ID = Ownership.People_ID INNER JOIN Vehicle ON Ownership.Vehicle_ID = Vehicle.Vehicle_ID WHERE `Vehicle_licence` LIKE '$row[Vehicle_licence]'";
                      try {
                        $result_people = $mysqli->query($sql_people);
                      } catch (Exception $e) {
                        echo $e;
                      }
                      
                      $row_people = $result_people->fetch_assoc();
                      
                      
                      echo "<tr>";
                      echo "<td>" . $row['Vehicle_type'] . "</td>";
                      echo "<td>" . $row['Vehicle_colour'] . "</td>";
                      echo "<td>" . $row['Vehicle_licence'] . "</td>";
                      if ($row_people) {
                        echo "<td>" . $row_people['People_name'] . "</td>";
                        echo "<td>" . $row_people['People_licence'] . "</td>";
                      }
                      else {
                        echo "<td>" . "No Owner" . "</td>";
                        echo "<td>" . "No Owner" . "</td>";
                      }
                      $vehicleid = $row['Vehicle_ID'];
                      echo "<td><button type='submit' name='vehicleid' id='vehicleid' value='$vehicleid'>Edit</button></td>";
                      echo "</tr>";
                    }
                } 
                else {
                    echo "<tr>";
                    echo "<td colspan='6'>No results found</td>";
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