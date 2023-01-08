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
    $people = $_POST['people'];
    $license = $_POST['license'];
    $address = $_POST['address'];
    $dob = $_POST['dob'];
    $peopleid = $_POST['peopleid'];
    $message = "";

    
    $sql = "UPDATE People SET People_name = '$people', People_licence = '$license', People_address = '$address', People_DOB = '$dob', People_updated_by = '$adminname' WHERE People_ID = '$peopleid';";
    $result = $mysqli->query($sql);
    $message = $message."Record updated: {$people}, {$license}";

    header("Location:../main/main.php?msg=$message")
?>