<?php

namespace App\Controller;

use App\View;
use App\Model\User;
use App\DB;
class HomeController {
    public function index(): View
    {
        $user = new User();

        try {
            $users = $user->getUsers();
            
            
         
            
        } catch(Exception $e) {
            echo "Connection failed: " . $e->getMessage();
        }

       return View::make('index', ['users' => $users]);
    }
}