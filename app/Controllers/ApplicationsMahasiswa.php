<?php 

namespace App\Controllers;
use CodeIgniter\HTTP\RedirectResponse;


class ApplicationsMahasiswa extends BaseController {
    public function apply() {
        if (! session('isLoggedIn') || session('userRole') !== 'mahasiswa') {
            return redirect()->to('/login');
        }

        return view('ApplyScholarship', [
            'userName' => session('userName') ?? 'Admin',
            'userEmail' => session('userEmail') ?? 'demo@scholarcurator.id'
        ]);
    }
}

?>