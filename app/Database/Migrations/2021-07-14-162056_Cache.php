<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Cache extends Migration
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
				'chatid'       => [
					'type'           => 'VARCHAR',
					'constraint'     => 11,
				],
				'nama'       => [
					'type'           => 'VARCHAR',
					'constraint'     => 255,
				],
				'status'       => [
					'type'           => 'INT',
					'constraint'     => 1,
				]
			]
		);
		$this->forge->addKey('id', true);
		$this->forge->createTable('cache');
	}

	public function down()
	{
		$this->forge->dropTable('cache');
	}
}
