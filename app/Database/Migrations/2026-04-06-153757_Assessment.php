<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Penilaian extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'idAssessment' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'NIM' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'idCriteria' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'score' => [
                'type'       => 'DECIMAL',
                'constraint' => [7, 5],
            ],
        ]);
        $this->forge->addKey('idAssessment', true);
        $this->forge->addForeignKey('NIM', 'mahasiswa', 'NIM', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('idCriteria', 'criteria', 'idCriteria', 'CASCADE', 'CASCADE');
        $this->forge->createTable('assessment');

    }

    public function down()
    {
        //
        $this->forge->dropTable('assessment');
    }
}
