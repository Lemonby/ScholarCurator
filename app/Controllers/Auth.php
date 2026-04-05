<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RedirectResponse;

class Auth extends BaseController
{
	public function login(): string
	{
		return view('LoginPage');
	}

	public function authenticate(): RedirectResponse
	{
		$dummyAccounts = [
			[
				'email' => 'demo@scholarcurator.id',
				'password' => 'password123',
				'name' => 'Demo Admin',
				'role' => 'admin',
				'dashboard' => '/admin/dashboard',
			],
			[
				'email' => 'mahasiswa@scholarcurator.id',
				'password' => 'password123',
				'name' => 'Demo Mahasiswa',
				'role' => 'mahasiswa',
				'dashboard' => '/mahasiswa/dashboard',
			],
		];

		$rules = [
			'email'    => 'required|valid_email',
			'password' => 'required|min_length[6]',
		];

		if (! $this->validate($rules)) {
			return redirect()->to('/login#login')
				->withInput()
				->with('active_tab', 'login')
				->with('login_errors', $this->validator->getErrors());
		}

		$email = (string) $this->request->getPost('email');
		$password = (string) $this->request->getPost('password');
		$matchedAccount = null;

		foreach ($dummyAccounts as $account) {
			if ($account['email'] === $email && $account['password'] === $password) {
				$matchedAccount = $account;
				break;
			}
		}

		if ($matchedAccount === null) {
			return redirect()->to('/login#login')
				->withInput()
				->with('active_tab', 'login')
				->with('login_errors', ['Email atau password dummy tidak sesuai.']);
		}

		session()->set([
			'is_logged_in' => true,
			'user_name' => $matchedAccount['name'],
			'user_email' => $matchedAccount['email'],
			'user_role' => $matchedAccount['role'],
		]);

		return redirect()->to($matchedAccount['DashboardAdmin'] ?? '/dashboard-admin')
			->with('message', 'Login berhasil. Selamat datang, ' . $matchedAccount['name'] . '.');
	}

	public function register(): RedirectResponse
	{
		$rules = [
			'full_name'  => 'required|min_length[3]',
			'university' => 'required|min_length[3]',
			'email'      => 'required|valid_email',
			'password'   => 'required|min_length[6]',
		];

		if (! $this->validate($rules)) {
			return redirect()->to('/login#register')
				->withInput()
				->with('active_tab', 'register')
				->with('register_errors', $this->validator->getErrors());
		}

		// Placeholder until actual user persistence is implemented.
		return redirect()->to('/login#login')
			->with('active_tab', 'login')
			->with('message', 'Registrasi berhasil divalidasi. Integrasi penyimpanan user belum diaktifkan.');
	}

	public function logout(): RedirectResponse
	{
		session()->destroy();

		return redirect()->to('/login')->with('message', 'Kamu sudah logout.');
	}
}
