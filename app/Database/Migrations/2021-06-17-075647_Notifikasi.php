<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Notifikasi extends Migration
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
				'pesan'   => [
					'type'           => 'TEXT',
				],
				'send_at'   => [
					'type'           => 'INT',
					'constraint'     => 11,
				],
				'sent'   => [
					'type'           => 'INT',
					'constraint'     => 11,
					'null'					 => true,
					'default'				 => null
				],
			]
		);
		$this->forge->addKey('id', true);
		$this->forge->addForeignKey('user','users','id','CASCADE','CASCADE');
		$this->forge->createTable('notifikasi');
	}

	public function down()
	{
		$this->forge->dropTable('notifikasi');
	}
}
