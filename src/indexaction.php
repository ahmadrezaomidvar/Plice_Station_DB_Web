<?php
    session_start();
    require("../config/db.inc.php");
    $mysqli = new mysqli($servername, $username, $password, $dbname);
    $name = $_POST['username'];
    $pass = $_POST['password'];
    $sql = "SELECT * FROM admin WHERE admin_username = '$name' AND admin_password = '$pass'";
    $result = $mysqli->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $adminid = $row['admin_ID'];
        $superadmin = $row['super_admin'];
    }

    if ($adminid) {
        $_SESSION['adminname'] = $name;
        $_SESSION['adminid'] = $adminid;
        $_SESSION['superadmin'] = $superadmin;
        $sql = "UPDATE admin SET admin_updated_by = '$name', admin_last_login = NOW() WHERE admin_ID = '$adminid';";
        $result = $mysqli->query($sql);
        header("Location: main/main.php");
        exit;
    } 
    else {
        header("Location: ../index.php?msg=Invalid Username or Password");
    }
    exit;
?>