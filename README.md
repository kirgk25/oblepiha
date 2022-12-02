# REST API using Laravel 

## About
__REST API__ using __Laravel php__ framework

## Stack of technologies
- Docker
- PHP
- Composer
- Laravel framework
- Xdebug (debugging and profiling)
- Nginx web server
- SSL certificate for nginx
- Npm
- MySQL
- PhpMyAdmin
- RabbitMQ
- Git
- Makefile (GNU Makefile)

## Installation
- clone repository
- run __make install__

## Hosts and ports
You may use host [http://127.0.0.1](http://127.0.0.1) or [http://oblepiha.local](http://oblepiha.local) (in the last case you should add __oblepiha.local__ to your __hosts__ file)
- Web server: [http://127.0.0.1](http://127.0.0.1)
- RabbitMQ: [http://127.0.0.1:__15672__](http://127.0.0.1:15672) (user __guest__ | password __guest__)
- MySQL: [http://127.0.0.1:__3306__](http://127.0.0.1:3306)
- PhpMyAdmin: [http://127.0.0.1:__8080__](http://127.0.0.1:8080)

## Xdebug
Some ways to initiate trigger (IDE should also __listen__ for debug connections):
- php function __xdebug_break()__
- __XDEBUG_SESSION=session_name__ GET or POST parameter (for one current request)
- __XDEBUG_SESSION_START=session_name__ GET or POST parameter (to set cookie, for multiple requests, XDEBUG_SESSION_STOP will removes cookie)
- __export XDEBUG_SESSION=1__ and __php myscript.php__ for command line php scripts (for linux)

## Tests
Command to run tests:<br>
__docker exec -it oblepiha-container-php php artisan test__
