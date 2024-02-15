<?php
// Database Connection
require_once('../dbconnection.php');
// Filtering To Services
if (isset($_GET['service_id'])) {
    // Accepting User ID
    $userId = $_GET['userId'];
    $service_id = $_GET['service_id'];
    switch ($service_id) {
        // To CashIn
        case '1':
            header("Location: ../forms/cashIn.php?__id=$userId&service_id=$service_id");
            break;
        // To Transfer
        case 2:
            header("Location: ../forms/transfer.php?__id=$userId&service_id=$service_id",);
            break;
        // To CashOut
        case 3:
            header("Location: ../forms/cashOut.php?__id=$userId&service_id=$service_id",);
            break;
        default:
        // To Services
        header("Location: ../forms/services.php?__id=$userId&service_id=$service_id");
            
    }
} else {
    // Default Case
    header("location:userDashboard.php");
};
