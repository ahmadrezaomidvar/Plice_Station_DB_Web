<?php
    session_start();
    $adminname = $_SESSION['adminname'];
    $adminid = $_SESSION['adminid'];
    $superadmin = $_SESSION['superadmin'];
    require("../../config/db.inc.php");
    try {
        $mysqli = new mysqli($servername, $username, $password, $dbname);
    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
?>
<?php
    $incidentid = $_POST['incidentid'];
    $staffid = $_POST['staffid'];
    $incidentreport = $_POST['incidentreport'];
    $incidentdate = $_POST['incidentdate'];
    if ($superadmin) {
    $fineamount = $_POST['fineamount'];
    $finepoints = $_POST['finepoints'];
    }
    $count_vehicle = $_POST['count_vehicle'];
    $involvedvehicles = array();
    for ($i = 1; $i <= $count_vehicle; $i++) {
        $involvedvehicles[$i] = $_POST['vehicle'.$i];
    }
    $count_people = $_POST['count_people'];
    $involvedpeople = array();
    for ($j = 1; $j <= $count_people; $j++) {
        $involvedpeople[$j] = $_POST['person'.$j];
    }

    $message = "";

    $sql = "SELECT Officer_ID FROM Officer WHERE Staff_ID LIKE '$staffid';";
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();
    if ($row) {
        $officerid = $row['Officer_ID'];
    } else {
        header("Location: ../main/main.php?msg=Officer not found, data not saved");
        exit;
    }
    
    $sql = "UPDATE Incident SET Incident_Date = '$incidentdate', Incident_Report = '$incidentreport', Officer_ID = '$officerid', Incident_updated_by = '$adminname' WHERE Incident_ID = '$incidentid';";
    $result = $mysqli->query($sql);
    if ($result) {
        $message = $message."Record updated: {$incidentid}, {$incidentdate}, ";
    } else {
        $message = $message."Record not updated: {$incidentid}, {$incidentdate}, ";
    }
    if ($superadmin) {
        $sql = "SELECT Fine_ID FROM Fines WHERE Incident_ID LIKE '$incidentid';";
        $result = $mysqli->query($sql);
        $row = $result->fetch_assoc();
        if ($row) {
            $fineid = $row['Fine_ID'];
            $sql = "UPDATE Fines SET Fine_Amount = '$fineamount', Fine_Points = '$finepoints', Fine_updated_by = '$adminname' WHERE Fine_ID = '$fineid';";
            $result = $mysqli->query($sql);
        } else {
            $sql = "INSERT INTO Fines (Fine_Amount, Fine_Points, Incident_ID, Fine_created_by) VALUES ('$fineamount', '$finepoints', '$incidentid', '$adminname');";
            $result = $mysqli->query($sql);
        }
    }
    $sql = "DELETE FROM Incident_Vehicle WHERE Incident_ID LIKE '$incidentid';";
    $result = $mysqli->query($sql);
    for ($i = 1; $i <= $count_vehicle; $i++) {
        $sql = "SELECT Vehicle_ID FROM Vehicle WHERE Vehicle_licence LIKE '$involvedvehicles[$i]';";
        $result = $mysqli->query($sql);
        $row = $result->fetch_assoc();
        if ($row) {
            $vehicleid = $row['Vehicle_ID'];
            $sql = "INSERT INTO Incident_Vehicle (Incident_ID, Vehicle_ID) VALUES ('$incidentid', '$vehicleid');";
            $result = $mysqli->query($sql);
            if ($result) {
                $message = $message."Vehicle {$vehicleid} associated with incident {$incidentid}, ";
            } else {
                $message = $message."Vehicle {$vehicleid} not associated with incident {$incidentid}, ";
            }
        } else {
            $message = $message."Vehicle {$vehicleid} not found, ";
        }
    }
    $sql = "DELETE FROM Incident_People WHERE Incident_ID LIKE '$incidentid';";
    $result = $mysqli->query($sql);
    for ($j = 1; $j <= $count_people; $j++) {
        $sql = "SELECT People_ID FROM People WHERE People_licence LIKE '$involvedpeople[$j]';";
        $result = $mysqli->query($sql);
        $row = $result->fetch_assoc();
        if ($row) {
            $peopleid = $row['People_ID'];
            $sql = "INSERT INTO Incident_People (Incident_ID, People_ID) VALUES ('$incidentid', '$peopleid');";
            $result = $mysqli->query($sql);
            if ($result) {
                $message = $message."Person {$peopleid} associated with incident {$incidentid}, ";
            } else {
                $message = $message."Person {$peopleid} not associated with incident {$incidentid}, ";
            }
        } else {
            $message = $message."Person {$peopleid} not found, ";
        }
    }

    header("Location:../main/main.php?msg=$message");
?>