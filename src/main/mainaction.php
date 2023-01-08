<?php
    session_start();
    // Vehicle actions
    $newvehicle = $_POST['newvehicle'];
    if ($newvehicle) {
        header("Location: ../vehicle/newvehicle.php");
        exit;
    }
    $platenumber = $_POST['platenumber'];
    if ($platenumber) {
        $_SESSION['platenumber'] = $platenumber;
        header("Location: ../vehicle/vehicleaction.php");
        exit;
    } else {
        header("Location: ../main/main.php?msg=Please fill the required fields");
    }

    // Report actions
    $newreport = $_POST['newreport'];
    if ($newreport) {
        header("Location: ../report/newreport.php");
        exit;
    } 
    $incidentreport = $_POST['incidentreport'];
    $incidentdate = $_POST['incidentdate'];
    if ($incidentreport or $incidentdate) {
        $_SESSION['incidentreport'] = $incidentreport;
        $_SESSION['incidentdate'] = $incidentdate;
        header("Location: ../report/reportaction.php");
        exit;
    } else {
        header("Location: ../main/main.php?msg=Please fill the required fields");
    }

    // Offence actions
    $newoffence = $_POST['newoffence'];
    if ($newoffence) {
        header("Location: ../offence/newoffence.php");
        exit;
    }
    $offence = $_POST['offence'];
    if ($offence) {
        $_SESSION['offence'] = $offence;
        header("Location: ../offence/offenceaction.php");
        exit;
    } else {
        header("Location: ../main/main.php?msg=Please fill the required fields");
    }

    // Officer actions
    $newofficer = $_POST['newofficer'];
    if ($newofficer) {
        header("Location: ../officer/newofficer.php");
        exit;
    } 
    $officername = $_POST['officername'];
    if ($officername) {
        $_SESSION['officername'] = $officername;
        header("Location: ../officer/officeraction.php");
        exit;
    } else {
        $_SESSION['officername'] = 0;
        header("Location: ../main/main.php?msg=Please fill the required fields");
        exit;
    }
?>