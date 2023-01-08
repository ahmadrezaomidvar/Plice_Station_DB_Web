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
    $officername = $_POST['officername'];
    $staffid = $_POST['staffid'];
    
   $sql = "INSERT INTO Officer (Officer_Name, Staff_ID, Officer_created_by) VALUES ('$officername', '$staffid', '$adminname');";
   $result = $mysqli->query($sql);
   if ($result) {
       $message = "New officer added: {$officername}, {$staffid}";
       header("Location: newofficer.php?msg=$message");
       exit;
    } else {
        $message = 'Duplicate entry '.$staffid.' for key Staff_ID';
        header("Location: newofficer.php?msg=$message");
        exit;
    }
?>