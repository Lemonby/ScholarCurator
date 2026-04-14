<?php

namespace App\Controllers;
use App\Controllers\BaseController;


Class Admissions extends BaseController{
    private $admissionsModel;
    private $criteriaModel;
    private $assessmentModel;
    private $resultModel;


    public function __construct()
    {
        $this->admissionsModel = new \App\Models\AdmissionModel();
        $this->criteriaModel = new \App\Models\CriteriaModel();
        $this->assessmentModel = new \App\Models\AssessmentModel();
        $this->resultModel = new \App\Models\ResultModel();
    }
    public function index()
    {
        if (! session('isLoggedIn') || session('userRole') !== 'admin') {
            return redirect()->to('/login');
        }

        // Flag untuk tracking error
        $errors = [];
        $hasilRanking = [];

        try {
            // 1. ambil semua kriteria dan bobotnya
            $kriteria = $this->criteriaModel->getAllCriteria();
            if (empty($kriteria)) {
                $errors['KRITERIA_KOSONG'] = 'ERROR: Tidak ada kriteria di database';
            }

            // 2. Ambil Data Mahasiswa beserta Skor Assessment-nya
            $mahasiswaData = $this->assessmentModel->getAllAssessments();
            if (empty($mahasiswaData)) {
                $errors['DATA_MAHASISWA_KOSONG'] = 'WARNING: Tidak ada data assessment';
            }

            // Ubah kriteria jadi key-value array untuk pencarian lebih cepat
            $kriteriaMap = [];
            foreach ($kriteria as $k) {
                $kriteriaMap[$k['idCriteria']] = $k;
            }

            // 3. Cari Nilai MAX dan MIN untuk setiap kriteria (untuk Normalisasi)
            $minMax = [];
            foreach ($kriteria as $k) {
                try {
                    $scores = $this->assessmentModel->where('idCriteria', $k['idCriteria'])->findColumn('score');
                    if ($scores) {
                        $minMax[$k['idCriteria']] = [
                            'max' => max($scores),
                            'min' => min($scores)
                        ];
                    } else {
                        $errors['SKOR_KOSONG_' . $k['idCriteria']] = "WARNING: Kriteria '{$k['criteriaName']}' tidak punya score";
                    }
                } catch (\Exception $e) {
                    $errors['ERROR_MINMAX_' . $k['idCriteria']] = "ERROR: MinMax kriteria {$k['idCriteria']}: " . $e->getMessage();
                }
            }

            // 4. Group Assessment by NIM untuk efisiensi
            $assessmentByNIM = [];
            foreach ($mahasiswaData as $assessment) {
                $nim = $assessment['NIM'];
                if (!isset($assessmentByNIM[$nim])) {
                    $assessmentByNIM[$nim] = [];
                }
                $assessmentByNIM[$nim][] = $assessment;
            }

            // 5. Proses Perhitungan SAW
            foreach ($mahasiswaData as $m) {
                $nim = $m['NIM'];
                
                try {
                    // Skip jika mahasiswa tidak ada di grouping
                    if (!isset($assessmentByNIM[$nim])) {
                        $errors['NIM_TIDAK_DITEMUKAN_' . $nim] = "WARNING: NIM {$nim} tidak memiliki assessment";
                        continue;
                    }

                    $totalScore = 0;
                    $assessment = $assessmentByNIM[$nim];
                    $skorCount = 0;

                    foreach ($assessment as $row) {
                        $idC = $row['idCriteria'];
                        
                        try {
                            // Validasi: cek apakah kriteria ada dan minMax ada
                            if (!isset($kriteriaMap[$idC])) {
                                $errors['KRITERIA_TIDAK_DITEMUKAN_' . $idC] = "ERROR: Kriteria {$idC} tidak ditemukan untuk NIM {$nim}";
                                continue;
                            }

                            if (!isset($minMax[$idC])) {
                                $errors['MINMAX_TIDAK_ADA_' . $idC . '_' . $nim] = "ERROR: MinMax tidak tersedia untuk kriteria {$idC} pada NIM {$nim}";
                                continue;
                            }

                            $currentKriteria = $kriteriaMap[$idC];
                            $weight = $currentKriteria['criteriaWeight'];
                            $type   = $currentKriteria['criteriaType'];

                            // Validasi bobot
                            if ($weight <= 0) {
                                $errors['BOBOT_INVALID_' . $idC] = "WARNING: Bobot kriteria {$idC} tidak valid: {$weight}";
                                continue;
                            }

                            // Rumus Normalisasi R
                            $r_ij = 0;
                            if ($type == 'benefit') {
                                // Jaga dari division by zero
                                if ($minMax[$idC]['max'] > 0) {
                                    $r_ij = $row['score'] / $minMax[$idC]['max'];
                                } else {
                                    $errors['MAX_ZERO_' . $idC] = "WARNING: Max score 0 untuk kriteria benefit {$idC}";
                                }
                            } else if ($type == 'cost') { // cost
                                // Jaga dari division by zero
                                if ($row['score'] > 0) {
                                    $r_ij = $minMax[$idC]['min'] / $row['score'];
                                } else {
                                    $errors['SCORE_ZERO_' . $nim . '_' . $idC] = "ERROR: Score 0 untuk cost criteria {$idC} pada NIM {$nim}";
                                    continue;
                                }
                            } else {
                                $errors['TIPE_KRITERIA_INVALID_' . $idC] = "ERROR: Tipe kriteria {$idC} tidak valid: {$type}";
                                continue;
                            }

                            // Preferensi V = R * W
                            $totalScore += ($r_ij * $weight);
                            $skorCount++;

                        } catch (\Exception $e) {
                            $errors['ERROR_KALKULASI_' . $nim . '_' . $idC] = "ERROR: Kalkulasi SAW NIM {$nim} kriteria {$idC}: " . $e->getMessage();
                        }
                    }

                    if ($skorCount > 0) {
                        $hasilRanking[] = [
                            'NIM'   => $m['NIM'],
                            'name'  => $m['name'],
                            'score' => round($totalScore, 4)
                        ];
                    } else {
                        $errors['SKOR_COUNT_ZERO_' . $nim] = "WARNING: NIM {$nim} tidak memiliki skor valid yang dihitung";
                    }

                } catch (\Exception $e) {
                    $errors['ERROR_NIM_' . $nim] = "ERROR: Proses NIM {$nim}: " . $e->getMessage();
                }
            }

            // 6. Urutkan Ranking (Descending) / besar ke kecil
            usort($hasilRanking, function ($a, $b) {
                return $b['score'] <=> $a['score'];
            });

            // 7. Insert/Update ke Result Table
            try {
                
                // IMPORTANT: Deduplikasi ranking by NIM (ambil skor tertinggi jika duplikat)
                // Karena setiap NIM bisa punya banyak assessment rows (1 per kriteria)
                $uniqueRanking = [];
                $processedNIMs = [];
                foreach ($hasilRanking as $ranking) {
                    if (!in_array($ranking['NIM'], $processedNIMs)) {
                        $uniqueRanking[] = $ranking;
                        $processedNIMs[] = $ranking['NIM'];
                    }
                }
                $hasilRanking = $uniqueRanking;
                
                // Clear semua result lama terlebih dahulu
                // agar tidak ada data stale yang tertinggal dengan status lama
                $this->resultModel->truncate();

                $passThreshold = 5; // Top 5 pass
                foreach ($hasilRanking as $index => $ranking) {
                    $rank = $index + 1; // Rank dimulai dari 1
                    $status = ($rank <= $passThreshold) ? 'pass' : 'fail';
                    $finalScore = $ranking['score'];

                    try {
                        $this->resultModel->upsertResult(
                            $ranking['NIM'],
                            $finalScore,
                            $status
                        );
                    } catch (\Exception $e) {
                        $errors['ERROR_INSERT_RESULT_' . $ranking['NIM']] = "ERROR: Insert ke Result NIM {$ranking['NIM']}: " . $e->getMessage();
                    }
                }
            } catch (\Exception $e) {
                $errors['ERROR_INSERT_ALL_RESULT'] = "ERROR: Insert semua Result: " . $e->getMessage();
            }

            // Log semua error
            if (!empty($errors)) {
                \log_message('error', 'ADMISSIONS PAGE ERRORS: ' . json_encode($errors));
            }

        } catch (\Exception $e) {
            $errors['FATAL_ERROR'] = "FATAL ERROR: " . $e->getMessage();
            \log_message('error', 'FATAL ERROR in Admissions::index - ' . $e->getMessage() . ' at ' . $e->getFile() . ':' . $e->getLine());
        }

        // Get dashboard counts
        $dataMahasiswa = $this->admissionsModel->getAllMahasiswa();
        $mahasiswaCount = $this->admissionsModel->countAllMahasiswa();
        $mahasiswaPassCount = $this->admissionsModel->countMahasiswaPass();
        $mahasiswaFailCount = $this->admissionsModel->countMahasiswaFail();

        // Pagination setup
        $itemsPerPage = 5;
        $currentPage = (int) ($this->request->getGet('page') ?? 1);
        $totalPages = ceil($mahasiswaCount / $itemsPerPage);
        
        // Validasi current page
        if ($currentPage < 1) $currentPage = 1;
        if ($currentPage > $totalPages && $totalPages > 0) $currentPage = $totalPages;
        
        // Hitung start offset
        $startIndex = ($currentPage - 1) * $itemsPerPage;
        
        // Slice data untuk page tersebut
        $paginatedMahasiswa = array_slice($dataMahasiswa, $startIndex, $itemsPerPage);

        return view('admin/AdmissionsAdmin', [
            'userName' => session('userName') ?? 'Admin',
            'userEmail' => session('userEmail') ?? 'admin@example.com',
            'mahasiswaList' => $paginatedMahasiswa,
            'mahasiswaCount' => $mahasiswaCount,
            'mahasiswaPassCount' => $mahasiswaPassCount,
            'mahasiswaFailCount' => $mahasiswaFailCount,
            'hasilRanking' => $hasilRanking,
            'errors' => $errors,
            'currentPage' => $currentPage,
            'totalPages' => $totalPages,
            'itemsPerPage' => $itemsPerPage,
            'startIndex' => $startIndex
        ]);
    }

    public function update()
    {
        // Check if user is logged in and is admin
        if (!session('isLoggedIn') || session('userRole') !== 'admin') {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Unauthorized access'
            ])->setStatusCode(401);
        }

        $request = $this->request->getJSON();
        $nim = $request->nim ?? null;
        $name = $request->name ?? null;
        $email = $request->email ?? null;
        $major = $request->major ?? null;

        // Validate input
        if (!$nim || !$name || !$email || !$major) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'All fields are required'
            ])->setStatusCode(400);
        }

        // Update mahasiswa data
        $updateResult = $this->admissionsModel->update($nim, [
            'name' => $name,
            'email' => $email,
            'major' => $major
        ]);

        if ($updateResult) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Student data updated successfully'
            ])->setStatusCode(200);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to update student data'
            ])->setStatusCode(500);
        }
    }

    public function delete()
    {
        // Check if user is logged in and is admin
        if (!session('isLoggedIn') || session('userRole') !== 'admin') {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Unauthorized access'
            ])->setStatusCode(401);
        }

        $request = $this->request->getJSON();
        $nim = $request->nim ?? null;

        // Validate input
        if (!$nim) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'NIM is required'
            ])->setStatusCode(400);
        }

        // Delete mahasiswa data
        $deleteResult = $this->admissionsModel->delete($nim);

        if ($deleteResult) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Student deleted successfully'
            ])->setStatusCode(200);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to delete student'
            ])->setStatusCode(500);
        }
    }
}