<?php

namespace App\Controllers;
use App\Controllers\BaseController;

class CriteriaList extends BaseController
{
    private $criteriaModel;

    public function __construct()
    {
        $this->criteriaModel = new \App\Models\CriteriaModel();
    }

    public function index()
    {
        // Authorization check
        if (!session('isLoggedIn') || session('userRole') !== 'admin') {
            return redirect()->to('/login');
        }

        $allCriteria = $this->criteriaModel->getAllCriteria();
        
        // Add code labels (C1, C2, C3, C4, etc.)
        $criteriaWithCode = [];
        foreach ($allCriteria as $index => $criteria) {
            $criteria['criteriaCode'] = 'C' . ($index + 1);
            $criteriaWithCode[] = $criteria;
        }

        // Get subcriteria data
        $subcriteriaList = $this->criteriaModel->getAllSubCriteria();

        return view('CriteriaListView', [
            'userName' => session('userName') ?? 'admin',
            'userEmail' => session('userEmail') ?? 'asep@scholar.com',
            'criteriaList' => $criteriaWithCode,
            'subcriteriaList' => $subcriteriaList ?? [],
            'totalCriteria' => count($criteriaWithCode),
            'totalWeight' => array_sum(array_column($criteriaWithCode, 'criteriaWeight'))
        ]);
    }

    public function delete($criteriaId = null)
    {
        if (!session('isLoggedIn') || session('userRole') !== 'admin') {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Unauthorized access'
            ])->setStatusCode(401);
        }

        if (!$criteriaId) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Criteria ID is required'
            ])->setStatusCode(400);
        }

        try {
            $deleteResult = $this->criteriaModel->delete($criteriaId);

            if ($deleteResult) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Criteria deleted successfully'
                ])->setStatusCode(200);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Failed to delete criteria'
                ])->setStatusCode(500);
            }
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ])->setStatusCode(500);
        }
    }
}
