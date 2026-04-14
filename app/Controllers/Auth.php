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
			'fullName'  => 'required|min_length[3]',
			'nim'       => 'required|numeric|is_unique[mahasiswa.NIM]',
			'major'     => 'required|min_length[2]',
			'email'     => 'required|valid_email|is_unique[mahasiswa.email]',
			'password'  => 'required|min_length[6]',
		];

		if (! $this->validate($rules)) {
			return redirect()->to('/login#register')
				->withInput()
				->with('activeTab', 'register')
				->with('register_errors', $this->validator->getErrors());
		}

		$data = [
			'fullName' => $this->request->getPost('fullName'),
			'nim'      => $this->request->getPost('nim'),
			'major'    => $this->request->getPost('major'),
			'email'    => $this->request->getPost('email'),
			'password' => $this->request->getPost('password'),
		];

		try {
			if ($this->loginModel->createMahasiswa($data)) {
				return redirect()->to('/login#login')
					->with('activeTab', 'login')
					->with('message', 'Registrasi berhasil! Silakan login dengan email dan password Anda.');
			} else {
				return redirect()->to('/login#register')
					->withInput()
					->with('activeTab', 'register')
					->with('register_errors', ['Terjadi kesalahan saat menyimpan data. Silakan coba lagi.']);
			}
		} catch (\Exception $e) {
			return redirect()->to('/login#register')
				->withInput()
				->with('activeTab', 'register')
				->with('register_errors', ['Terjadi kesalahan: ' . $e->getMessage()]);
		}
	}

	public function logout(): RedirectResponse
	{
		session()->destroy();

		return redirect()->to('/login')->with('message', 'Kamu sudah logout.');
	}
}
