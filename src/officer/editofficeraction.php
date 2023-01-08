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
    $officerid = $_POST['officerid'];
    $officername = $_POST['officername'];
    $staffid = $_POST['staffid'];
    $message = "";

    
    $sql = "UPDATE Officer SET Officer_Name = '$officername', Staff_ID = '$staffid', Officer_updated_by = '$adminname' WHERE Officer_ID = '$officerid';";
    $result = $mysqli->query($sql);
    if ($result) {
        $message = $message."Record updated: {$officername}, {$staffid}";
        header("Location:../main/main.php?msg=$message");
        exit;
     } else {
        $message = 'Duplicate entry '.$staffid.' for key Staff_ID';
        header("Location:../main/main.php?msg=$message");
        exit;
     }
?>