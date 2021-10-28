<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SettingNotif extends Migration
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
				'user'         => [
					'type'           => 'INT',
					'constraint'     => 11
				],
				'login'         => [
					'type'           => 'INT',
					'constraint'     => 11,
					'default'        => null,
					'null'           => true
				],
				'keg_pan'         => [
					'type'           => 'INT',
					'constraint'     => 11,
					'default'        => null,
					'null'           => true
				],
				'keg_tug'         => [
					'type'           => 'INT',
					'constraint'     => 11,
					'default'        => null,
					'null'           => true
				],
				'keg_ber'         => [
					'type'           => 'INT',
					'constraint'     => 11,
					'default'        => null,
					'null'           => true
				],
				'keg_pes'         => [
					'type'           => 'INT',
					'constraint'     => 11,
					'default'        => null,
					'null'           => true
				],
			]
		);
		$this->forge->addKey('id', true);
		$this->forge->createTable('setting_notif');
	}

	public function down()
	{
		$this->forge->dropTable('setting_notif');
	}
}
