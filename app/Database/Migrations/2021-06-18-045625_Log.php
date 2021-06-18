<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Log extends Migration
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
				'users'       => [
					'type'           => 'INT',
					'constraint'     => 11,
					'unsigned'       => true,
				],
				'keterangan'   => [
					'type'           => 'VARCHAR',
					'constraint'     => '255',
				],
				'asal'   => [
					'type'           => 'VARCHAR',
					'constraint'     => '255',
				],
				'kunci'       => [
					'type'           => 'INT',
					'constraint'     => 11,
					'unsigned'       => true,
				],
				'nama_tabel'       => [
					'type'           => 'VARCHAR',
					'constraint'     => '64',
				],
				'sebelum'    => [
					'type'           => 'TEXT',
					'null'					 => true,
				],
				'sesudah'    => [
					'type'           => 'TEXT',
					'null'					 => true,
				],
				'time'  => [
					'type'           => 'INT',
					'constraint'     => 11,
				],
			]
		);
		$this->forge->addKey('id', true);
		$this->forge->createTable('log');
	}

	public function down()
	{
		$this->forge->dropTable('log');
	}
}
