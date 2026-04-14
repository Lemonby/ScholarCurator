<?php

namespace App\Models;
use CodeIgniter\Model;

class SubCriteriaModel extends Model
{
    protected $table = 'subCriteria';
    protected $primaryKey = 'idSub';
    protected $allowedFields = ['idCriteria', 'subName', 'variableValue', 'comment'];

    public function getAllSubCriteria()
    {
        return $this->db->table('subCriteria s')
            ->select('s.idSub, s.idCriteria, s.subName, s.variableValue, s.comment, c.criteriaName')
            ->join('criteria c', 'c.idCriteria = s.idCriteria', 'left')
            ->orderBy('s.idSub', 'ASC')
            ->get()
            ->getResultArray();
    }
}