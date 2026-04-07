<?php

namespace App\Models;
use CodeIgniter\Model;

class LoginModel extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'NIM';
    protected $allowedFields = ['username', 'password', 'email', 'role'];

    public function getUserByEmail($email)
    {
        return $this->where('email', $email)->first();
    }

    
}