<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ReportNotif extends Migration
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
				'id_kegiatan'         => [
					'type'           => 'INT',
					'constraint'     => 11
				],
                'notif_ke'         => [
					'type'           => 'INT',
					'constraint'     => 11
				],
			]
		);
		$this->forge->addKey('id', true);
		$this->forge->addForeignKey('id_kegiatan','kegiatan','id','CASCADE','CASCADE');
		$this->forge->createTable('report_notif_kegiatan');
    }

    public function down()
    {
        $this->forge->dropTable('report_notif_kegiatan');
    }
}
