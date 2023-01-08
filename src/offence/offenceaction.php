<?php
    session_start();
    $adminname = $_SESSION['adminname'];
    $adminid = $_SESSION['adminid'];
    require("../../config/db.inc.php");
    $mysqli = new mysqli($servername, $username, $password, $dbname);
    $offence = $_SESSION['offence'];
    if ($offence=='-') {
        $sql = "SELECT * FROM Offence ORDER BY Offence_description";
        $result = $mysqli->query($sql );
    } else {
      $sql = "SELECT * FROM Offence WHERE Offence_description LIKE '%$offence%'";
        $result = $mysqli->query($sql );
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
  <title>Offence Database</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link rel="stylesheet" href="./style.css">

</head>
<body>
<a id="container_home" href="../main/main.php">
    <div class="rond"></div>
    <div class="rondlogo" id="rondhome"></div>
</a>
  <h1>Offence Database</h1>
    <div id="container">
      <table class="normal">
        <thead>
          <tr>
            <th>Offence Description</th>
            <th>Maximum Fine</th>
            <th>Maximum Points</th>
            <th>Edit</th>
          </tr>
        </thead>
        <tbody>
          <form name="offence" method="POST" action="editoffence.php">
            <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['Offence_description'] . "</td>";
                        echo "<td>" . $row['Offence_maxFine'] . "</td>";
                        echo "<td>" . $row['Offence_maxPoints'] . "</td>";
                        $offenceid = $row['Offence_ID'];
                        echo "<td><button type='submit' name='offenceid' id='offenceid' value='$offenceid'>Edit</button></td>";
                        echo "</tr>";
                    }
                } 
                else {
                    echo "<tr>";
                    echo "<td colspan='4'>No results found</td>";
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