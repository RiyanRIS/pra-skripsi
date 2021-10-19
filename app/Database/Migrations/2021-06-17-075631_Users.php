<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
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
					'constraint'     => '64',
				],
				'username'   => [
					'type'           => 'VARCHAR',
					'constraint'     => '16',
				],
				'password'   => [
					'type'           => 'VARCHAR',
					'constraint'     => '64',
				],
				'role'       => [
					'type'           => 'ENUM',
					'constraint'     => ['admin', 'pengurus', 'pengawas', 'peserta'],
					'default'        => 'peserta',
				],
				'nohp'       => [
					'type'           => 'VARCHAR',
					'constraint'     => '64',
					'null'					 => true,
				],
				'chat_id'    => [
					'type'           => 'VARCHAR',
					'constraint'     => '32',
					'null'					 => true,
				],
				'ava'    => [
					'type'           => 'VARCHAR',
					'constraint'     => '32',
				],
				'terahir_dilihat'  => [
					'type'           => 'INT',
					'constraint'     => 11,
					'null'					 => true,
				],
				'remember_selector'  => [
					'type'           => 'VARCHAR',
					'constraint'     => 64,
					'null'					 => true,
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
		$this->forge->createTable('users');
	}

	public function down()
	{
		$this->forge->dropTable('users');
	}
}