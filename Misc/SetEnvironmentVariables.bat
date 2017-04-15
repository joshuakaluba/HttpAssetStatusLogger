@ECHO OFF

:: Modify and ran as administrator to set enviroment variables for db connection info

setx MONITOR_DB_SERVER "localhost" /m
setx MONITOR_DB_USER "root" /m
setx MONITOR_DB_PASSWORD "" /m
setx MONITOR_DB_NAME "" /m

pause