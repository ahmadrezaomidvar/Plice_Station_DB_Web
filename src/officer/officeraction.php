<?php
    session_start();
    $adminname = $_SESSION['adminname'];
    $adminid = $_SESSION['adminid'];
    require("../../config/db.inc.php");
    $mysqli = new mysqli($servername, $username, $password, $dbname);
    $officername = $_SESSION['officername'];
    if ($officername=='-') {
        $sql = "SELECT * FROM Officer ORDER BY Officer_ID";
        $result = $mysqli->query($sql );
    } else {
      $sql = "SELECT * FROM Officer WHERE Officer_Name LIKE '%$officername%'";
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
  <title>Officer Database</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link rel="stylesheet" href="./style.css">

</head>
<body>
<a id="container_home" href="../main/main.php">
    <div class="rond"></div>
    <div class="rondlogo" id="rondhome"></div>
</a>
  <h1>Officer Database</h1>
    <div id="container">
      <table class="normal">
        <thead>
          <tr>
            <th>Name</th>
            <th>Staff ID</th>
            <th>Edit</th>
          </tr>
        </thead>
        <tbody>
          <form name="officer" method="POST" action="editofficer.php">
            <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['Officer_Name'] . "</td>";
                        echo "<td>" . $row['Staff_ID'] . "</td>";
                        $officerid = $row['Officer_ID'];
                        echo "<td><button type='submit' name='officerid' id='officerid' value='$officerid'>Edit</button></td>";
                        echo "</tr>";
                    }
                } 
                else {
                    echo "<tr>";
                    echo "<td colspan='3'>No results found</td>";
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