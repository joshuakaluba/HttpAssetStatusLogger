<?php

require "Lib.php";

$db = getDbConnection();

$sites = getSitesToMonitor($db);

for($i = 0; $i < count($sites); $i++) 
{
    $id = $sites[$i]["id"];
    $url = $sites[$i]["url"];
    
    $httpResponseCode = makeHttpRequest($url);
    
    logHttpRequestResult($db, $id, $httpResponseCode);

    if(!strstr($httpResponseCode, "200"))
    {
        handleSiteNotAvailable($url);
    }
}

$db = null;

?>