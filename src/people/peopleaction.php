<?php
    session_start();
    $adminname = $_SESSION['adminname'];
    $adminid = $_SESSION['adminid'];
    require("../../config/db.inc.php");
    $mysqli = new mysqli($servername, $username, $password, $dbname);
    $peoplename = $_POST['peoplename'];
    $licence = $_POST['licence'];
    if ($peoplename && $licence) {
        $sql = "SELECT * FROM People WHERE People_name LIKE '%$peoplename%' AND People_licence LIKE '%$licence%'";
        $result = $mysqli->query($sql );
    }
    else if ($peoplename=='-') {
      $sql = "SELECT * FROM People ORDER BY People_name";
      $result = $mysqli->query($sql );
    }
    else if ($licence=='-') {
      $sql = "SELECT * FROM People ORDER BY People_licence";
      $result = $mysqli->query($sql);
    }
    else if ($peoplename) {
        $sql = "SELECT * FROM People WHERE People_name LIKE '%$peoplename%'";
        $result = $mysqli->query($sql );
    }
    else if ($licence) {
        $sql = "SELECT * FROM People WHERE People_licence LIKE '%$licence%'";
        $result = $mysqli->query($sql );
    } else {
        header("Location: ../main/main.php?msg=Please fill the required fields");
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
  <title>People Database</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link rel="stylesheet" href="./style.css">

</head>
<body>
<a id="container_home" href="../main/main.php">
    <div class="rond"></div>
    <div class="rondlogo" id="rondhome"></div>
</a>
  <h1>People Database</h1>
    <div id="container">
      <table class="normal">
        <thead>
          <tr>
            <th>Name</th>
            <th>Licence Number</th>
            <th>Address</th>
            <th>Date of Birth</th>
            <th>Edit</th>
          </tr>
        </thead>
        <tbody>
          <form name="people" method="POST" action="editpeople.php">
            <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['People_name'] . "</td>";
                        echo "<td>" . $row['People_licence'] . "</td>";
                        echo "<td>" . $row['People_address'] . "</td>";
                        echo "<td>" . $row['People_DOB'] . "</td>";
                        $peopleid = $row['People_ID'];
                        echo "<td><button type='submit' name='peopleid' id='peopleid' value='$peopleid'>Edit</button></td>";
                        echo "</tr>";
                    }
                } 
                else {
                    echo "<tr>";
                    echo "<td colspan='5'>No results found</td>";
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