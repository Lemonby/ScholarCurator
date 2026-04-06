<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MasterSeeder extends Seeder
{
    public function run()
    {
        // Insert Users
        $users = [
            [
                'idUser' => 1,
                'role' => 'admin',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'idUser' => 2,
                'role' => 'mahasiswa',
                'created_at' => date('Y-m-d H:i:s'),
            ]
        ];
        $this->db->table('users')->insertBatch($users);

        // Insert Mahasiswa
        $mahasiswa = [
            [
                'NIM' => 2407411079,
                'idUser' => 1,
                'role' => 'admin',
                'name' => 'Asep Taufiqurahman',
                'major' => 'Informatika',
                'email' => 'asep@scholar.com',
                'password' => password_hash('password123', PASSWORD_BCRYPT),
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'NIM' => 2407411080,
                'idUser' => 2,
                'role' => 'mahasiswa',
                'name' => 'Siti Nurhaliza',
                'major' => 'Sistem Informasi',
                'email' => 'siti@scholar.com',
                'password' => password_hash('password123', PASSWORD_BCRYPT),
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'NIM' => 2407411081,
                'idUser' => 2,
                'role' => 'mahasiswa',
                'name' => 'Budi Santoso',
                'major' => 'Teknik Komputer',
                'email' => 'budi@scholar.com',
                'password' => password_hash('password123', PASSWORD_BCRYPT),
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];
        $this->db->table('mahasiswa')->insertBatch($mahasiswa);

        // Insert Criteria & Weighting
        $criteria = [
            [
                'idCriteria' => 1,
                'criteriaName' => 'IPK (GPA)',
                'criteriaWeight' => 0.40,
            ],
            [
                'idCriteria' => 2,
                'criteriaName' => 'TOEFL Score',
                'criteriaWeight' => 0.30,
            ],
            [
                'idCriteria' => 3,
                'criteriaName' => 'Sertifikat Penghargaan',
                'criteriaWeight' => 0.20,
            ],
            [
                'idCriteria' => 4,
                'criteriaName' => 'Pengalaman Organisasi',
                'criteriaWeight' => 0.10,
            ],
        ];
        $this->db->table('criteria')->insertBatch($criteria);

        // Insert Assessment (Penilaian)
        $assessment = [
            [
                'idAssessment' => 1,
                'NIM' => 2407411079,
                'idCriteria' => 1,
                'score' => 3.75,
            ],
            [
                'idAssessment' => 2,
                'NIM' => 2407411079,
                'idCriteria' => 2,
                'score' => 550.00,
            ],
            [
                'idAssessment' => 3,
                'NIM' => 2407411079,
                'idCriteria' => 3,
                'score' => 85.00,
            ],
            [
                'idAssessment' => 4,
                'NIM' => 2407411080,
                'idCriteria' => 4,
                'score' => 80.00,
            ],
            [
                'idAssessment' => 5,
                'NIM' => 2407411080,
                'idCriteria' => 1,
                'score' => 3.85,
            ],
            [
                'idAssessment' => 6,
                'NIM' => 2407411081,
                'idCriteria' => 2,
                'score' => 580.00,
            ],
            [
                'idAssessment' => 7,
                'NIM' => 2407411081,
                'idCriteria' => 3,
                'score' => 90.00,
            ],
            [
                'idAssessment' => 8,
                'NIM' => 2407411080,
                'idCriteria' => 4,
                'score' => 85.00,
            ],
            [
                'idAssessment' => 9,
                'NIM' => 2407411081,
                'idCriteria' => 1,
                'score' => 3.60,
            ],
            [
                'idAssessment' => 10,
                'NIM' => 2407411081,
                'idCriteria' => 2,
                'score' => 520.00,
            ],
            [
                'idAssessment' => 11,
                'NIM' => 2407411081,
                'idCriteria' => 3,
                'score' => 75.00,
            ],
            [
                'idAssessment' => 12,
                'NIM' => 2407411081,
                'idCriteria' => 4,
                'score' => 70.00,
            ],
        ];
        $this->db->table('assessment')->insertBatch($assessment);

        // Insert Result (Hasil Penilaian Akhir)
        $result = [
            [
                'idResult' => 1,
                'NIM' => 1,
                'finalScore' => 82.35,
            ],
            [
                'idResult' => 2,
                'NIM' => 2,
                'finalScore' => 87.40,
            ],
            [
                'idResult' => 3,
                'NIM' => 3,
                'finalScore' => 75.60,
            ],
        ];
        $this->db->table('result')->insertBatch($result);
    }
}
