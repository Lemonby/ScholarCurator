<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kriteria extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'idCriteria' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'criteriaName' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'criteriaWeight' => [
                'type'       => 'DECIMAL',
                'constraint' => [3, 2],
            ],
            'criteriaType' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'default'    => 'benefit',
            ],
        ]);
        $this->forge->addKey('idCriteria', true);
        $this->forge->createTable('criteria');
    }

    public function down()
    {
        //
        $this->forge->dropTable('criteria');
    }
}
