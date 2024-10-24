<?php
declare(strict_types=1);
require_once(dirname(__FILE__) ."/../vendor/autoload.php");

define("STORAGE_PATH", __DIR__ ."/../storage");
define("VIEW_PATH", __DIR__ ."/../views");

use App\Router;

$uri = $_REQUEST['url'] ?? '/';

$router = new Router;
$router
    ->get("/", function(){
        echo '<form action="store" method="post"><input type="input" name="amount"></form>';
    })->post("store",  function(){
        var_dump($_POST);
    });


echo $action = $router->resolve($uri, strtolower($_SERVER["REQUEST_METHOD"]));