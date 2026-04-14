<?php 

namespace App\Controllers;
use CodeIgniter\HTTP\RedirectResponse;


class ApplicationsMahasiswa extends BaseController {
    public function apply() {
        if (! session('isLoggedIn') || session('userRole') !== 'mahasiswa') {
            return redirect()->to('/login');
        }

        return view('mahasiswa/ApplyScholarship', [
            'userName' => session('userName') ?? 'Admin',
            'userEmail' => session('userEmail') ?? 'demo@scholarcurator.id'
        ]);
    }

    public function submitApplication(): RedirectResponse
    {
        if (! session('isLoggedIn') || session('userRole') !== 'mahasiswa') {
            return redirect()->to('/login');
        }

        // Here you would typically handle the form submission, validate the input,
        // and save the application data to the database.

        $gpa = $this->request->getPost('GPA');
        $parentIncome = $this->request->getPost('ParentIncome');
        $numberOfDependents = $this->request->getPost('NumberOfDependents');
        $nonAcademicAchievements = $this->request->getPost('NonAcademicAchievements');

        
        return redirect()->to('/apply')
            ->with('successMessage', 'Your scholarship application has been submitted successfully!');
    }


}
