<?php  

namespace App\Controllers;
use CodeIgniter\HTTP\RedirectResponse;

class ApplicationsAdmin extends BaseController{
    private $criteriaModel;
    public function __construct()
    {
        $this->criteriaModel = new \App\Models\CriteriaModel();
    }
    public function index()
    {
        if (! session('isLoggedIn') || session('userRole') !== 'admin') {
            return redirect()->to('/login');
        }

        return view('admin/ApplicationAdmin', [
            'userName' => session('userName') ?? 'Admin',
            'userEmail' => session('userEmail') ?? 'demo@scholarcurator.id',
            'criteriaList' => $this->criteriaModel->getAllCriteria(),
            'criteriaBenefits' => $this->criteriaModel->sumCriteriaBenefits(),
            'criteriaCosts' => $this->criteriaModel->sumCriteriaCosts()
        ]);
    }

    public function updateCriteria()
    {
        // Check if user is logged in and is admin
        if (!session('isLoggedIn') || session('userRole') !== 'admin') {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Unauthorized access'
            ])->setStatusCode(401);
        }

        $request = $this->request->getJSON();
        $criteriaId = $request->criteriaId ?? null;
        $newWeight = $request->weight ?? null;
        $criteriaType = $request->criteriaType ?? null;

        // Validate input
        if (!$criteriaId || $newWeight === null) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Missing required parameters'
            ])->setStatusCode(400);
        }

        // Validate criteria type
        if ($criteriaType && !in_array(strtolower($criteriaType), ['benefit', 'cost'])) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid criteria type. Must be either "benefit" or "cost"'
            ])->setStatusCode(400);
        }

        $newWeight = (float) $newWeight;

        // Validate weight value
        if ($newWeight < 0 || $newWeight > 1) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Weight must be between 0 and 1'
            ])->setStatusCode(400);
        }

        // Get current criteria
        $currentCriteria = $this->criteriaModel->find($criteriaId);
        if (!$currentCriteria) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Criteria not found'
            ])->setStatusCode(404);
        }

        // Calculate total weight with new value (excluding current criteria)
        $totalWithoutCurrent = 0;
        $allCriteria = $this->criteriaModel->getAllCriteria();
        foreach ($allCriteria as $criteria) {
            if ($criteria['idCriteria'] !== $criteriaId) {
                $totalWithoutCurrent += (float) $criteria['criteriaWeight'];
            }
        }

        $totalWeight = $totalWithoutCurrent + $newWeight;

        // Validate total weight doesn't exceed 1.0
        if ($totalWeight > 1.0) {
            $totalPercent = (int)($totalWeight * 100);
            return $this->response->setJSON([
                'success' => false,
                'message' => "Total weight would be {$totalPercent}%. Maximum is 100%",
                'currentTotal' => $totalPercent
            ])->setStatusCode(400);
        }

        // Prepare update data
        $updateData = [
            'criteriaWeight' => $newWeight
        ];

        // Add criteria type if provided
        if ($criteriaType) {
            $updateData['criteriaType'] = ucfirst(strtolower($criteriaType));
        }

        // Update criteria
        $updateResult = $this->criteriaModel->update($criteriaId, $updateData);

        if ($updateResult) {
            $newBenefits = $this->criteriaModel->sumCriteriaBenefits();
            $newCosts = $this->criteriaModel->sumCriteriaCosts();
            
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Criteria updated successfully',
                'newBenefits' => $newBenefits,
                'newCosts' => $newCosts
            ])->setStatusCode(200);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to update criteria'
            ])->setStatusCode(500);
        }
    }
}