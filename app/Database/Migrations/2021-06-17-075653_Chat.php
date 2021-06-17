<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Chat extends Migration
{
	public function up()
	{
		$this->forge->addField(
			[
				'id'         => [
					'type'           => 'INT',
					'constraint'     => 11,
					'unsigned'       => true,
					'auto_increment' => true,
				],
				'user'       => [
					'type'           => 'INT',
					'constraint'     => 11,
					'unsigned'       => true,
				],
				'jenis'   => [
					'type'           => 'INT',
					'constraint'     => 11,
				],
				'pesan'   => [
					'type'           => 'TEXT',
				],
			]
		);
		$this->forge->addKey('id', true);
		$this->forge->addForeignKey('user','users','id','CASCADE','CASCADE');
		$this->forge->createTable('chat');
	}

	public function down()
	{
		$this->forge->dropTable('chat');
	}
}
