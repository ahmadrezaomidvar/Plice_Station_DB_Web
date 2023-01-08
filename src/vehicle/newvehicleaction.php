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
    $vehicletype = $_POST['vehicletype'];
    $vehiclecolour = $_POST['vehiclecolour'];
    $plateno = $_POST['plateno'];
    $people = $_POST['people'];
    $license = $_POST['license'];
    $message = "";
    
    $sql = "INSERT INTO Vehicle (Vehicle_type, Vehicle_colour, Vehicle_licence, Vehicle_created_by) VALUES ('$vehicletype', '$vehiclecolour', '$plateno', '$adminname');";
    $result = $mysqli->query($sql);
    $sql = "SELECT Vehicle_ID FROM Vehicle WHERE Vehicle_licence = '$plateno';";
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();
    $vehicleid = $row['Vehicle_ID'];
    $message = $message."New Vehicle added: {$plateno}, ";


    $sql = "SELECT People_ID FROM People WHERE People_name = '$people' AND People_licence = '$license';";
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();
    if ($row) {
        $peopleid = $row['People_ID'];
    } else {
        $_SESSION['people'] = $people;
        $_SESSION['license'] = $license;
        $_SESSION['vehicleid'] = $vehicleid;
        $_SESSION['vmessage'] = $message;
        $message = $message."Please complete the people information";
        header("location: ../people/newpeople.php?msg=Please complete the people information");
        exit;
    }

    $sql = "INSERT INTO Ownership (People_ID, Vehicle_ID) VALUES ('$peopleid', '$vehicleid');";
    $result = $mysqli->query($sql);

    
    header("Location: newvehicle.php?msg=$message");
?>