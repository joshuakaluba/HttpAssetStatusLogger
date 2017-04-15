<?php

$server = getenv('MONITOR_DB_SERVER');
$user = getenv('MONITOR_DB_USER');
$password = getenv('MONITOR_DB_PASSWORD');
$name = getenv('MONITOR_DB_NAME');
$logFile = "C:\Logs\HttpMonitorLog.txt";

$to      = 'nobody@example.com';
$from = 'no-reply@domain.com';


define('DBHOST',$server);
define('DBUSER',$user);
define('DBPASS',$password);
define('DBNAME',$name);
define('LOGFILE',$logFile);
define('TO',$to);
define('FROM',$from);

function getDbConnection()
{
    try 
    {
        $db = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME, DBUSER, DBPASS);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        return $db;
    } 
    catch(PDOException $e) 
    {
        echo $e->getMessage();
        exit;
    }
}


?>
