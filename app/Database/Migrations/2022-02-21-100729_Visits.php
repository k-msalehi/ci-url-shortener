<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Visits extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'redirect_id'          => [
                'type'           => 'INT',
                'unsigned'       => true,
            ],
            'os'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'browser'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'extra'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'created_at'       => [
                'type'       => 'datetime',
            ],
            'updated_at'       => [
                'type'       => 'datetime',
            ],

        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('redirect_id', 'redirects', 'id');
        $this->forge->createTable('visits');
    }

    public function down()
    {
        $this->forge->dropTable('visits');
    }
}
