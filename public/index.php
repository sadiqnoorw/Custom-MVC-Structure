<?php
declare(strict_types=1);
require_once(dirname(__FILE__) ."/../vendor/autoload.php");
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->Load();

define("STORAGE_PATH", __DIR__ ."/../storage");
define("VIEW_PATH", __DIR__ ."/../views");

//echo phpinfo();
// use App\Users;

use App\Router;
use App\App;
use App\Config;
// echo '<pre>';
// var_dump($_REQUEST);
$uri = $_REQUEST['url'] ?? '/';


$router = new Router;
$router
    ->get("/", [\App\Classes\HomeController::class, "index"])
    ->get("invoice", [\App\Classes\InvoicesController::class, 'index'])
    ->get("invoice/create", [\App\Classes\InvoicesController::class, 'create'])
    ->post("invoice/store", [\App\Classes\InvoicesController::class, 'store']);




(new App(
        $router,
        ['uri' => $uri, 'method' => strtolower($_SERVER["REQUEST_METHOD"])],
        new Config($_ENV)
        ))->run();