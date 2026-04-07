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

        return view('ApplicationAdmin', [
            'userName' => session('userName') ?? 'Admin',
            'userEmail' => session('userEmail') ?? 'demo@scholarcurator.id',
            'criteriaBenefits' => $this->criteriaModel->sumCriteriaBenefits(),
            'criteriaCosts' => $this->criteriaModel->sumCriteriaCosts()
        ]);
    }
}