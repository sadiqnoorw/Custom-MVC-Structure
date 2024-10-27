<?php
declare(strict_types=1);

namespace App;

use PDO;

class App {

    private static DB $db;
    public function __construct(protected Router $router, protected array $request, protected Config $config)
    {
        static::$db = new DB($config->db ?? []);           
    }

    public function run() 
    {
        try {       
            echo $action = $this->router->resolve(
                $this->request['uri'], 
                $this->request['method']
            );
        } catch (\App\Exceptions\RouteNotFoundException $e) {
            
           http_response_code(404);
           echo View::make("error/404");
        }
    }
}