<?php

namespace App\Controllers;
use App\Controllers\BaseController;

Class Admissions extends BaseController{
    public function index()
    {
        if (! session('is_logged_in') || session('user_role') !== 'admin') {
            return redirect()->to('/login');
        }

        return view('AdmissionsAdmin', [
            'userName' => session('user_name') ?? 'Admin',
            'userEmail' => session('user_email') ?? 'admin@example.com'
        ]);
    }
}