<?php
namespace App\Exception;

class RouteNotFoundException extends \Exception{
    public $message = "Route not found";

}