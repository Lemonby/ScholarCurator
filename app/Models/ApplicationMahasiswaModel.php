<?php

namespace App\Models;
use CodeIgniter\Model;

class ApplicationMahasiswaModel extends Model
{
    protected $table = 'applications';
    protected $primaryKey = 'id';
    protected $allowedFields = ['NIM', 'GPA', 'ParentIncome', 'NumberOfDependents', 'NonAcademicAchievements', 'applicationDate'];

    public function submitApplication($data)
    {
        $data['applicationDate'] = date('Y-m-d H:i:s');
        return $this->insert($data);
    }
}