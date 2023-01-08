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
    $offencedesc = $_POST['offencedesc'];
    $maxfine = $_POST['maxfine'];
    $maxpoint = $_POST['maxpoint'];
    
   $sql = "INSERT INTO Offence (Offence_description, Offence_maxFine, Offence_maxPoints, Offence_created_by) VALUES ('$offencedesc', '$maxfine', '$maxpoint', '$adminname');";
   $result = $mysqli->query($sql);
   if ($result) {
       $message = "New Offence added: {$offencedesc}";
       header("Location: newoffence.php?msg=$message");
       exit;
    } else {
        $message = 'Not able to add offence {$offencedesc}';
        header("Location: newoffence.php?msg=$message");
        exit;
    }
?>