<?php

namespace App\Controller;

class InvoicesController {

    public function index() 
    {
        echo "Invoices";
    }

    public function create() 
    {
          echo '<form action="store" method="post"><input type="input" name="amount"></form>';
    }

    public function store() 
    {
        var_dump($_POST);
    }
}