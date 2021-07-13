<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tugas extends Migration
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
				'kegiatan'       => [
					'type'           => 'INT',
					'constraint'     => 11,
					'unsigned'       => true,
				],
				'tugas'       => [
					'type'           => 'VARCHAR',
					'constraint'     => 255,
				],
				'deadline'       => [
					'type'           => 'INT',
					'constraint'     => 11,
				],
				'status'       => [
					'type'           => 'INT',
					'constraint'     => 1,
				]
			]
		);
		$this->forge->addKey('id', true);
		$this->forge->addForeignKey('kegiatan','kegiatan','id','CASCADE','CASCADE');
		$this->forge->createTable('tugas');
	}

	public function down()
	{
		$this->forge->dropTable('tugas');
	}
}
