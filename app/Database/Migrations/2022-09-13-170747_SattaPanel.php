<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SattaPanel extends Migration
{
    public function up()
    {
        
        $this->forge->addField([
            'id' => [
                    'type' => 'INT',
                    'constraint' => 5,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
            ],
            
            'satta_number' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],

            'current_date' => [
                'type' => 'VARCHAR',
                'constraint' => 25,
                'null' => true,
            ],


            'satta_id' => [
                'type' => 'INT',
                'constraint' => 5,
            ],

            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',

        ]);

        $db = db_connect();

        $this->forge->addKey('id', true);
        $this->forge->createTable('satta_panel');

        // $db->query("ALTER TABLE `user_info` ADD FOREIGN KEY ('user_id') REFERENCES `user`(`id`) ON DELETE CASCADE ON UPDATE NO ACTION;");
        // $db->query("ALTER TABLE `satta_panel` ADD FOREIGN KEY (`satta_id`) REFERENCES `satta`(`id`) ON DELETE CASCADE ON UPDATE CASCADE ; ");

    }

    public function down()
    {
        $this->forge->dropTable('satta_panel');
    }
}
