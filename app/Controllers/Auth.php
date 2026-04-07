<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RedirectResponse;
use App\Models\LoginModel;

class Auth extends BaseController
{
	private $loginModel;

	public function __construct()
	{
		$this->loginModel = new LoginModel();
	}

	public function login(): string
	{
		return view('LoginPage');
	}

	public function authenticate(): RedirectResponse
	{

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

		$user = $this->loginModel->getUserByEmail($email);

		if ($user && password_verify($password, $user['password'])) {
			$matchedAccount = $user;
		}

		if ($matchedAccount === null) {
			return redirect()->to('/login#login')
				->withInput()
				->with('activeTab', 'login')
				->with('loginErrors', ['Email atau password dummy tidak sesuai.']);
		}

		session()->set([
			'isLoggedIn' => true,
			'userName' => $matchedAccount['name'],
			'userEmail' => $matchedAccount['email'],
			'userRole' => $matchedAccount['role'],
		]);

		if(! session('isLoggedIn') || ! in_array(session('userRole'), ['admin', 'mahasiswa'])) {
			return redirect()->to('/login')
				->with('message', 'Login berhasil, tetapi peran pengguna tidak dikenali.');
		}

		if (session('userRole') === 'admin') {
			return redirect()->to('/admin/dashboard')
				->with('message', 'Login berhasil. Selamat datang, ' . $matchedAccount['name'] . '.');
		} elseif (session('userRole') === 'mahasiswa') {
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
