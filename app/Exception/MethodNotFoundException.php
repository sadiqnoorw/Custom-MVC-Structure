<?php
namespace App\Exception;

class MethodNotFoundException extends \Exception{
    public $message = "Method not found";

}