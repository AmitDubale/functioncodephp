<?php
require_once('DB.Config.php');
require_once('Database.class.php');
require_once('DB.Functions.php');
$db = new Database(DB_HOST, DB_USER, DB_PWD, DB_DATABASE);
@session_start();
date_default_timezone_set("Asia/Kolkata");
?>