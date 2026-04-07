<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Hasil extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'idResult' => [
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
            'finalScore' => [
                'type'       => 'DECIMAL',
                'constraint' => [7, 2],
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['pass', 'fail'],
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('idResult', true);
        $this->forge->addForeignKey('NIM', 'mahasiswa', 'NIM', 'CASCADE', 'CASCADE');
        $this->forge->createTable('result');
    }

    public function down()
    {
        //
        $this->forge->dropTable('result');
    }
}
