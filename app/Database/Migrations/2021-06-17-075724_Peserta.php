<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Peserta extends Migration
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
				'user'       => [
					'type'           => 'INT',
					'constraint'     => 11,
					'unsigned'       => true,
				],
				'tgl_daftar'   => [
					'type'           => 'INT',
					'constraint'		 => 11,
				],
				'hadir'   => [
					'type'           => 'INT',
					'constraint'     => 1,
				],
			]
		);
		$this->forge->addKey('id', true);
		$this->forge->addForeignKey('kegiatan','kegiatan','id','CASCADE','CASCADE');
		$this->forge->addForeignKey('user','users','id','CASCADE','CASCADE');
		$this->forge->createTable('peserta');
	}

	public function down()
	{
		$this->forge->dropTable('peserta');
	}
}
