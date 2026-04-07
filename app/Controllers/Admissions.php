<?php

namespace App\Controllers;
use App\Controllers\BaseController;

Class Admissions extends BaseController{
    private $admissionsModel;

    public function __construct()
    {
        $this->admissionsModel = new \App\Models\AdmissionModel();
    }
    public function index()
    {
        if (! session('isLoggedIn') || session('userRole') !== 'admin') {
            return redirect()->to('/login');
        }

        $dataMahasiswa = $this->admissionsModel->getAllMahasiswa();
        $mahasiswaCount = $this->admissionsModel->countAllMahasiswa();
        $mahasiswaPassCount = $this->admissionsModel->countMahasiswaPass();
        $mahasiswaFailCount = $this->admissionsModel->countMahasiswaFail();

        return view('AdmissionsAdmin', [
            'userName' => session('userName') ?? 'Admin',
            'userEmail' => session('userEmail') ?? 'admin@example.com',
            'mahasiswaList' => $dataMahasiswa,
            'mahasiswaCount' => $mahasiswaCount,
            'mahasiswaPassCount' => $mahasiswaPassCount,
            'mahasiswaFailCount' => $mahasiswaFailCount
        ]);
    }
}