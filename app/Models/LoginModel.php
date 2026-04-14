<?php

namespace App\Models;
use CodeIgniter\Model;

class LoginModel extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'NIM';
    protected $allowedFields = ['NIM', 'name',  'idUser' ,'password', 'email', 'major', 'role', 'created_at'];

    public function getUserByEmail($email)
    {
        return $this->where('email', $email)->first();
    }

    public function checkNIMExists($nim)
    {
        return $this->where('NIM', $nim)->first();
    }

    public function checkEmailExists($email)
    {
        return $this->where('email', $email)->first();
    }

    public function createMahasiswa($data)
    {
        return $this->insert([
            'NIM' => $data['nim'],
            'name' => $data['fullName'],
            'password' => password_hash($data['password'], PASSWORD_BCRYPT),
            'email' => $data['email'],
            'major' => $data['major'],
            'role' => 'mahasiswa',
            'idUser' => 2, // Assuming '2' is the ID for mahasiswa role in the users table
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}