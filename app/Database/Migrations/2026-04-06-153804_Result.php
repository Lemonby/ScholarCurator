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
        ]);
        $this->forge->addKey('idResult', true);
        $this->forge->createTable('result');
    }

    public function down()
    {
        //
        $this->forge->dropTable('result');
    }
}
