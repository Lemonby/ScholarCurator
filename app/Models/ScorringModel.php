<?php

namespace App\Models;
use CodeIgniter\Model;

class ScorringModel extends Model
{
    protected $table = 'scorring';
    protected $primaryKey = 'id';
    protected $allowedFields = ['NIM', 'idCriteria', 'value', 'scorringDate'];

    public function submitScorring($data)
    {
        $data['scorringDate'] = date('Y-m-d H:i:s');
        return $this->insert($data);
    }
}