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
    $people = $_SESSION['people'];
    $license = $_SESSION['license'];
    $vehicleid = $_SESSION['vehicleid'];
    $message = $_SESSION['vmessage'];
    $address = $_POST['address'];
    $dob = $_POST['dob'];

    $sql = "INSERT INTO People (People_name, People_licence, People_address, People_DOB, People_created_by) VALUES ('$people', '$license', '$address', '$dob', '$adminname');";
    $result = $mysqli->query($sql);
    $sql = "SELECT People_ID FROM People WHERE People_name = '$people' AND People_licence = '$license';";
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();
    $peopleid = $row['People_ID'];
    
    $sql = "INSERT INTO Ownership (People_ID, Vehicle_ID) VALUES ('$peopleid', '$vehicleid');";
    $result = $mysqli->query($sql);
    $message = $message."New People added: {$people}, {$license}";

    
    header("Location:../vehicle/newvehicle.php?msg=$message");
?>