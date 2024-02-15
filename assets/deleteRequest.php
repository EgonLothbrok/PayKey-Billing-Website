<?php
// Code Review - Done
require_once("../dbconnection.php");
// Getting Request ID
$id = $_GET['id'];
$deleteRequest = $db1->prepare("DELETE FROM `requests` WHERE req_id = $id");
$deleteRequest->execute();//delete here

header("location:../admin/viewRequest.php");