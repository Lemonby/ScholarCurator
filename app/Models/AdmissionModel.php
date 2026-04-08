<?php

namespace App\Models;
use CodeIgniter\Model;

class AdmissionModel extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'NIM';
    protected $allowedFields = ['name', 'password', 'email', 'role', 'major', 'finalScore'];

    public function getAllMahasiswa()
    {
        return $this->db->table('mahasiswa m')
            ->select('m.*, r.finalScore as finalScore, r.status as resultStatus')
            ->join('result r', 'r.NIM = m.NIM', 'left')
            ->where('m.role', 'mahasiswa')
            ->get()
            ->getResultArray();
    }

    public function countAllMahasiswa()
    {
        return $this->db->table('mahasiswa')
            ->where('role', 'mahasiswa')
            ->countAllResults();
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

    // edit mahasiswa data by NIM


    // hapus mahasiswa data by NIM

}