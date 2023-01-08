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
    $vehicleid = $_POST['vehicleid'];
    $model = $_POST['model'];
    $colour = $_POST['colour'];
    $plateno = $_POST['plateno'];
    $message = "";

    
    $sql = "UPDATE Vehicle SET Vehicle_type = '$model', Vehicle_colour = '$colour', Vehicle_licence = '$plateno', Vehicle_updated_by = '$adminname' WHERE Vehicle_ID = '$vehicleid';";
    $result = $mysqli->query($sql);
    $message = $message."Record updated: {$model}, {$plateno}";

    header("Location:../main/main.php?msg=$message")
?>