<?php 

namespace App\Controllers;
use CodeIgniter\HTTP\RedirectResponse;

class SubCriteriaList extends BaseController
{
    private $subCriteriaModel;

    public function __construct()
    {
        $this->subCriteriaModel = new \App\Models\SubCriteriaModel();
    }

    public function index()
    {
        if (! session('isLoggedIn') || session('userRole') !== 'admin') {
            return redirect()->to('/login');
        }

        $allSub = $this->subCriteriaModel->getAllSubCriteria();

        $criteriaWithCode = [];
        foreach($allSub as $index => $subCriteria) {
            $subCriteria['subCriteriaCode'] = 'SC' . ($index + 1);
            $criteriaWithCode[] = $subCriteria;
        }

        return view('admin/SubCriteriaListView', [
            'userName' => session('userName') ?? 'Admin',
            'userEmail' => session('userEmail') ?? 'admin@example.com',
            'subCriteriaList' => $criteriaWithCode  
        ]);
    }
}

?>