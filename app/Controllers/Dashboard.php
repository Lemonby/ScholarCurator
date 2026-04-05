<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
	public function admin()
	{
		if (! session('is_logged_in') || session('user_role') !== 'admin') {
			return redirect()->to('/login');
		}

		return view('DashboardAdmin', [
			'userName' => session('user_name') ?? 'Admin',
			'userEmail' => session('user_email') ?? 'demo@scholarcurator.id',
		]);
	}

	public function mahasiswa()
	{
		if (! session('is_logged_in') || session('user_role') !== 'mahasiswa') {
			return redirect()->to('/login');
		}

		return view('mahasiswa/dashboard', [
			'userName' => session('user_name') ?? 'Mahasiswa',
			'userEmail' => session('user_email') ?? 'mahasiswa@scholarcurator.id',
		]);
	}
}