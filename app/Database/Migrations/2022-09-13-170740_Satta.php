<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Satta extends Migration
{
    public function up()
    {
                
        $this->forge->addField([
            'id' => [
                    'type' => 'INT',
                    'constraint' => 5,
                    // 'unsigned' => TRUE,
                    'auto_increment' => TRUE
            ],

            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
            ],

            'satta_number' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
            ],
            
            'start_time' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
            ],

            'end_time' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
            ],

            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',

        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('satta');
    }

    public function down()
    {
        $this->forge->dropTable('satta');
    }
}
