<?php 

namespace App\Controllers;
use CodeIgniter\HTTP\RedirectResponse;


class ApplicationsMahasiswa extends BaseController {
    public function apply() {
        if (! session('is_logged_in') || session('user_role') !== 'mahasiswa') {
            return redirect()->to('/login');
        }

        return view('ApplyScholarship', [
            'userName' => session('user_name') ?? 'Admin',
            'userEmail' => session('user_email') ?? 'demo@scholarcurator.id'
        ]);
    }
}

?>