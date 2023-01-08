<?php
    session_start();
    $adminid = $_SESSION['adminid'];
    $adminname = $_SESSION['adminname'];
    require("../../config/db.inc.php");
    $mysqli = new mysqli($servername, $username, $password, $dbname);
    $pass = $_POST['p'];
    $confirm_pass = $_POST['p-c'];

    if ($pass == $confirm_pass) {
        $sql = "UPDATE admin SET admin_password = '$pass', admin_updated_by = '$adminname' WHERE admin_ID = '$adminid';";
        $result = $mysqli->query($sql);
        $message = $message."Password updated successfully!";
        header("Location:../main/main.php?msg=$message");
        exit;
    }
    else {
        $message = $message."Passwords don't match";
        header("Location: pass.php?msg=$message");
        exit;
    }
?>