<?php

namespace App\Classes;

use App\View;

class HomeController {
    public function index(): View
    {
       return View::make('index', ['title' => 'Home page']);
    }
}