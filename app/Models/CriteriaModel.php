<?php

namespace App\Models;
use CodeIgniter\Model;

class CriteriaModel extends Model
{
    protected $table = 'criteria';
    protected $primaryKey = 'idCriteria';
    protected $allowedFields = ['criteriaName', 'criteriaWeight', 'criteriaType'];

    public function getAllCriteria()
    {
        return $this->findAll();
    }

    public function sumCriteriaBenefits()
    {
        return (float) ($this->db->table('criteria c')
            ->selectSum('criteriaWeight')
            ->where('criteriaType', 'benefit')
            ->get()
            ->getRow()
            ->criteriaWeight ?? 0);
    }

    public function sumCriteriaCosts()
    {
        return (float) ($this->db->table('criteria c')
            ->selectSum('criteriaWeight')
            ->where('criteriaType', 'cost')
            ->get()
            ->getRow()
            ->criteriaWeight ?? 0);
    }
}


?>