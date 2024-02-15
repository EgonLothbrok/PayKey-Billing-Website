<?php
require_once("../dbconnection.php");
// Code Review Done

// Getting User ID
$user_id = $_GET['userId'];
$userpocketsql = "SELECT amount FROM users WHERE user_id = $user_id";
$userpocket = $db1->query($userpocketsql);
$_userpocket = $userpocket->fetchAll(PDO::FETCH_ASSOC);

// Getting Original Amount of Finance
foreach ($_userpocket as $userpocket) {
    $originalAmount = $userpocket['amount'];
}   

// Updating Amount For  User
$updateAmount = $originalAmount +  $_GET['amount'];
$updateUserAmountSQL = "UPDATE `users` SET `amount` = '$updateAmount' WHERE `user_id` = $user_id";
$updateUserAmount = $db1->query($updateUserAmountSQL);
$updateUserAmount->execute();

// Updating Process For User
$activities_id = $_GET['noteId'];
$doneMessage = "Done";
$updateAcativitiesSQL = "UPDATE `user_activities` SET `note` = '$doneMessage' WHERE `id` = $activities_id";
$UpdateActivties = $db1->query($updateAcativitiesSQL);
$UpdateActivties->execute();

// Return
header("location: ../admin/adminDashboard.php");
