<?php

namespace App\Models;
use CodeIgniter\Model;

class AssessmentModel extends Model
{
    protected $table = 'assessment';
    protected $primaryKey = 'idAssessment';
    protected $allowedFields = ['NIM', 'idCriteria', 'score'];

    public function getAssessmentByNIM($NIM)
    {
        return $this->db->table($this->table)
            ->where('NIM', $NIM)
            ->get()
            ->getResultArray();
    }

    // get all assessments with score
    public function getAllAssessments()
    {
        return $this->db->table('assessment a')
            ->select('a.*, m.name, c.criteriaWeight, c.criteriaType')
            ->join('mahasiswa m', 'm.NIM = a.NIM', 'left')
            ->join('criteria c', 'c.idCriteria = a.idCriteria', 'left')
            ->get()
            ->getResultArray();
    }
    
}