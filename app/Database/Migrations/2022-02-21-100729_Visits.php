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
            'user_id'          => [
                'type'           => 'VARCHAR',
                'constraint' => '23',
            ],
            'os'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'browser'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'referrer'       => [
                'type'       => 'VARCHAR',
                'constraint' => '500',
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
