<?php
ob_start();
// Turns on output buffering
session_start();

date_default_timezone_set("America/Los_Angeles");

try {
	$connection = new PDO("mysql:dbname=videotube;host=localhost", "root", "");
	$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
}
catch (PDOException $e) {
	echo "Connection failed: " . $e->getMessage();
}