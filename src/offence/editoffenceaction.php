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
    $offenceid = $_POST['offenceid'];
    $offencedesc = $_POST['offencedesc'];
    $maxfine = $_POST['maxfine'];
    $maxpoint = $_POST['maxpoint'];
    $message = "";

    
    $sql = "UPDATE Offence SET Offence_description = '$offencedesc', Offence_maxFine = '$maxfine', Offence_maxPoints = '$maxpoint', Offence_updated_by = '$adminname' WHERE Offence_ID = '$offenceid';";
    $result = $mysqli->query($sql);
    $message = $message."Record updated: {$offencedesc}";

    header("Location:../main/main.php?msg=$message")
?>