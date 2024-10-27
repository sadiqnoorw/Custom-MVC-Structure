<?php

namespace App\Model;

class User extends BaseModel {
    
    public $table = 'users';

    public function __construct() {
        parent::__construct();
    }

    public function getUsers()
    {
        $stmt = $this->db->query("SELECT * FROM users");
        return $user = $stmt->fetchall();
    }
}