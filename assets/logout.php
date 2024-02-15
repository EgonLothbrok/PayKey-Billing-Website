<?php
session_start();

// Destorying Setting
session_destroy();

// To Home
header("location:../home.php");

