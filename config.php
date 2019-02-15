<?php
error_reporting(0);
session_start();
//nama server
define('DB_SERVER', 'localhost');
//nama user 
define('DB_USERNAME', 'root');
//nama password
define('DB_PASSWORD', '');
//nama database
define('DB_DATABASE', 'loginionic');
//ganti dengan base url kalian
define("BASE_URL", "http://localhost/loginionic/");
//buat kata kunci 
define("SITE_KEY", 'MariBelajarCoding');
function getDB() 
{
	$dbhost=DB_SERVER;
	$dbuser=DB_USERNAME;
	$dbpass=DB_PASSWORD;
	$dbname=DB_DATABASE;
	$dbConnection = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);	
	$dbConnection->exec("set names utf8");
	$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $dbConnection;
}
/* DATABASE CONFIGURATION END */
/* API key encryption */
function apiToken($session_uid)
{
$key=md5(SITE_KEY.$session_uid);
return hash('sha256', $key);
}
?>