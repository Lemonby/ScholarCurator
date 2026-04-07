<?php

namespace App\Models;
use CodeIgniter\Model;

class CriteriaModel extends Model
{
    protected $table = 'criteria';
    protected $primaryKey = 'id';
    protected $allowedFields = ['CriteriaName', 'criteriaWeight', 'criteriaType'];

    public function getAllCriteria()
    {
        return $this->findAll();
    }

    public function sumCriteriaBenefits()
    {
        return (float) ($this->db->table($this->table)
            ->selectSum('criteriaWeight')
            ->where('criteriaType', 'benefit')
            ->get()
            ->getRow()
            ->criteriaWeight ?? 0);
    }

    public function sumCriteriaCosts()
    {
        return (float) ($this->db->table($this->table)
            ->selectSum('criteriaWeight')
            ->where('criteriaType', 'cost')
            ->get()
            ->getRow()
            ->criteriaWeight ?? 0);
    }
}


?>