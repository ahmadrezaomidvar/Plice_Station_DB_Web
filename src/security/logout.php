<?php
    session_start();
    require("../../config/db.inc.php");
    $mysqli = new mysqli($servername, $username, $password, $dbname);
    $adminname = $_SESSION['adminname'];
    $adminid = $_SESSION['adminid'];
    $superadmin = $_SESSION['superadmin'];
    $sql = "UPDATE admin SET admin_updated_by = '$adminname', admin_last_login = NOW() WHERE admin_ID = '$adminid';";
    $result = $mysqli->query($sql);
    if ($adminname && $adminid) {
        session_destroy();
        unset($adminname);
        unset($adminid);
        unset($superadmin);
        header("Location: ../../index.php?msg=You have been logged out successfully");
    } else {
        header("Location: ../../index.php?msg=You are not logged in");
    }
    exit;
?>