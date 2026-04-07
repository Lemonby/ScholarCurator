<?php

namespace App\Models;
use CodeIgniter\Model;

class ResultModel extends Model
{
    protected $table = 'result';
    protected $primaryKey = 'idResult';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['NIM', 'finalScore', 'status', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $dateFormat    = 'datetime';

    /**
     * Insert atau update result berdasarkan NIM
     */
    public function upsertResult($NIM, $finalScore, $status)
    {
        $existingResult = $this->where('NIM', $NIM)->first();

        if ($existingResult) {
            // Update existing result
            return $this->update($existingResult['idResult'], [
                'finalScore' => $finalScore,
                'status' => $status
            ]);
        } else {
            // Insert new result
            return $this->insert([
                'NIM' => $NIM,
                'finalScore' => $finalScore,
                'status' => $status
            ]);
        }
    }

    /**
     * Get result by NIM
     */
    public function getResultByNIM($NIM)
    {
        return $this->where('NIM', $NIM)->first();
    }

    /**
     * Get all results with ranking
     */
    public function getAllResults()
    {
        return $this->orderBy('finalScore', 'DESC')->findAll();
    }

    /**
     * Count hasil pass
     */
    public function countPass()
    {
        return $this->where('status', 'pass')->countAllResults();
    }

    /**
     * Count hasil fail
     */
    public function countFail()
    {
        return $this->where('status', 'fail')->countAllResults();
    }

    /**
     * Delete result by NIM
     */
    public function deleteResultByNIM($NIM)
    {
        return $this->where('NIM', $NIM)->delete();
    }
}
