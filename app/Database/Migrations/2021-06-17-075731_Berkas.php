<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Berkas extends Migration
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
				'kegiatan'   => [
					'type'           => 'INT',
					'constraint'     => 11,
					'unsigned'       => true,
				],
				'nama'   		 => [
					'type'           => 'VARCHAR',
					'constraint'		 => 32,
				],
				'link'   		 => [
					'type'           => 'VARCHAR',
					'constraint'		 => 255,
				],
				'permission' => [
					'type'           => 'ENUM',
					'constraint'     => ['umum', 'mahasiswa', 'anggota', 'pengurus', 'khusus'],
					'default'        => 'pengurus',
				],
				'size'   		 => [
					'type'           => 'VARCHAR',
					'constraint'		 => 32,
					'default'				 => null,
					'null'					 => true
				],
				'create_at'  => [
					'type'           => 'INT',
					'constraint'     => 11,
				],
			]
		);
		$this->forge->addKey('id', true);
		$this->forge->addForeignKey('kegiatan','kegiatan','id','CASCADE','CASCADE');
		$this->forge->createTable('berkas');
	}

	public function down()
	{
		$this->forge->dropTable('berkas');
	}
}
