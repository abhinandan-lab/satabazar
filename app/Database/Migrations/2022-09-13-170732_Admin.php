<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Admin extends Migration
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

            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
            ],
            
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 1024,
            ],

            'verify_otp' => [
                'type' => 'VARCHAR',
                'constraint' => 1024,
                'null' => true,

            ],

            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',

        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('admin');
    }

    public function down()
    {
        $this->forge->dropTable('admin');
    }
}
