<?php

require_once 'autoloader.php';
require_once 'config.php';

try
{
    header("Access-Control-Allow-Origin:*");
    header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE");
    header("Access-Control-Allow-Headers: Authorization, Content-Type");
    $res = new RestServer();
    $res->run();
}
catch(Exception $e)
{
    echo Response::serverError( 500, $e->getMessage());
}







   



