<?php
    session_start();
    $adminname = $_SESSION['adminname'];
    $adminid = $_SESSION['adminid'];
    require("../../config/db.inc.php");
    try {
        $mysqli = new mysqli($servername, $username, $password, $dbname);
    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
?>
<?php
    $incidentdate = $_POST['incidentdate'];
    $staffid = $_POST['staffid'];
    $plateno1 = $_POST['plateno1'];
    $plateno2 = $_POST['plateno2'];
    $people1 = $_POST['people1'];
    $license1 = $_POST['license1'];
    $people2 = $_POST['people2'];
    $license2 = $_POST['license2'];
    $Offencedescription = $_POST['Offencedescription'];                     
    $incidentreport = $_POST['incidentreport'];
    $message = "";

    $sql = "SELECT Officer_ID FROM Officer WHERE Staff_ID LIKE '$staffid';";
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();
    if ($row) {
        $officerid = $row['Officer_ID'];
    } else {
        header("Location: newreport.php?msg=Officer not found");
        exit;
    }

    $sql = "SELECT Vehicle_ID FROM Vehicle WHERE Vehicle_licence = '$plateno1';";
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();
    if ($row) {
        $vehicleid1 = $row['Vehicle_ID'];
    } else {
        $sql = "INSERT INTO Vehicle (Vehicle_licence, Vehicle_created_by) VALUES ('$plateno1', '$adminname');";
        $result = $mysqli->query($sql);
        $sql = "SELECT Vehicle_ID FROM Vehicle WHERE Vehicle_licence = '$plateno1';";
        $result = $mysqli->query($sql);
        $row = $result->fetch_assoc();
        $vehicleid1 = $row['Vehicle_ID'];
        $message = $message."New vehicle added: {$plateno1}, ";
    }

    if ($plateno2) {
        $sql = "SELECT Vehicle_ID FROM Vehicle WHERE Vehicle_licence = '$plateno2';";
        $result = $mysqli->query($sql);
        $row = $result->fetch_assoc();
        if ($row) {
            $vehicleid2 = $row['Vehicle_ID'];
        } else {
            $sql = "INSERT INTO Vehicle (Vehicle_licence, Vehicle_created_by) VALUES ('$plateno2', '$adminname');";
            $result = $mysqli->query($sql);
            $sql = "SELECT Vehicle_ID FROM Vehicle WHERE Vehicle_licence = '$plateno2';";
            $result = $mysqli->query($sql);
            $row = $result->fetch_assoc();
            $vehicleid2 = $row['Vehicle_ID'];
            $message = $message."New vehicle added: {$plateno2}, ";
        }
    }

    $sql = "SELECT People_ID FROM People WHERE People_name = '$people1';";
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();
    if ($row) {
        $peopleid1 = $row['People_ID'];
    } else {
        $sql = "INSERT INTO People (People_name, People_licence, People_created_by) VALUES ('$people1', '$license1', '$adminname');";
        $result = $mysqli->query($sql);
        $sql = "SELECT People_ID FROM People WHERE People_name = '$people1';";
        $result = $mysqli->query($sql);
        $row = $result->fetch_assoc();
        $peopleid1 = $row['People_ID'];
        $message = $message."New Name added: {$people1}, ";
    }

    if ($people2) {
        $sql = "SELECT People_ID FROM People WHERE People_name = '$people2';";
        $result = $mysqli->query($sql);
        $row = $result->fetch_assoc();
        if ($row) {
            $peopleid2 = $row['People_ID'];
        } else {
            $sql = "INSERT INTO People (People_name, People_licence, People_created_by) VALUES ('$people2', '$license2', '$adminname');";
            $result = $mysqli->query($sql);
            $sql = "SELECT People_ID FROM People WHERE People_name = '$people2';";
            $result = $mysqli->query($sql);
            $row = $result->fetch_assoc();
            $peopleid2 = $row['People_ID'];
            $message = $message."New Name added: {$people2}, ";
        }
    }

    $sql = "SELECT Offence_ID FROM Offence WHERE Offence_description = '$Offencedescription';";
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();
    $offenceid = $row['Offence_ID'];

    $sql = "INSERT INTO Incident (Incident_date, Incident_Report, Officer_ID, Incident_created_by) VALUES ('$incidentdate', '$incidentreport', '$officerid', '$adminname');";
    $result = $mysqli->query($sql);
    $sql = "SELECT Incident_ID FROM Incident WHERE Incident_Report = '$incidentreport' AND Incident_date = '$incidentdate' AND Officer_ID = '$officerid';";
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();
    $incidentid = $row['Incident_ID'];

    $sql = "INSERT INTO Incident_Offence (Incident_ID, Offence_ID) VALUES ('$incidentid', '$offenceid');";
    $result = $mysqli->query($sql);

    $sql = "INSERT INTO Incident_People (Incident_ID, People_ID) VALUES ('$incidentid', '$peopleid1');";
    $result = $mysqli->query($sql);

    if ($peopleid2) {
        $sql = "INSERT INTO Incident_People (Incident_ID, People_ID) VALUES ('$incidentid', '$peopleid2');";
        $result = $mysqli->query($sql);
    }

    $sql = "INSERT INTO Incident_Vehicle (Incident_ID, Vehicle_ID) VALUES ('$incidentid', '$vehicleid1');";
    $result = $mysqli->query($sql);

    if ($vehicleid2) {
        $sql = "INSERT INTO Incident_Vehicle (Incident_ID, Vehicle_ID) VALUES ('$incidentid', '$vehicleid2');";
        $result = $mysqli->query($sql);
    }

    $sql = "SELECT People_ID, Vehicle_ID FROM Ownership WHERE People_ID = '$peopleid1' AND Vehicle_ID = '$vehicleid1';";
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();
    if ($row) {
    } else {
        $sql = "INSERT INTO Ownership (People_ID, Vehicle_ID) VALUES ('$peopleid1', '$vehicleid1');";
        $result = $mysqli->query($sql);
    }
    
    if ($peopleid2) {
        $sql = "SELECT People_ID, Vehicle_ID FROM Ownership WHERE People_ID = '$peopleid2' AND Vehicle_ID = '$vehicleid2';";
        $result = $mysqli->query($sql);
        $row = $result->fetch_assoc();
        if ($row) {
        } else {
            $sql = "INSERT INTO Ownership (People_ID, Vehicle_ID) VALUES ('$peopleid2', '$vehicleid2');";
            $result = $mysqli->query($sql);
        }
    }
    $message = $message."New Incident added: {$incidentid}";
    header("Location: newreport.php?msg=$message");
?>