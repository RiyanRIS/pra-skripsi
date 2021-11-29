<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kegiatan extends Migration
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
				'nama'       => [
					'type'           => 'VARCHAR',
					'constraint'     => 128,
				],
				'tanggal'   => [
					'type'           => 'INT',
					'constraint'     => 11,
				],
				'lokasi'       => [
					'type'           => 'VARCHAR',
					'constraint'     => 255,
				],
				'penanggungjawab'       => [
					'type'           => 'INT',
					'constraint'     => 11,
					'unsigned'       => true,
				],
				'deskripsi'       => [
					'type'           => 'TEXT',
				],
				'banner'       => [
					'type'           => 'VARCHAR',
					'constraint'     => 128,
					'null'					 => true,
					'default'        => null,
				],
				'cp1'       => [
					'type'           => 'VARCHAR',
					'constraint'     => 128,
				],
				'cp2'       => [
					'type'           => 'VARCHAR',
					'constraint'     => 128,
				],
				'link1'       => [
					'type'           => 'VARCHAR',
					'constraint'     => 128,
				],
				'link2'       => [
					'type'           => 'VARCHAR',
					'constraint'     => 128,
				],
				'jenis'       => [
					'type'           => 'ENUM',
					'constraint'     => ['umum', 'internal'],
					'default'        => 'umum',
				],
				'create_at'  => [
					'type'           => 'INT',
					'constraint'     => 11,
				],
				'update_at'  => [
					'type'           => 'INT',
					'constraint'     => 11,
					'null'					 => true,
				],
				'delete_at'  => [
					'type'           => 'INT',
					'constraint'     => 11,
					'null'					 => true,
				],
			]
		);
		$this->forge->addKey('id', true);
		$this->forge->addForeignKey('penanggungjawab','users','id','CASCADE','CASCADE');
		$this->forge->createTable('kegiatan');
	}

	public function down()
	{
		$this->forge->dropTable('kegiatan');
	}
}
