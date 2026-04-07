<?php

namespace App\Models;
use CodeIgniter\Model;

class DashboardAdminModel extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'NIM';
    protected $allowedFields = ['name', 'password', 'email', 'role'];

    public function getAllMahasiswa()
    {
        return $this->findAll();
    }

    public function countAllMahasiswa()
    {
        return $this->db->table('mahasiswa')
            ->where('role', 'mahasiswa')
            ->countAllResults();
    }

    public function getMahasiswaPass()
    {
        return $this->db->table('mahasiswa m')
            ->select('m.*, r.finalScore as finalScore, r.status as resultStatus')
            ->join('result r', 'r.NIM = m.NIM', 'left')
            ->where('m.role', 'mahasiswa')
            ->where('r.status', 'pass')
            ->get()
            ->getResultArray();
    }

    public function countMahasiswaPass()
    {
        return $this->db->table('mahasiswa m')
            ->join('result r', 'r.NIM = m.NIM', 'left')
            ->where('m.role', 'mahasiswa')
            ->where('r.status', 'pass')
            ->countAllResults();
    }

    public function countMahasiswaFail()
    {
        return $this->db->table('mahasiswa m')
            ->join('result r', 'r.NIM = m.NIM', 'left')
            ->where('m.role', 'mahasiswa')
            ->where('r.status', 'fail')
            ->countAllResults();
    }
}