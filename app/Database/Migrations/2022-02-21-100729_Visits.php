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
            'from'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'to'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
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
