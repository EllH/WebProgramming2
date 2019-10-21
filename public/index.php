<?php
require '../autoload.php';

$routes = new \Cars\Routes();

$entryPoint = new \CSY2028\EntryPoint($routes);

$entryPoint->run();



