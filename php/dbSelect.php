<?php
session_start();
$dbName = 'sensors';
$mysqli = new mysqli('127.0.0.1:3307', 'root', '', 'sensors');
mysqli_select_db($mysqli, $dbName);