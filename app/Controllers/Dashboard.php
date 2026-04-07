<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
	private $dashboardAdminModel;

	public function __construct()
	{
		$this->dashboardAdminModel = new \App\Models\DashboardAdminModel();
	}

	public function admin()
	{
		if (! session('isLoggedIn') || session('userRole') !== 'admin') {
			return redirect()->to('/login');
		}

		$mahasiswaCount = $this->dashboardAdminModel->countAllMahasiswa();
		$mahasiswaPassCount = $this->dashboardAdminModel->countMahasiswaPass();
		$mahasiswaFailCount = $this->dashboardAdminModel->countMahasiswaFail();
		$mahasiswaPass = $this->dashboardAdminModel->getMahasiswaPass();

		$criteriaModel = new \App\Models\CriteriaModel();

		$criteriaList = $criteriaModel->getAllCriteria();

		return view('DashboardAdmin', [
			'userName' => session('userName') ?? 'Admin',
			'userEmail' => session('userEmail') ?? 'demo@scholarcurator.id',
			'mahasiswaCount' => $mahasiswaCount,
			'mahasiswaPassCount' => $mahasiswaPassCount,
			'mahasiswaFailCount' => $mahasiswaFailCount,
			'mahasiswaPass' => $mahasiswaPass,
			'criteriaList' => $criteriaList,
		]);
	}

	public function mahasiswa()
	{
		if (! session('isLoggedIn') || session('userRole') !== 'mahasiswa') {
			return redirect()->to('/login');
		}

		return view('DashboardMahasiswa', [
			'userName' => session('userName') ?? 'Mahasiswa',
			'userEmail' => session('userEmail') ?? 'mahasiswa@scholarcurator.id',
		]);
	}
}