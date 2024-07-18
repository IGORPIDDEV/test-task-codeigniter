<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_items extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => FALSE,
            ),
            'category_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => FALSE,
            ),
            'status' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
            ),
            'created_at datetime default current_timestamp',
    		'updated_at datetime default current_timestamp on update current_timestamp',
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('items');
    }

    public function down() {
        $this->dbforge->drop_table('items');
    }
}
