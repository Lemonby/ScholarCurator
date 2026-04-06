<?php  

namespace App\Controllers;
use CodeIgniter\HTTP\RedirectResponse;

class ApplicationsAdmin extends BaseController{
    public function index()
    {
        if (! session('is_logged_in') || session('user_role') !== 'admin') {
            return redirect()->to('/login');
        }

        return view('ApplicationAdmin', [
            'userName' => session('user_name') ?? 'Admin',
            'userEmail' => session('user_email') ?? 'demo@scholarcurator.id'
        ]);
    }
}