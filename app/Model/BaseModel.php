<?php

namespace App\Model;

use App\DB;
use PDO;

class BaseModel
{
    protected PDO $db;

    public function __construct()
    {
        $this->db = DB::instance();
    }
}