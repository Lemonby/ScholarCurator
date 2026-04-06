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
				->with('activeTab', 'login')
				->with('loginErrors', $this->validator->getErrors());
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
				->with('activeTab', 'login')
				->with('loginErrors', ['Email atau password dummy tidak sesuai.']);
		}

		session()->set([
			'is_logged_in' => true,
			'user_name' => $matchedAccount['name'],
			'user_email' => $matchedAccount['email'],
			'user_role' => $matchedAccount['role'],
		]);

		if(! session('is_logged_in') || ! in_array(session('user_role'), ['admin', 'mahasiswa'])) {
			return redirect()->to('/login')
				->with('message', 'Login berhasil, tetapi peran pengguna tidak dikenali.');
		}

		if (session('user_role') === 'admin') {
			return redirect()->to('/admin/dashboard')
				->with('message', 'Login berhasil. Selamat datang, ' . $matchedAccount['name'] . '.');
		} elseif (session('user_role') === 'mahasiswa') {
			return redirect()->to('/mahasiswa/dashboard')
				->with('message', 'Login berhasil. Selamat datang, ' . $matchedAccount['name'] . '.');
		}
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
				->with('activeTab', 'register')
				->with('register_errors', $this->validator->getErrors());
		}

		// Placeholder until actual user persistence is implemented.
		return redirect()->to('/login#login')
			->with('activeTab', 'login')
			->with('message', 'Registrasi berhasil divalidasi. Integrasi penyimpanan user belum diaktifkan.');
	}

	public function logout(): RedirectResponse
	{
		session()->destroy();

		return redirect()->to('/login')->with('message', 'Kamu sudah logout.');
	}
}
