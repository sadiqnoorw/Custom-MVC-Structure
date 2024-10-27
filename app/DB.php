<?php

namespace App;

use PDO;

/**
 * @mixin PDO
 */
class DB {

    
    private static PDO $db;

    public function __construct(array $config) 
    {
        $defaultOption = [
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];
        try {
            
            static::$db = new PDO(
                $config['driver'].":host=".$config['host'].";dbname=".$config['database'],
                $config['user'],
                $config['pass'],
                $config['options'] ?? $defaultOption,
            );
        } catch (\PDOException $e) {
               throw new \PDOException($e->getMessage(), $e->getCode(), $e);
        }
    }
    public static function instance(): PDO
    {
        return static::$db;
    }

    public function __call($method, $args)
    {
        return call_user_func_array([$this->pdo, $method], $args);
    }
}