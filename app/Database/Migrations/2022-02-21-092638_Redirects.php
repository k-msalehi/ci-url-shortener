<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Redirects extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                //'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
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
        $this->forge->addKey('from', false,true);

        $this->forge->createTable('redirects');
    }

    public function down()
    {
        $this->forge->dropTable('redirects');
    }
}
