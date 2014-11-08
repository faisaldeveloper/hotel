echo on

set arg1=c:\wamp\bin\mysql\mysql5.5.24\bin\

rem for my pc
rem set year=%date:~-2,2%
rem set month=%date:~-6,3%
rem set day=%date:~-9,2%

rem for alfazal server
set year=%date:~-4,4%
set day=%date:~-7,2%
set month=%date:~-10,2%

set hour=%time:~-11,2%
set minute=%time:~-8,2%
set second=%time:~-5,2%
set millisecond=%time:~-2,2%


set filename=hotel-%year%-%month%-%day%


shift
shift

c:
cd\

rem Creating two backups one is local and one for live website
cd %arg1%

mysqldump --opt --skip-comments --user=root --password= hotel>c:\wamp\apps\%filename%.sql


exit
