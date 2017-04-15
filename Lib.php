<?php

require "Config.php";

function getSitesToMonitor($db)
{
    try
    { 
        $sql = $db->prepare("SELECT `id`, `url` 
                            FROM monitoredsite
                            WHERE `active` = :active");	
        
        $sql->execute( array('active'=>"1"));
        
        $sites = array();

        while($row = $sql->fetch(PDO::FETCH_ASSOC))
        {
            $site = array(
                'id'=>$row['id'],
                'url'=>$row['url']);

            $sites[] = $site;
        }        
        
        return $sites;
        
    }
    catch(PDOException $e) 
    {
        logErrorToDisk("Unable to retrieve monitored sites from database" . " : Detailed Error Message : " . $e->getMessage());
        exit;        
    } 
}

function makeHttpRequest($url)
{
    try
	{
		$request = file_get_contents($url);

		if(isset($http_response_header))
		{
			$httpResponseCode =  $http_response_header[0];			
			return $httpResponseCode;
		}
		else
		{
			return "0";
		}
	}
	catch(Exception $e)
	{
		logErrorToDisk("Unable to make http request to URL : " . $url . " : Detailed Error Message : " . $e->getMessage());
	}
}

function logHttpRequestResult($db, $monitoredSiteId, $httpResponseCode)
{
    try 
    {           
        $stmt = $db->prepare("INSERT INTO `monitorLog` (`monitoredSiteId`, `httpResponseCode`, `dateCreated`) 
                                VALUES (:monitoredSiteId, :httpResponseCode, :dateCreated)");         

        $stmt->execute(array(
            ':monitoredSiteId' => $monitoredSiteId,
            ':httpResponseCode' => $httpResponseCode,
            ':dateCreated' => date("Y-m-d H:i:s")
        ));

    } 
    catch(PDOException $e) 
    {		   
        logErrorToDisk("Unable to log http status for monitoredSiteId : " . $monitoredSiteId . " : Detailed Error Message : " . $e->getMessage());
    }  
}

function logErrorToDisk($error)
{
    try
    {
		$fileContents = file_get_contents(LOGFILE);
        $fileContents = $fileContents . "Error : ". date("Y-m-d H:i:s") . " : ". str_replace("\n"," - ",$error) . "\n";
        file_put_contents(LOGFILE, $fileContents);
    }
    catch(Exception $e)
    {
        echo $e->getMessage();
        exit;
    }
}

function handleSiteNotAvailable($url)
{
    //implement custom logic
    //e.g send email
    //$subject = 'Site Down : ' . $url;
    //$message = 'Site not available at ' . date("Y-m-d H:i:s") ;
    //$headers = 'From: '. FROM . "\r\n" .
    //        'Reply-To: ' . FROM . "\r\n" .
    //        'X-Mailer: PHP/' . phpversion();
    //mail(TO, $subject, $message, $headers);
}


?>