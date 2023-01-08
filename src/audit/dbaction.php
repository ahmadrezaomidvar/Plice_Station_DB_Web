<?php
    session_start();
    $adminname = $_SESSION['adminname'];
    $adminid = $_SESSION['adminid'];
    require("../../config/db.inc.php");
    $mysqli = new mysqli($servername, $username, $password, $dbname);
    $databasename = $_POST['databasename'];
    $sql = "SELECT * FROM $databasename ORDER BY done_at DESC";
    $result = $mysqli->query($sql);
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
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
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
                    echo "<td colspan='6'>No record found</td>";
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